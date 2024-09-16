<?php

// Klienti

declare(strict_types=1);

namespace App\UI\Client\Edit;

use Nette;
use Nette\Application\UI\Form;
use App\UI\Accessory\DbFacade;
use App\UI\Addresses\AddressesFormFactory;
use App\UI\Client\Edit\ClientsFormFactory;
use Exception;

#[Requires(sameOrigin: true)]
final class EditPresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param DbFacade $db
     * @param AddressesFormFactory $addresses
     */
    public function __construct(
        private DbFacade $db,
        private AddressesFormFactory $addresses,
        private ClientsFormFactory $clients
    )  {
        parent::__construct();
    }
    
    private int $actualId = 0;
    private bool $isAddress = true;    
    
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
     * Vykreslí formulář základních údajů klienta
     * @return Form
     */
    protected function createComponentEditForm(): Form 
    {
        return $this->clients->create();
    }
    /**
     * Vykreslí formulář adresy
     * @return Form
     */
    protected function createComponentAddressForm(): Form
    {
        return $this->addresses->create($this->isAddress, $this->actualId);
    }
    /**
     * Nastaví výchozí data formulářů
     * @param type $clientId
     * @return void
     */
    public function actionEdit($clientId = null): void    
    {
        if ($clientId) {
            try {
                $client = $this->db->getById('clients', $clientId);
            } catch (Exception $e) {
                $this->flashMessage('Záznam nenalezen', 'alert alert-warning');
                $this->redirect('Edit:edit');
            }

            // Základní údaje
            $this->getComponent('editForm')
                    ->setDefaults($client->toArray());

            $this->actualId = (int)$clientId;

            // Adresa
            $address = $this->db->getAll('addresses')
                        ->where('person_id', $clientId)->fetch();
            if ($address) {
                $this->getComponent('addressForm')
                        ->setDefaults($address->toArray());
                $this->isAddress = true;
            } else {
                $this->isAddress = false;
            }
        }
    }
    /**
     * Odešle data do šablony editace klienta
     * @return void
     */
    public function renderEdit(): void
    {
        $this->template->clients = $this->db->getAll('clients')
                ->order('last_name');

        $this->template->actualId = $this->actualId;
        
        $this->template->services = $this->db->getAll('services')
                                    ->where('client_id', $this->actualId)
                                    ->select('TIME_FORMAT(time_from, "%H:%i") AS time_from')
                                    ->select('TIME_FORMAT(time_to, "%H:%i") AS time_to')
                                    ->select('title')
                                    ->select('day')
                                    ->select('id')
                                    ->order('day, time_from')
                                    ->fetchAll();
        
    }
    
}