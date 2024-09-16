<?php

declare(strict_types=1);

namespace App\UI\Carer\Edit;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;
use App\UI\Accessory\DbFacade;


#[Requires(sameOrigin: true)]
final class DoctorsFormFactory extends Control
{
    /**
     * Konstruktor
     * @param DbFacade $db
     */
    public function __construct(
        private DbFacade $db
    )  {
    }
    /**
     * Vygeneruje formulář pro vkládání doktorů
     * @return Form
     */
    public function create(): Form
    {
        $form = new Form;
        $form->addSelect('day', 'Den:')
                ->setRequired()
                ->setItems([
                    'Pondělí' => 'Pondělí', 
                    'Úterý' => 'Úterý',
                    'Středa' => 'Středa',
                    'Čtvrtek' => 'Čtvrtek',
                    'Pátek' => 'Pátek',
                    ])
                ->setPrompt('Zvolte den')
                ->setHtmlAttribute('class', 'w-100 form-control form-select form-select-sm');
        $form->addTime('time_from','Čas od:')
		->setRequired()
                ->setHtmlAttribute('class', 'w-100 form-control form-control-sm');
        $form->addTime('time_to', 'Čas do:')
		->setRequired()
                ->setHtmlAttribute('class', 'w-100 form-control form-control-sm');
        $form->addInteger('id')
                ->setHtmlType('hidden');
        $form->addSubmit('send', 'Uložit')
                ->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary');
        $form->addInteger('carer_id')
                ->setHtmlAttribute('class', 'd-none');
        
        $form->onValidate[] = $this->validateDoctorsForm(...);
        $form->onSuccess[] = $this->doctorsFormSucceeded(...);
        return $form;
    }
    /**
     * Zvaliduje čas do nesmí být dříve než čas od
     * @param Form $form
     * @return void
     */
    private function validateDoctorsForm(Form $form): void
    {
        $values = $form->getValues();
        $time_from = $values['time_from'];
        $time_to = $values['time_to'];
        
        if ($time_from >= $time_to) {
            $form->addError('Čas do nesmí být dříve než čas od.');
        }
    }
    /**
     * Po úspěšném vyplnění formuláře vloží návštěvu u lékaře
     * @param Form $form
     * @param array $data
     * @return void
     */
    private function doctorsFormSucceeded(Form $form, array $data): void
    {
        // Kontrola jestli je vybraná pečovatelka
        if (!$data['carer_id']) {
            
            $form->getPresenter()->flashMessage("Vyberte osobu", 'alert-warning');
            $form->getPresenter()->redirect('Edit:edit');
        }
        
        $this->db->insert('doctors', $data);
            
        $form->getPresenter()->redirect(':Carer:Edit:edit', $data['carer_id']);            
    }
    /**
     * Vrátí doktory pro jednu pečovatelku
     * @param type $carer
     * @return type
     */
    public function getDoctors($carer)
    {
        return $carer->related('doctors')
                ->select('TIME_FORMAT(time_from, "%H:%i") AS time_from')
                ->select('TIME_FORMAT(time_to, "%H:%i") AS time_to')
                ->select('day, id')
                ->order('day')
                ->order('time_from')
                ->fetchAll();
    }
}