<?php

declare(strict_types=1);

namespace App\UI\Carer\Create;

use Nette;
use Nette\Application\UI\Form;

use Nette\Database\Explorer;

final class CreatePresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param Explorer $database
     */
    public function __construct(
        private Explorer $database
        
    )  {
        parent::__construct();
    }
    /**
     * Vrátí formulář pro zadání nové pečovatelky
     * @return Form
     */
    protected function createComponentCreateForm(): Form
    {
	$form = new Form;
        
	$form->addText('first_name', 'Jméno:')
		->setRequired()
                ->addRule($form::Pattern, 'Jméno musí obsahovat pouze písmena', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->setMaxLength(30);
	$form->addText('last_name', 'Příjmení:')
		->setRequired()
                ->addRule($form::Pattern, 'Jméno musí obsahovat pouze písmena', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->setMaxLength(40);
        $form->addInteger('week_hours', 'Týdenní úvazek:')
                ->addRule($form::Pattern, 'Pole musí obsahovat pouze číslici', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setHtmlAttribute('class', 'form-control form-control-sm w-50')
                ->setRequired()
                ->addRule($form::Range, 'Týdenní úvazek musí být v rozsahu od %d do %d.', [0, Week_hours]);
                

	$form->addSubmit('send', 'Uložit')
                ->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary');

        $form->onSuccess[] = $this->createFormSucceeded(...);

	return $form;
    }
    /**
     * Vloží novou pečovatelku do databáze
     * @param array $data
     * @return void
     */
    private function createFormSucceeded(array $data): void
    {
        $newId = $this->database->table('carers')->insert($data)->getPrimary();
        $this->redirect('Edit:edit', $newId);
    }
    
    
}