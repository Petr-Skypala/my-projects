<?php

// Pečovatelky

declare(strict_types=1);

namespace App\UI\Carer\Create;

use Nette;
use Nette\Application\UI\Form;
use App\UI\Carer\Edit\CarersFormFactory;

#[Requires(sameOrigin: true)]
final class CreatePresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param CarersFormFactory $carers
     */
    public function __construct(
        private CarersFormFactory $carers
        
    )  {
        parent::__construct();
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
        if (!$this->getUser()->isAllowed('carers', 'edit')) {
                $this->flashMessage('Nemáte dostatečná práva.', 'alert-warning');
                $this->redirect(':Home:default');
	}
    }
    /**
     * Vykreslí formulář nová pečovatelka
     * @return Form
     */
    protected function createComponentCreateForm(): Form    
    {
        return $this->carers->create();
    }
}