<?php

declare(strict_types=1);

namespace App\UI\User;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;
use App\UI\Accessory\DbFacade;
use Nette\Database\Explorer;
use Nette\Security\Passwords;

final class UserFormFactory extends Control
{
    private Explorer $explorer;
    private DbFacade $db;
    private Passwords $passwords;
    
    private Array $roles;

    /**
     * Konstruktor
     * @param Explorer $explorer
     * @param DbFacade $db
     * @param Passwords $passwords
     */
    public function __construct(
        
        Explorer $explorer,
        DbFacade $db,
	Passwords $passwords

    )  {
	$this->explorer = $explorer;
	$this->db = $db;
	$this->passwords = $passwords;
	$this->roles = array (
                'user' => 'Uživatel',
                'admin' => 'Admin',
	);
    }
    /**
     * Vygeneruje formulář uživatele
     * @return Form
     */
    public function create(): Form
    {
        $form = new Form;

        $form->addText('first_name', 'Jméno:')
		->setHtmlAttribute('class', 'form-control form-control-sm')
                ->setRequired('Prosím vyplňte své jméno.')
		->addRule($form::Pattern, 'Jméno může obsahovat pouze písmena', '^[a-zA-Zá-žÁ-Ž ]+$');

        $form->addText('last_name', 'Příjmení:')
		->setHtmlAttribute('class', 'form-control form-control-sm')
                ->setRequired('Prosím vyplňte své příjmení.')
		->addRule($form::Pattern, 'Příjmení může obsahovat pouze písmena', '^[a-zA-Zá-žÁ-Ž ]+$');

        $form->addText('username', 'Uživatelské jméno:')
		->setHtmlAttribute('class', 'form-control form-control-sm')
                ->setRequired('Prosím vyplňte své uživatelské jméno.')
		->addRule($form::Pattern, 'Uživatelské jméno: malá a velká písmena bez diakritiky a číslice', '^[a-zA-Z0-9.]+$');

        $form->addPassword('password', 'Heslo:')
		->setHtmlAttribute('class', 'form-control form-control-sm')
		->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^=\-%<>\\\/&;`\'"*\^]*')
                ->setRequired('Prosím vyplňte své heslo.')
                ->addRule($form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků.', 8);
        
        $form->addPassword('passwordVerify', 'Potvrzení hesla:')
		->setHtmlAttribute('class', 'form-control form-control-sm')
		->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^=\-%<>\\\/&;`\'"*\^]*')
		->setRequired('Zadejte heslo znovu pro ověření.')
		->addRule($form::EQUAL, 'Hesla se neshodují.', $form['password'])
		->setOmitted();

        $form->addSelect('role', 'Role:', $this->roles)
            ->setPrompt('Vyberte roli')
	    ->setHtmlAttribute('class', 'form form-select form-select-sm')
            ->setRequired('Vyberte roli uživatele.');

        $form->addSelect('active', 'Aktivní:', [
			                '1' => 'Aktivní',
			                '0' => 'Neaktivní',
					])
	    ->setHtmlAttribute('class', 'form form-select form-select-sm')
            ->setRequired('Vyberte aktivní/neaktivní uživatel.');

        $form->addInteger('id')
                ->setHtmlType('hidden');
        
	$form->addProtection();

        $form->addSubmit('register', 'Vložit')
		->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary');
        
        $form->onValidate[] = function(Form $form, array $data) {
	    $this->validateNewUserForm($form, $data);
	};

        $form->onSuccess[] = function(Form $form, array $data) {
	    $this->userFormSucceeded($form, $data);
	};
        return $form;
    }
    /**
     * Zvaliduje, jestli uživatelské jméno není obsazené
     * @param Form $form
     * @param array $data
     * @return void
     */
    private function validateNewUserForm(Form $form, array $data): void
    {	
	// Pokud se jedná o vložení nového uživatele
	if (!isset($data['id'])) {
	    $values = $form->getValues();
	    $exists = $this->db->getAll('user')->where('username', $values['username'])->fetch();
	    if ($exists) {
		    $form->getPresenter()->flashMessage('Tento uživatel již existuje : ' . $values['username'], 'alert alert-warning');
		    $form->getPresenter()->redirect('this');
	    }
	}
    }    
    /**
     * Vloží nebo upraví data uživatele do databáze
     * @param Form $form
     * @param array $data
     * @return void
     */
    private function userFormSucceeded(Form $form, array $data): void
    {
	// Založí nového uživatele
	if (!isset($data['id'])) {
	    $data['password'] = $this->passwords->hash($data['password']);
	    $this->db->insert('user', $data);
	    $form->getPresenter()->flashMessage('Nový uživatel byl úspěšně založený', 'alert-success');
	    $form->getPresenter()->redirect('this');
	// Upraví stávajícího uživatele
	} else {
	    $user = $this->db->getById('user', $data['id']);
	    $data['password'] = $this->passwords->hash($data['password']);
	    $user->update($data);
	    $form->getPresenter()->flashMessage('Změny byly uložené', 'alert-success');
	}
    }

}