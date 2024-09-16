<?php

declare(strict_types=1);

namespace App\UI\Carer\Edit;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;
use App\UI\Accessory\DbFacade;
use Nette\Database\Explorer;

#[Requires(sameOrigin: true)]
final class CarersFormFactory extends Control
{
    /**
     * Konstruktor
     * @param Explorer $database
     * @param DbFacade $db
     */
    public function __construct(
        private Explorer $database,
        private DbFacade $db
    )  {
    }
    /**
     * Vygeneruje formulář pro základní údaje pečovatelky
     * @return Form
     */
    public function create(): Form 
    {
	$form = new Form;
        
	$form->addText('first_name', 'Jméno:')
		->setRequired()
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->addRule($form::Pattern, 'Jméno musí obsahovat pouze písmena', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setMaxLength(30);
	$form->addText('last_name', 'Příjmení:')
		->setRequired()
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->addRule($form::Pattern, 'Jméno musí obsahovat pouze písmena', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setMaxLength(40);
        $form->addInteger('week_hours', 'Týdenní úvazek:')
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->addRule($form::Pattern, 'Pole musí obsahovat pouze číslici', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setRequired()
                ->addRule($form::Range, 'Týdenní úvazek musí být v rozsahu od %d do %d.', [0, Week_hours]);
        $form->addInteger('id')
                ->setHtmlType('hidden');

	$form->addSubmit('send', 'Uložit')
                ->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary');

        $form->onSuccess[] = $this->carersFormSucceeded(...);

	return $form;
        
    }
    /**
     * Uloží data formuláře do databáze
     * @param Form $form
     * @param array $data
     * @return void
     */
    private function carersFormSucceeded(Form $form, array $data): void
    {
        $carerId = $data['id'];
        // Formulář je prázdný a je odeslaný na stránce Edit
        if (!$carerId && $form->getPresenter()->isLinkCurrent('Edit:*')) {

            $form->getPresenter()->flashMessage("Vyberte osobu", 'alert-warning');
            $form->getPresenter()->redirect('Edit:edit');
            
        // Formulář je odeslaný na stránce create
        } elseif (!$carerId && $form->getPresenter()->isLinkCurrent('Create:*')) {

            $newId = $this->database->table('carers')->insert($data)->getPrimary();
            $form->getPresenter()->redirect('Edit:edit', $newId);

        // Editace stavajícího záznamu
        } else {

        $carer = $this->db->getById('carers', $carerId);
        $carer->update($data);
        $form->getPresenter()->redirect('Edit:edit', $carerId);

        }

        
    }
    
}
