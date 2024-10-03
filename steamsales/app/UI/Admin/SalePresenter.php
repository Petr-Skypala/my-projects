<?php
namespace App\UI\Admin;

use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;

final class SalePresenter extends Nette\Application\UI\Presenter
{

    private Explorer $explorer;
    private SaleFormFactory $saleForm;
    private Array $tags;

    public function __construct(

	Explorer $explorer,
	SaleFormFactory $saleForm
    )  {
        parent::__construct();
	
	$this->explorer = $explorer;
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
     * Připraví data pro formulář vložení nového výprodeje
     * @return void
     */
    public function actionCreate(): void
    {
	$selection = $this->explorer->table('tag');
	$tags = $selection->fetchPairs('id', 'name');
	$this->tags = $tags;
    }
    /**
     * Vytvoří formulář nového výprodeje
     * @return Form
     */
    protected function createComponentNewSaleForm() : Form
    {
	return $this->saleForm->create($this->tags, $this->getUser()->getId());
    }

}