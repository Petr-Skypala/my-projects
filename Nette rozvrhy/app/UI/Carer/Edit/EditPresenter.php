<?php

declare(strict_types=1);

namespace App\UI\Carer\Edit;

use Nette;
use Nette\Application\UI\Form;
use App\UI\Accessory\DbFacade;
use App\UI\Carer\Edit\WorkHoursFormFactory;
use App\UI\Addresses\AddressesFormFactory;

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
        private DoctorsFormFactory $doctors
    )  {
        parent::__construct();
    }

    private int $actualId = 0;
    private bool $isAddress = true;
    private $actualCarer;
    private $doctorsList;
    /**
     * Odešle do šablony edit.latte všechny pečovatelky a id aktuální pečovatelky
     * @return void
     */
    public function renderEdit(): void
    {
        $this->template->carers = $this->db->getAll('carers')
                
                ->order('last_name');
            
        // Předá do šablony id aktuálního blogu kvůli označení .active    
        $this->template->actualId = $this->actualId;
        // Předá do šablony přehled doktorů dané pečovatelky
        $this->template->doctors = $this->doctorsList;

        
    }    
    /**
     * Vytvoří formulář pro editaci údajů pečovatelky - jméno a týdenní pracovní doba
     * @return Form
     */
    protected function createComponentEditForm(): Form
    {
	$form = new Form;
        
	$form->addText('first_name', 'Jméno:')
		->setRequired()
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->addRule($form::Pattern, 'Jméno musí obsahovat pouze písmena', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setMaxLength(30);
	$form->addText('last_name', 'Příjmení:')
		->setRequired()
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->addRule($form::Pattern, 'Jméno musí obsahovat pouze písmena', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setMaxLength(40);
        $form->addInteger('week_hours', 'Týdenní úvazek:')
                ->setHtmlAttribute('class', 'form-control form-control-sm')
                ->addRule($form::Pattern, 'Pole musí obsahovat pouze číslici', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setRequired()
                ->addRule($form::Range, 'Týdenní úvazek musí být v rozsahu od %d do %d.', [0, Week_hours]);
        $form->addInteger('id')
                ->setHtmlType('hidden');

	$form->addSubmit('send', 'Uložit')
                ->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary');

        $form->onSuccess[] = $this->editFormSucceeded(...);

	return $form;
    }
    /**
     * Zpracuje formulář údajů o pečovatelce
     * @param array $data
     * @return void
     */
    private function editFormSucceeded(array $data): void
    {
        $carerId = $data['id'];
        if (!$carerId)
            {
                $this->flashMessage("Záznam nenalezen", 'alert-warning');
                $this->redirect('Edit:edit');
            }
        $carer = $this->db->getById('carers', $carerId);
        $carer->update($data);

        //$this->flashMessage("Záznam byl upraven", 'alert-success');
        //$this->redirect('Blogy:edit');
        $this->actualId = $carerId;
        
    }
    /**
     * Vytvoří formulář pro adresu, která patří pečovatelce
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

    /**
     * Vykreslí a aktualizuje formuláře
     * @param type $carerId
     * @return void
     */
    public function actionEdit($carerId = null): void
    {
        
        if ($carerId != null) {

        if ($carerId) {
        $carer = $this->db->getById('carers', $carerId);

        $address = $this->db->getAll('addresses')
                    ->where('person_id', $carerId)->fetch();
        if ($address) {
        $this->isAddress = true;
        } else
        {
            $this->isAddress = false;
        }
        // Pracovní doby
        $monday = $this->workHours->getDay('Pondělí', $carer);   
        $tuesday = $this->workHours->getDay('Úterý', $carer);
        $wednesday = $this->workHours->getDay('Středa', $carer);
        $thursday = $this->workHours->getDay('Čtvrtek', $carer);
        $friday = $this->workHours->getDay('Pátek', $carer);
        
        // Doktoří
        $doctorForm = [
            'carer_id' => $carerId,
        ];
        $this->doctorsList = $this->doctors->getDoctors($carer);
        
        // Nastavení dat ve formuláři
	if (!$carer) {
		$this->error('Did not found');
	}
        // Základní údaje
	$this->getComponent('editForm')
		->setDefaults($carer->toArray());
        // Adresy
        if ($address) {
        $this->getComponent('addressForm')
		->setDefaults($address->toArray());
        }
        // Pracovní doby
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

        $this->getComponent('doctorsForm')
                ->setDefaults($doctorForm);
       
        }        
        $this->actualCarer = $carer->toArray();

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

    
}
