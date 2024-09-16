<?php

declare(strict_types=1);

namespace App\UI\Client\Service;

use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;
use App\UI\Accessory\DbFacade;
use App\UI\Client\Service\ServiceFormFactory;
use Exception;

#[Requires(sameOrigin: true)]
final class ServicePresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param Explorer $database
     */
    public function __construct(
        private Explorer $database,
        private DbFacade $db,
        private ServiceFormFactory $serviceForm
        

    )  {
        parent::__construct();
    }
    
    private int $float = 0;
    private int $serviceId = 0;
    
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
     * Vykreslí formulář pro editaci služby
     * @return Form
     */
    protected function createComponentServiceForm(): Form
    {
        return $this->serviceForm->create($this->float);
    }
    
    /**
     * Nastaví výchozí hodnotu formuláře pro založení služby - id klienta
     * @param type $clientId
     * @return void
     */
    public function actionCreate($clientId = null): void    
    {
        // Kontrola jestli je vybraná osoba
        if ($clientId == 0) {
            $this->flashMessage("Vyberte osobu", 'alert-warning');
            $this->redirect('Edit:edit');
        }
        // Ověří správnost id klienta
        try {
            $isClient = $this->db->getById('clients', $clientId);
        } catch (Exception $e) {
                $this->flashMessage('Záznam nenalezen', 'alert alert-warning');
                $this->redirect('Edit:edit');
        }
        // Vloží do formuláře id klienta
        $service['client_id'] = $clientId;
        $this->getComponent('serviceForm')
            ->setDefaults($service);

    }
    /**
     * Aktualizuje formulář podle vybrané služby
     * @param type $serviceId
     * @return void
     */
    public function actionEdit($serviceId = null): void
    {
        // Ověří správnost id služby
        try {
            $isService = $this->db->getById('services', $serviceId);
        } catch (Exception $e) {
                $this->flashMessage('Záznam nenalezen', 'alert alert-warning');
                $this->redirect('Edit:edit');
        }
        
        $this->serviceId = (int)$serviceId;
        $service = $this->db->getAll('services')
                            ->where('id', $serviceId)
                            ->select('TIME_FORMAT(time_from, "%H:%i") AS time_from')
                            ->select('TIME_FORMAT(time_to, "%H:%i") AS time_to')
                            ->select('title, day, id, description, client_id, reserve, note, floating, float_lenght')
                            ->select('TIME_FORMAT(float_from, "%H:%i") AS float_from')
                            ->select('TIME_FORMAT(float_to, "%H:%i") AS float_to')
                            ->fetch();
                
        if ($service) {
            $this->float = $service['floating'];
            $this->getComponent('serviceForm')
                  ->setDefaults($service->toArray());
            $service = $service->toArray();
        }
}
    /**
     * Odešle data do šablony editace služby
     * @return void
     */
    public function renderEdit(): void
    {
        $this->template->floatDays = $this->database->table('float_days')->where('service_id', $this->serviceId);
        $this->template->float = $this->float;
        $this->template->carers = $this->db->getAll('carers')->order('last_name');
        $this->template->serviceId = $this->serviceId;
        $carerIds = $this->database->query('SELECT `carer_id` FROM `service_carers` WHERE `service_id` = ?', $this->serviceId)->fetchPairs();
        $this->template->serviceCarers = $this->db->getAll('carers')->where('id', $carerIds)->order('last_name')->fetchAll();

    }
    /**
     * Odešle data do šablony nové služby
     * @return void
     */
    public function renderCreate(): void
    {
        $this->template->float = $this->float;
    }
    /**
     * Vymaže službu            
     * @param type $serviceId
     * @param type $clientId
     * @return void
     */
    public function actionDelete($serviceId, $clientId): void
    {
        $this->db->deleteById('services',(int)$serviceId);
        $this->redirect('Edit:edit', $clientId);
    }
    
}