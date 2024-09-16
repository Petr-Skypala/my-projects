<?php

declare(strict_types=1);

namespace App\UI\Carer\Doctors;

use Nette;
use App\UI\Accessory\DbFacade;
use App\UI\Accessory\QueryFacade;
use App\UI\Accessory\DaysOrderFacade;

#[Requires(sameOrigin: true)]
final class DoctorsPresenter extends Nette\Application\UI\Presenter
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
        if (!$this->getUser()->isAllowed('carers', 'view')) {
                $this->flashMessage('Nemáte dostatečná práva.', 'alert-warning');
                $this->redirect(':Home:default');
	}
    }
    /**
     * Vloží do šablony návštěvy u lékařů
     * @return void
     */
    public function renderDoctors(): void
    {
        $list = $this->query->getDoctors();
        $this->template->doctors = $this->daysOrder->daysOrder($list); // Vloží do pole pořadové číslo dne
        
        $this->template->carers = $this->db->getAll('carers');
    }
}


