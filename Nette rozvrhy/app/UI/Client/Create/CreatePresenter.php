<?php

// Klienti

declare(strict_types=1);

namespace App\UI\Client\Create;

use Nette;
use Nette\Application\UI\Form;
use App\UI\Client\Edit\ClientsFormFactory;

#[Requires(sameOrigin: true)]
final class CreatePresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param ClientsFormFactory $clients
     */
    public function __construct(
        private ClientsFormFactory $clients
        
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
        if (!$this->getUser()->isAllowed('clients', 'edit')) {
                $this->flashMessage('Nemáte dostatečná práva.', 'alert-warning');
                $this->redirect(':Home:default');
	}
    }
    /**
     * Vykreslí formulář nový klient
     * @return Form
     */
    protected function createComponentCreateForm(): Form    
    {
        return $this->clients->create();
    }
}