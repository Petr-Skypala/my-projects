<?php

declare(strict_types=1);

namespace App\UI\Client\Edit;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;
use App\UI\Accessory\DbFacade;
use Nette\Database\Explorer;

#[Requires(sameOrigin: true)]
final class ClientsFormFactory extends Control
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
     * Vygeneruje formulář pro základní údaje klienta
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
        $form->addText('note', 'Poznámka:')
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setMaxLength(255);
        $form->addInteger('id')
                ->setHtmlType('hidden');

	$form->addSubmit('send', 'Uložit')
                ->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary');

        $form->onSuccess[] = $this->clientFormSucceeded(...);

	return $form;
        
    }
    /**
     * Uloží data formuláře do databáze
     * @param Form $form
     * @param array $data
     * @return void
     */
    private function clientFormSucceeded(Form $form, array $data): void
    {
        $clientId = $data['id'];
        // Formulář je prázdný a je odeslaný na stránce Edit        
        if (!$clientId && $form->getPresenter()->isLinkCurrent('Edit:*')) {
            
                $form->getPresenter()->flashMessage("Vyberte osobu", 'alert-warning');
                $form->getPresenter()->redirect('Edit:edit');
        // Formulář je odeslaný na stránce create
        } elseif (!$clientId && $form->getPresenter()->isLinkCurrent('Create:*')) {

            $newId = $this->database->table('clients')->insert($data)->getPrimary();
            $form->getPresenter()->redirect('Edit:edit', $newId);

        // Editace stavajícího záznamu            
        } else {

            $client = $this->db->getById('clients', $clientId);
            $client->update($data);
            $form->getPresenter()->redirect('Edit:edit', $clientId);
        }
    }
    
}
