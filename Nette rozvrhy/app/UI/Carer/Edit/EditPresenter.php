<?php

// Pečovatelky

declare(strict_types=1);

namespace App\UI\Carer\Edit;

use Nette;
use Nette\Application\UI\Form;
use App\UI\Accessory\DbFacade;
use App\UI\Carer\Edit\WorkHoursFormFactory;
use App\UI\Carer\Edit\CarersFormFactory;
use App\UI\Addresses\AddressesFormFactory;
use Exception;

#[Requires(sameOrigin: true)]
final class EditPresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param DbFacade $db
     * @param WorkHoursFormFactory $workHours
     * @param AddressesFormFactory $addresses
     * @param DoctorsFormFactory $doctors
     */
    public function __construct(
        private DbFacade $db,
        private WorkHoursFormFactory $workHours,
        private AddressesFormFactory $addresses,
        private DoctorsFormFactory $doctors,
        private CarersFormFactory $carers
    )  {
        parent::__construct();
    }

    public int $actualId = 0;
    private bool $isAddress = true;
    private $doctorsList;

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
     * Vykreslí a aktualizuje formuláře
     * @param type $carerId
     * @return void
     */
    public function actionEdit($carerId = null): void
    {
        
        if ($carerId) {
            try {
                $carer = $this->db->getById('carers', $carerId);
            } catch (Exception $e) {
                    $this->flashMessage('Záznam nenalezen', 'alert alert-warning');
                    $this->redirect('Edit:edit');
            }

            // Základní údaje
            $this->getComponent('editForm')
                    ->setDefaults($carer->toArray());

            // Adresa
            $address = $this->db->getAll('addresses')
                        ->where('person_id', $carerId)->fetch();

            if ($address) { 
                // bool pro tlačítko Vložit / Smazat adresu
                $this->isAddress = true; 

                $this->getComponent('addressForm')
                    ->setDefaults($address->toArray());
            } else {

                $this->isAddress = false;
            }

            // Pracovní doby po dnech
            $monday = $this->workHours->getDay('Pondělí', $carer);   
            $tuesday = $this->workHours->getDay('Úterý', $carer);
            $wednesday = $this->workHours->getDay('Středa', $carer);
            $thursday = $this->workHours->getDay('Čtvrtek', $carer);
            $friday = $this->workHours->getDay('Pátek', $carer);

            if ($monday) {
            $this->getComponent('mondayForm')
                    ->setDefaults($monday->toArray());
            }
            if ($tuesday) {
            $this->getComponent('tuesdayForm')
                    ->setDefaults($tuesday->toArray());
            }

            if ($wednesday) {
            $this->getComponent('wednesdayForm')
                    ->setDefaults($wednesday->toArray());
            }

            if ($thursday) {
            $this->getComponent('thursdayForm')
                    ->setDefaults($thursday->toArray());
            }

            if ($friday) {
            $this->getComponent('fridayForm')
                    ->setDefaults($friday->toArray());
            }

            // Doktoři
            $doctorForm = [
                'carer_id' => $carerId,
            ];
            $this->getComponent('doctorsForm')
                    ->setDefaults($doctorForm);

            // Seznam doktorů pro šablonu
            $this->doctorsList = $this->doctors->getDoctors($carer);

            // Aktuální id pečovatelky pro šablonu
            $this->actualId = (int)$carerId;
        }
       
    }
    /**
     * Vymaže vybranou návštěvu u lékaře
     * @param int $id
     * @return void
     */
    public function actionDeleteDoctor(int $id): void
    {
        $doctor = $this->db->getById('doctors', $id);
        $this->db->deleteById('doctors', $id);
        $this->redirect('Edit:edit', $doctor['carer_id']);
    }

    /**
     * Vytvoří formulář pro základní údaje
     * @return Form
     */
    protected function createComponentEditForm(): Form
    {
        return $this->carers->create();
    }
    /**
     * Vytvoří formulář pro adresu pečovatelky
     * @return Form
     */
    protected function createComponentAddressForm(): Form
    {
        return $this->addresses->create($this->isAddress, $this->actualId);
    }
    /**
     * Vytvoří formulář pro doktory
     * @return Form
     */
    protected function createComponentDoctorsForm(): Form
    {
        return $this->doctors->create();
    }
    
            // Komponenty pracovní doby:
    /**
     * Vytvoří formulář pro pondělí
     * @return Form
     */
    protected function createComponentMondayForm(): Form
    {
        return $this->workHours->create('Pondělí', $this->actualId);
    }
    /**
     * Vytvoří formulář pro úterý
     * @return Form
     */
    protected function createComponentTuesdayForm(): Form
    {
        return $this->workHours->create('Úterý', $this->actualId);
    }
    /**
     * Vytvoří formulář pro středu
     * @return Form
     */
    protected function createComponentWednesdayForm(): Form
    {
        return $this->workHours->create('Středa', $this->actualId);
    }
    /**
     * Vytvoří formulář pro čtvrtek
     * @return Form
     */
    protected function createComponentThursdayForm(): Form
    {
        return $this->workHours->create('Čtvrtek', $this->actualId);
    }
    /**
     * Vytvoří formulář pro pátek
     * @return Form
     */
    protected function createComponentFridayForm(): Form
    {
        return $this->workHours->create('Pátek', $this->actualId);
    }
    
    /**
     * Odešle data do šablony
     * @return void
     */
    public function renderEdit(): void
    {
        $this->template->carers = $this->db->getAll('carers')
                                ->order('last_name');

        // Předá do šablony id aktuální pečovatelky (.active)
        $this->template->actualId = $this->actualId;
        // Předá do šablony přehled doktorů pečovatelky
        $this->template->doctors = $this->doctorsList;
    }    
    
}
