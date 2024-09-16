<?php

declare(strict_types=1);

namespace App\UI\Carer\List;

use Nette;
use App\UI\Accessory\DbFacade;
use App\UI\Accessory\DaysOrderFacade;
use App\UI\Accessory\QueryFacade;

#[Requires(sameOrigin: true)]
final class ListPresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param DbFacade $db
     * @param DaysOrderFacade $daysOrder
     * @param QueryFacade $query
     */
    public function __construct(
        private DbFacade $db,
        private DaysOrderFacade $daysOrder,
        private QueryFacade $query
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
     * Vloží do šablony pečovatelky a pracovní doby
     * @return void
     */
    public function renderList(): void
    {
        $list = $this->query->getWorkHours();
        $this->template->list = $this->daysOrder->daysOrder($list);
        $this->template->carers = $this->db->getAll('carers');
    }
}

