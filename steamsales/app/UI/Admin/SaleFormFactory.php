<?php

declare(strict_types=1);

namespace App\UI\Admin;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;
use App\UI\Accessory\DbFacade;
use Nette\Database\Explorer;


final class SaleFormFactory extends Control
{
    private Explorer $explorer;
    private DbFacade $db;
    private int $userId;

    /**
     * Konstruktor
     * @param Explorer $explorer
     * @param DbFacade $db
     */
    public function __construct(
        
        Explorer $explorer,
        DbFacade $db

    )  {
	$this->explorer = $explorer;
	$this->db = $db;
    }
    /**
     * Vygeneruje formulář pro výprodej
     * @param array $tags
     * @param int $userId
     * @return Form
     */
    public function create(array $tags, int $userId): Form
    {
	$this->userId = $userId;
        $form = new Form;
	
	$sub1 = $form->addContainer('sale');
	
        $sub1->addText('name', 'Název:')
		->setHtmlAttribute('class', 'form-control form-control-sm')
                ->setRequired('Prosím vyplňte název výprodeje.')
		->addRule($form::Pattern, 'Název: malá a velká písmena a číslice', '^[a-zA-Zá-žÁ-Ž0-9 .]+$');

	$sub1->addDate('starts', 'Začíná:')
                ->setHtmlAttribute('class', 'form-control form-control-sm')
		->setRequired();

	$sub1->addDate('ends', 'Končí:')
		->setHtmlAttribute('class', 'form-control form-control-sm')
		->setRequired();

	$sub1->addColor('color', 'Barva:')
		->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^=\-%<>\\\/&;`\'"*\^]*')
		->setDefaultValue('#3C8ED7');

   	$form->addMultiSelect('tags', 'Tagy:', $tags)
		->setRequired('Označte vybrané tagy')
		->setHtmlAttribute('class', 'form-control form-control-sm')
		->setHtmlAttribute('title', 'Vyberte jeden nebo více tagů')
		->getSelectedItems();

        $sub1->addInteger('id')
                ->setHtmlType('hidden');


        $form->addSubmit('register', 'Vložit')
		->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary');

        $form->onValidate[] = function(Form $form, array $data) {
	    $this->validateSaleForm($form, $data);
	}; 

        $form->onSuccess[] = function(Form $form, array $data) {
	    $this->saleFormSucceeded($form, $data);
	};

	$form->addProtection();

        return $form;
    }
    /**
     * Vloží nebo upraví data v databázi z formuláře výprodeje
     * @param Form $form
     * @param array $data
     * @return void
     */
    private function saleFormSucceeded(Form $form, array $data): void
    {
	// Kontejner 'sale'
	$dataInsert = $data['sale'];
	$dataInsert['user_id'] = $this->userId;

	$tagsInsert = $data['tags'];	    

	// Pokud není ve formuláři id výprodeje, vloží se nový
	if (!isset($dataInsert['id'])) {
	    $saleId = $this->explorer->table('sale')->insert($dataInsert)->getPrimary();
	    $form->getPresenter()->flashMessage('Nový výprodej byl úspěšně vložený', 'alert-success');

	// Editace již existujícího výprodeje
	} else {
	    $saleId = $dataInsert['id'];
	    $sale = $this->db->getById('sale', $saleId);
	    $sale->update($dataInsert);
	    $form->getPresenter()->flashMessage('Změny byly uložené', 'alert-success');
	    // Vymaže všechny tagy pro vložení nových
	    $this->explorer->table('sale_tag')->where('sale_id', $saleId)->delete();
	}
	
	// Vloží tagy k výprodeji
	foreach ($tagsInsert as $tag) {
	    $data = array (
		'sale_id' => $saleId,
		'tag_id' => $tag,
	    );
	    $this->explorer->table('sale_tag')->insert($data);
	}

	$form->getPresenter()->redirect('Admin:default');
    }
    /**
     * Zvaliduje data konce a začátku výprodeje
     * @param Form $form
     * @param array $data
     * @return void
     */
    private function validateSaleForm(Form $form, array $data ): void
    {
	$starts = ($data['sale']['starts']);
	$ends = ($data['sale']['ends']);
	if ($starts >=  $ends) {
	    $form->addError('Datum začátku výprodeje nesmí být později než datum konce výprodeje.');
	}
    }
}
