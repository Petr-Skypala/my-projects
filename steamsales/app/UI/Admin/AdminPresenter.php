<?php

declare(strict_types=1);

namespace App\UI\Admin;

use Nette;
use Nette\Database\Explorer;
use Nette\Application\UI\Form;
use App\UI\Accessory\FiltrFormFactory;

final class AdminPresenter extends Nette\Application\UI\Presenter
{
    private Explorer $explorer;
    private FiltrFormFactory $filtrForm;
    
    public function __construct(
	    Explorer $explorer,
	    FiltrFormFactory $filtrForm
    ) {
	parent::__construct();
	$this->explorer = $explorer;
	$this->filtrForm = $filtrForm;
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
     * Vloží data na admin stránku s výprodeji
     * @param int $page
     * @param string $filtr
     * @return void
     */
    public function renderDefault(int $page = 1, string $filtr = null): void
    {
	$sales = $this->explorer->table('sale')->where('name LIKE ?', '%'.$filtr.'%')->order('starts');
	
	// Stránkování
	$lastPage = 0;
	$this->template->sales = $sales->page($page, 15, $lastPage);
	
	$this->template->page = $page;
	$this->template->lastPage = $lastPage;
    }
    /**
     * Vytvoří formulář pro filtrování výprodejů
     * @return Form
     */
    public function createComponentFiltrForm(): Form 
    {
	return $this->filtrForm->create();
    }

}
