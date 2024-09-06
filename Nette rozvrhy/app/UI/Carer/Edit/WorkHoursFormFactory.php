<?php

declare(strict_types=1);

namespace App\UI\Carer\Edit;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;
use App\UI\Accessory\DbFacade;
use Nette\Database\Explorer;


final class WorkHoursFormFactory extends Control
{
    /**
     * Konstruktor
     * @param Explorer $database
     * @param DbFacade $db
     */
    public function __construct(
        private Explorer $database,
        private DbFacade $db

    )  {
    }
    
    
    /**
     * Vytvoří formulář pro pracovní dobu
     * @param string $day
     * @return Form
     */
    public function create(string $day, $actualId): Form
    {
        $form = new Form;
        $form->addText('day')
		->setRequired()
                ->setDefaultValue($day)
                ->setHtmlAttribute('class', 'w-75 form-control form-control-sm')
                ->setHtmlAttribute('readonly');
        $form->addTime('time_from')
		->setRequired()
                ->setHtmlAttribute('class', 'w-50 form-control form-control-sm');
                //->setFormat('H:i');
        $form->addTime('time_to')
		->setRequired()
                ->setHtmlAttribute('class', 'w-50 form-control form-control-sm');
                //->setFormat('H:i');
        
        $form->addInteger('day_hours')
		->setRequired()
                ->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setMaxLength(2)
                ->setHtmlAttribute('class', 'w-25 form-control form-control-sm')
                ->addRule($form::Range, 'Denní úvazek musí být v rozsahu od %d do %d.', [0, Day_hours]);
        $form->addInteger('id')
                ->setHtmlType('hidden');
        $form->addSubmit('send', 'Uložit')
                ->setHtmlAttribute('class', ' btn btn-outline-secondary btn-sm ');

        $form->addInteger('carer_id')
                ->setDefaultValue($actualId)
                ->setHtmlAttribute('class', 'd-none');
        
        $form->onValidate[] = $this->validateDayForm(...);
        $form->onSuccess[] = $this->dayFormSucceeded(...);
        return $form;
        
    }
    /**
     * Zvaliduje formulář, zdali pracovní doba čas do není menší než čas od
     * @param Form $form
     * @return void
     */
    private function validateDayForm(Form $form): void
    {
        $values = $form->getValues();
        $time_from = $values['time_from'];
        $time_to = $values['time_to'];
        
        if ($time_from >= $time_to) {
            $form->addError('Čas procovní doby do nesmí být dříve než čas od.');
        }
    }
    /**
     * Po úspěšném vyplnění formuláře vloží nebo upraví pracovní dobu
     * @param Form $form
     * @param array $data
     * @return void
     */
    private function dayFormSucceeded(Form $form, array $data): void
    {
        $id = $data['id'];
        if ($id) {
            $workHours = $this->db->getById('work_hours', $id);
            
            $workHours->update($data);
            //$form->getPresenter()->redirect(':Home:default');
            //$this->presenter->redirect('Home:default');

        } else
        {
            $this->db->insert('work_hours', $data);
        }
    }
    
    /**
     * Vrátí údaje konkrétního dne
     * @param string $day
     * @param type $carer
     * @return type
     */
    public function getDay(string $day, $carer)
    {
        return $carer->related('work_hours')
                ->where('day', $day)
                ->select('TIME_FORMAT(time_from, "%H:%i") AS time_from')
                ->select('TIME_FORMAT(time_to, "%H:%i") AS time_to')
                ->select('day_hours')
                ->select('id')
                ->fetch();
        
    }
    /**
     * Vrátí všechny pracovní doby
     * @return type
     */
    public function getAllItems()
    {
        return $this->db->getAll('work_hours')
                ->select('TIME_FORMAT(work_hours.time_from, "%H:%i") AS time_from')
                ->select('TIME_FORMAT(time_to, "%H:%i") AS time_to')
                ->select('day_hours')
                ->select('day')
                ->select('id')
                ->select('carer_id')
                ->fetchAll();
    }
}