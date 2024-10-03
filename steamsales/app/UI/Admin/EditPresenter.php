<?php

declare(strict_types=1);

namespace App\UI\Admin;

use Nette;
use Nette\Application\UI\Form;
use App\UI\Accessory\DbFacade;
use Exception;

final class EditPresenter extends Nette\Application\UI\Presenter
{
    private DbFacade $db;
    private SaleFormFactory $saleForm;
    private Array $tags;
    private Array $tagsTamplate;

    public function __construct(
	    DbFacade $db,
	    SaleFormFactory $saleForm
    ) {
	parent::__construct();
	$this->db = $db;
	$this->saleForm = $saleForm;
    }

    /**
     * Ověření uživatele
     */
    protected function startup()
    {
	parent::startup();
	if (!$this->getUser()->isLoggedIn()) {
		$this->redirect(':User:Sign:in');
	}
        
        if (!$this->getUser()->isAllowed('sales', 'edit')) {
                $this->flashMessage('Nemáte dostatečná práva.', 'alert-warning');
                $this->redirect('Admin:default');
	}
    } 
    /**
     * Připraví data pro formulář editace výprodeje
     * @param int $saleId
     * @return void
     */
    public function actionEdit(int $saleId = null): void
    {
	// Výběr tagů z databáze pro zobrazení ve formuláři
	$selection = $this->db->getAll('tag');
	$tags = $selection->fetchPairs('id', 'name');
	$this->tags = $tags;

	if ($saleId) {
	    // Výběr dat pro výchozí hodnoty formuláře
	    try {
		$sale = $this->db->getById('sale', $saleId);
	    } catch (Exception $e) {
		$this->flashMessage('Záznam nenalezen', 'alert-warning');
		$this->redirect('Admin:default');
	    }
	    // Kontejner 'sale' formuláře SaleForm
	    $dataInsert['sale'] = $sale;
	    // Tagy přiřazené k výprodeji
	    $this->tagsTamplate = $sale->related('sale_tag')->fetchAll();
	    
	    $this->getComponent('editSaleForm')
		->setDefaults($dataInsert);
	    
	} else {
	    $this->redirect('Admin:default');
	}
    }
    /**
     * Vytvoří formulář pro editaci výprodeje
     * @return Form
     */
    protected function createComponentEditSaleForm(): Form
    {
	return $this->saleForm->create($this->tags, $this->getUser()->getId());
    }
    /**
     * Vloží data do šablony
     * @return void
     */
    public function renderEdit(): void
    {
	// Tagy přiřazené k výprodeji
	$this->template->tags = $this->tagsTamplate;
    }

}