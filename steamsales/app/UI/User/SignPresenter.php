<?php

declare(strict_types=1);

namespace App\UI\User;

use Nette;
use Nette\Application\UI\Form;
use App\UI\Accessory\AuthenticatorFacade;
use Nette\Security\AuthenticationException;

final class SignPresenter extends Nette\Application\UI\Presenter
{

    private AuthenticatorFacade $authenticator;

    /**
     * Konstruktor
     * @param AuthenticatorFacade $authenticator
     */
    public function __construct(
        
        AuthenticatorFacade $authenticator
        
    )  {
        parent::__construct();
	$this->authenticator = $authenticator;
    }

    /**
     * Kompomenta formuláře pro přihlášení do systému
     * @return Form
     */
    protected function createComponentSignInForm(): Form
    {
        $form = new Form;
        $form->addText('username', 'Uživatelské jméno:')
                ->setRequired('Prosím vyplňte své uživatelské jméno.')
		->addRule($form::Pattern, 'Uživatelské jméno: puze malá a velká písmena bez diakritiky a číslice', '^[a-zA-Z0-9.]+$')
                ->setHtmlAttribute('class', 'form-control form-control-sm');

        $form->addPassword('password', 'Heslo:')
                ->setRequired('Prosím vyplňte své heslo.')
		->addRule($form::Pattern, 'Pole nesmí obsahovat speciální znaky', '[^=\-%<>\\\/&;`\'"*\^]*')
                ->setHtmlAttribute('class', 'form-control form-control-sm');

        $form->addSubmit('send', 'Přihlásit')
                ->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary');

        $form->onSuccess[] = function(array $data) {
	    $this->signInFormSucceeded($data);
	};
	$form->addProtection();
	
        return $form;
    }
    /**
     * Ověří přihlašovací údaje a přihlásí uživatele
     * @param array $data
     * @return void
     */
    private function signInFormSucceeded(array $data): void
    {
	try {
		$identity = $this->authenticator->authenticate($data['username'], $data['password']);

		// Neaktivní uživatel nebude přihlášený
                if ($identity->active == 0) throw new AuthenticationException();

                $this->getUser()->login($identity);

                $this->flashMessage('Přihlášení proběhlo úspěšně', 'alert-success');
		$this->redirect(':Admin:Admin:default');

	} catch (AuthenticationException $e) {
		$this->flashMessage('Uživatelské jméno nebo heslo je nesprávné', 'alert-warning');

	}
    }
    /**
     * Odhlásí uživatele
     * @return void
     */
    public function actionOut(): void
    {
	$this->getUser()->logout();
	$this->flashMessage('Odhlášení bylo úspěšné.', 'alert-success');
	$this->forward('Sign:in');
    }

    
}
