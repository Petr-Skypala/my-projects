<?php

declare(strict_types=1);

namespace App\UI\Client\Carers;

use Nette;
use Nette\Database\Explorer;
use App\UI\Accessory\DbFacade;

#[Requires(sameOrigin: true)]
final class CarersPresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param DbFacade $db
     * @param Explorer $database
     */
    public function __construct(
        private DbFacade $db,
        private Explorer $database
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
     * Přiřadí pečovatelku ke službě
     * @param type $serviceId
     * @param type $carerId
     */
    public function actionAdd($serviceId, $carerId): void
    {
        // Vyhledá jestli je počovatelka ke službě již přiřazená
        $service = $this->db->getAll('service_carers')
                            ->where('service_id = ? AND carer_id = ?', $serviceId, $carerId)
                            ->fetch();
        // Pokud pečovatelka na službě není, pak ji přiřadí
        if (!$service) {
            $data = array(
                'service_id' => $serviceId,
                'carer_id' => $carerId,
            );
            $this->db->insert('service_carers', $data);
            $this->redirect('Service:edit', $serviceId);
        } else {
            $this->flashMessage('Pečovatelka je již přiřazená', 'alert alert-warning');
            $this->redirect('Service:edit', $serviceId);
        }
            
    }
    /**
     * Odebere pečovatelku ze služby
     * @param type $serviceId
     * @param type $carerId
     * @return void
     */
    public function actionRemove($serviceId, $carerId): void
    {
        $this->db->getAll('service_carers')->where('service_id = ? AND carer_id = ?', $serviceId, $carerId)->delete();
        $this->redirect('Service:edit', $serviceId);
    }
    /**
     * Přidá ke službě všechny pečovatelky
     * @param type $serviceId
     * @return void
     */
    public function actionAddAll($serviceId): void
    {
        // Vymaže stávající pečovatelky na službě
        $this->db->getAll('service_carers')->where('service_id', $serviceId)->delete();
        $carerIds = $this->database->query('SELECT `id` FROM `carers`')->fetchPairs();

        // Vloží všechny pečovatelky
        foreach ($carerIds as $id) {
        
            $data = array (
                'service_id' => $serviceId,
                'carer_id' => $id,
            );
            $this->db->insert('service_carers', $data);
        }
        $this->redirect('Service:edit', $serviceId);
    }
    /**
     * Odebere všechny pečovatelky ze služby
     * @param type $serviceId
     * @return void
     */
    public function actionRemoveAll($serviceId): void
    {
        $this->db->getAll('service_carers')->where('service_id', $serviceId)->delete();
        $this->redirect('Service:edit', $serviceId);
    }
            
}
