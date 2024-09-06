<?php

declare(strict_types=1);

namespace App\UI\Carer\List;

use Nette;
use App\UI\Accessory\DbFacade;
use App\UI\Carer\Edit\WorkHoursFormFactory;

final class ListPresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param DbFacade $db
     * @param WorkHoursFormFactory $workHours
     */
    public function __construct(
        private DbFacade $db,
        private WorkHoursFormFactory $workHours
    ) {
        parent::__construct();
    }
    /**
     * Vloží do šablony pečovatelky a pracovní doby
     * @return void
     */
    public function renderList(): void
    {
        $this->template->list = $this->workHours->getAllItems();
        
        $this->template->carers = $this->db->getAll('carers');
    }
}

