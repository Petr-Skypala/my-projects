<?php

declare(strict_types=1);

namespace App\UI\Client\List;

use Nette;
use App\UI\Accessory\DbFacade;
use App\UI\Accessory\QueryFacade;
use App\UI\Accessory\DaysOrderFacade;

#[Requires(sameOrigin: true)]
final class ListPresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param DbFacade $db
     * @param QueryFacade $query
     * @param DaysOrderFacade $daysOrder
     */
    public function __construct(
        private DbFacade $db,
        private QueryFacade $query,
        private DaysOrderFacade $daysOrder
        
    ) {
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
        if (!$this->getUser()->isAllowed('clients', 'view')) {
                $this->flashMessage('Nemáte dostatečná práva.', 'alert-warning');
                $this->redirect(':Home:default');
	}
    }
    /**
     * Vloží data do šablony fixní služby
     * @return void
     */
    public function renderList(): void
    {
        $fixServices = $this->query->getFixServices();
        
        $this->template->list = $this->daysOrder->daysOrder($fixServices);
        
        $this->template->clients = $this->db->getAll('clients');
        
        $this->template->carers = $this->query->getServiceCarers()->fetchAll();
    }
    /**
     * Vloží data do šablony plovoucí služby
     * @return void
     */
    public function renderFloat(): void
    {
        $floatServices = $this->query->getFloatServices();
        
        $this->template->carers = $this->query->getServiceCarers()->fetchAll();
        
        $this->template->list = $this->daysOrder->daysOrder($floatServices);
        $this->template->services = $this->db->getAll('services')
                                    ->select('TIME_FORMAT(float_from, "%H:%i") AS float_from')
                                    ->select('TIME_FORMAT(float_to, "%H:%i") AS float_to')
                                    ->select('title, id, float_lenght');
                                    
        
        $this->template->clients = $this->db->getAll('clients');
    }
    
    
    }

