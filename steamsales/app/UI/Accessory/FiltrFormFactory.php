<?php

declare(strict_types=1);

namespace App\UI\Accessory;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;

final class FiltrFormFactory extends Control
{
    /**
     * Konstruktor
     */
    public function __construct(
 
    )  {
    }
    /**
     * Vygeneruje formulář pro výprodej
     * @param array $tags
     * @param int $userId
     * @return Form
     */
    public function create(): Form
    {
	$form = new Form;
	
	$form->addText('filtr')
		->setHtmlAttribute('class', 'form-control form-control-sm')
		->addRule($form::Pattern, 'Malá a velká písmena a číslice', '^[a-zA-Zá-žÁ-Ž0-9 .]+$');

        $form->addSubmit('send', 'Filtrovat')
		->setHtmlAttribute('class', 'btn btn-sm btn-outline-secondary');

        $form->onSuccess[] = function(Form $form, array $data) {
	    $this->filtrFormSucceeded($form, $data);
	};

	$form->addProtection();

        return $form;

    }
    /**
     * Přesměruje na výchozí stránku s aplikací filtru
     * @param Form $form
     * @param array $data
     * @return void
     */
    private function filtrFormSucceeded(Form $form, array $data): void
    {
	$form->getPresenter()->redirect('default', 1, $data['filtr']);
    }

}
