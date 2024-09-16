<?php

declare(strict_types=1);

namespace App\UI\Addresses;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;
use App\UI\Accessory\DbFacade;
use Nette\Database\Explorer;

#[Requires(sameOrigin: true)]
final class AddressesFormFactory extends Control
{
    /**
     * Konstruktor
     * @param DbFacade $db
     */
    public function __construct(
        private DbFacade $db,
        private Explorer $database,
        private TravelTimesFacade $travelTimes

    )  {
    }

    /**
     * Vytvoří formulář adresy
     * @param type $isAddres
     * @return Form
     */
    public function create($isAddres, int $personId): Form
    {
	$form = new Form;
        
	$form->addText('street', 'Ulice:')
		->setRequired()
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setMaxLength(30);
	$form->addText('number', 'Č. popisné:')
		->setRequired()
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setMaxLength(10);
	$form->addText('indicative', 'Č. orientační:')
		->setRequired()
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setMaxLength(10);
	$form->addText('city', 'Město:')
		->setRequired()
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setMaxLength(40);
        
        $form->addInteger('person_id')
                ->setHtmlType('hidden')
                ->setDefaultValue($personId);
        
        if (!$isAddres) {
	$form->addSubmit('send', 'Vložit')
                ->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary');
        } else {
        $form->addSubmit('delete', 'Smazat')
                ->setHtmlAttribute('onclick', 'return confirm(\'Opravdu chcete adresu smazat?\')')                
                ->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary');
        }
        $form->onSuccess[] = $this->addressFormSucceeded(...);

        $form->addInteger('id')
                ->setHtmlType('hidden');
	return $form;
    }
    /**
     * Zpracuje formulář po vložení dat
     * @param Form $form
     * @param array $data
     * @return void
     */
    private function addressFormSucceeded(Form $form, array $data): void
    {
        // Tlačítko vložit
        if (isset($form['send'])) {
            if ($form['send']->isSubmittedBy()) {
                // Vloží novou adresu do databáze a vrátí její ID
                $newId =  $this->database->table('addresses')->insert($data)->getPrimary();
                // Vloží nové kombinace adres pro časy přejezdů
                $this->travelTimes->insertJourneys($newId);

                if ($data['person_id'] < 10000 ) { // Rozliší osobu podle id - pečovatelka / klient a přesměruje

                   $form->getPresenter()->redirect(':Carer:Edit:edit', $data['person_id']);
                } else {
                    $form->getPresenter()->redirect(':Client:Edit:edit', $data['person_id']);
                }
            }

        // Tlačítko smazat
        } elseif 
           (isset ($form['delete'])) {
               if ($form['delete']->isSubmittedBy()) {
                   
                    // Kontrola jestli je vybraná osoba
                    if ($data['person_id'] == 0)  {
                        
                            $form->getPresenter()->flashMessage("Vyberte osobu", 'alert-warning');
                            $form->getPresenter()->redirect('Edit:edit');
                    }
                   
                    // Vymaže adresu z databáze 
                    $this->db->deleteById('addresses', $data['id']);

                    if ($data['person_id'] < 10000 ) { // Rozliší osobu podle id - pečovatelka / klient a přesměruje

                       $form->getPresenter()->redirect(':Carer:Edit:edit', $data['person_id']);
                   } else {
                       $form->getPresenter()->redirect(':Client:Edit:edit', $data['person_id']);
                   }
               }
        }
    }
}
