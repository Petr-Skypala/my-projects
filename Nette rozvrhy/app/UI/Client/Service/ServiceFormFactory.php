<?php

declare(strict_types=1);

namespace App\UI\Client\Service;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;
use App\UI\Accessory\DbFacade;
use Nette\Database\Explorer;

#[Requires(sameOrigin: true)]
final class ServiceFormFactory extends Control
{
    /**
     * Konstruktor
     * @param DbFacade $db
     */
    public function __construct(
        private DbFacade $db,
        private Explorer $database,
    )  {
    }
    /**
     * Vytvoří formulář editace/vložení služby
     * @param type $float hodnota ovlivní zobrazení některých prvků (0/1)
     * @return Form
     */
    public function create($float): Form
    {
	$form = new Form;
        
	$form->addText('title', 'Název:')
		->setRequired()
                ->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^=\%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setOption('div', 'col-4')
                ->setHtmlAttribute('class', 'w-100 form-control form-control-sm')
                ->setMaxLength(50);
	$form->addTextArea('description', 'Popis:')
		
                ->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^+=\%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setHtmlAttribute('class', 'w-50 form-control form-control-sm')
                ->setOption('div', 'col-8')
                ->setMaxLength(255);

        // Vykreslí v případě fixní služby
        if ($float == 0) {
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
                    ->setOption('div', 'col-4')
                    ->setHtmlAttribute('class', 'w-50 form-control form-select form-select-sm');
            $form->addTime('time_from','Čas od:')
                    ->setRequired()
                    ->setOption('div', 'col-4')
                    ->setHtmlAttribute('class', 'w-50 form-control form-control-sm');
            $form->addTime('time_to', 'Čas do:')
                    ->setRequired()
                    ->setOption('div', 'col-4')
                    ->setHtmlAttribute('class', 'w-50 form-control form-control-sm');
        }
        
        $form->addInteger('reserve', 'Rezerva:')
                ->addRule($form::Integer, 'Pole musí být číslo.')
                ->setRequired()
                ->setHtmlAttribute('class', 'form-control form-control-sm w-50')
                ->setOption('div', 'col-4')
                
                ->addRule($form::Range, 'Rezerva musí být v intervalu od %d do %d min.', [0, 120]);
	$form->addTextArea('note', 'Poznámka:')
		
                ->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^+=\-%$<>\\\/?!&@;`\'"()[\]{}*\^#§]*')
                ->setHtmlAttribute('class', 'w-50 form-control form-control-sm')
                ->setOption('div', 'col-8')
                ->setMaxLength(255);
        $form->addCheckbox('floating', 'Plovoucí služba')
                ->setHtmlAttribute('class', 'form-check-input')
                ->setOption('div', 'form-check form-switch pt-3 ms-3');
        
        $form->addInteger('client_id')
                ->setHtmlAttribute('class', '')
                ->setOption('div', 'd-none'); 

        $form->addInteger('id')
                ->setHtmlAttribute('class', '')
                ->setOption('div', 'd-none'); 

        // Vykreslí v případě plovoucí služby
        if ($float == 1) {
            $dny = array (
                'Pondělí' => 'Pondělí',
                'Úterý' => 'Úterý',
                'Středa' => 'Středa',
                'Čtvrtek' => 'Ctvrtek',
                'Pátek' => 'Pátek',
            );
                    
            
            $form->addTime('float_from','Začátek od:')
                    ->setRequired()
                    ->setOption('div', 'col-4 ')

                    ->setHtmlAttribute('class', 'w-50 form-control form-control-sm');
            $form->addTime('float_to', 'Začátek do:')
                    ->setRequired()
                    ->setOption('div', 'col-4 ')
                    ->setHtmlAttribute('class', 'w-50 form-control form-control-sm');
            $form->addInteger('float_lenght', 'Délka služby:')
                    ->setRequired()
                    ->setOption('div', 'col-4 float')
                    ->setHtmlAttribute('class', 'w-50 form-control form-control-sm')
                    ->setHtmlAttribute('placeholder', 'v minutách')
                    ->addRule($form::Integer, 'Pole musí být číslo.')
                    ->addRule($form::Range, 'Délka musí být v rozsahu od %d do %d min.', [0, 480]);
            $form->addMultiSelect('float_days', 'Den:', $dny)
                    ->setRequired()
                    ->setOption('div', 'col-4 ')
                    ->setHtmlAttribute('class', 'w-50 form-select form-select-sm');
        }

        $form->addSubmit('send', 'Uložit')
                ->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary')
                ->setOption('div', 'col-1');
        
        $form->addSubmit('delete', 'Smazat')
                ->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary')
                ->setHtmlAttribute('onclick', 'return confirm(\'Opravdu chcete službu smazat?\')')
                ->setOption('div', 'col-1');
        
        $form->onValidate[] = $this->validateServiceForm(...);        
        $form->onSuccess[] = $this->serviceFormSucceeded(...);

	return $form;

    }

    /**
     * Zvaliduje zadané časy ve formuláři
     * @param Form $form
     * @return void
     */
    private function validateServiceForm(Form $form): void
    {
        $values = $form->getValues();

        if (isset($values['time_from'])) {
            $time_from = $values['time_from'];
            $time_to = $values['time_to'];

            if ($time_from >= $time_to) {
                $form->addError('Čas do nesmí být dříve než čas od.');
            }
        }
        if (isset($values['float_from'])) {
            $float_from = $values['float_from'];
            $float_to = $values['float_to'];
            
                if ($float_from >= $float_to) {
                $form->addError('Začátek do nesmí být dříve než začátek od.');
            }
        }
    }
    
    /**
     * Uloží novou službu nebo upraví/smaže stávající. 
     * @param array $data
     * @return void
     */
    private function serviceFormSucceeded(Form $form, array $data): void
    {
        $floatDays = null;
        $serviceId = null;
        if (isset($data['id'])) $serviceId = $data['id'];
        
        if (isset($data['float_days'])) {
            $floatDays = $data['float_days'];
            unset($data['float_days']); // Odstraní pole float_days
        }
        // Editace nebo vložení nové služby
        if (isset($form['send']) && ($form['send']->isSubmittedBy()))  {
        
            // Editace služby
            if ($serviceId) {
                
                $service = $this->db->getById('services', $serviceId);
                $service->update($data);
                
                // Uloží plovoucí dny z multiselect boxu
                $this->floatDays($serviceId, $floatDays);
                
                $form->getPresenter()->flashMessage("Záznam uložen", 'alert-success');
                $form->getPresenter()->redirect('Service:edit', $serviceId);

            // Vložení nové služby
            } else {        

                $newId = $this->database->table('services')->insert($data)->getPrimary();
                $form->getPresenter()->flashMessage("Záznam uložen", 'alert-success');
                $form->getPresenter()->redirect('Service:edit', $newId);

            }

        // Vymaže službu
        } elseif (isset($form['delete']) && ($form['delete']->isSubmittedBy()) ) {
            if ($serviceId) {
                $form->getPresenter()->redirect('Service:delete', $serviceId, $data['client_id'] );
            }
        }
    }
    /**
     * Uloží vybrané dny pro plovoucí službu
     * @param type $serviceId
     * @param type $floatDays
     */
    private function floatDays($serviceId, $floatDays = null) 
    {
        if ($floatDays) {
            // Vymaže předchozí uložené dny / podle služby
            $this->database->table('float_days')->where('service_id', $serviceId)->delete();

            // Uložení plovoucích dnů
            foreach ($floatDays as $day) {
                $data = array (
                    'service_id' => $serviceId,
                    'float_days' => $day,
                );
                $this->db->insert('float_days', $data);
            }
        }
    }
    
}    