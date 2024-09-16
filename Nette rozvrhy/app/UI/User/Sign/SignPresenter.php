<?php

declare(strict_types=1);

namespace App\UI\User\Sign;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\Passwords;
use App\UI\Accessory\AuthenticatorFacade;
use App\UI\Accessory\DbFacade;

#[Requires(sameOrigin: true)]
final class SignPresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param Passwords $passwords
     * @param AuthenticatorFacade $authenticator
     * @param DbFacade $db
     */
    public function __construct(
        private Passwords $passwords,
        private AuthenticatorFacade $authenticator,
        private DbFacade $db
    )  {
        parent::__construct();
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
                ->setHtmlAttribute('class', 'form-control form-control-sm');

        $form->addPassword('password', 'Heslo:')
                ->setRequired('Prosím vyplňte své heslo.')
                ->setHtmlAttribute('class', 'form-control form-control-sm');

        $form->addSubmit('send', 'Přihlásit')
                ->setHtmlAttribute('class', ' btn btn-sm btn-outline-secondary');

        $form->onSuccess[] = $this->signInFormSucceeded(...);
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
                $this->getUser()->login($identity);
                
                $this->flashMessage('Přihlášení proběhlo úspěšně', 'alert-success');
		$this->redirect(':Home:');

	} catch (Nette\Security\AuthenticationException $e) {
		$this->flashMessage('Uživatelské jméno nebo heslo je nesprávné', 'alert-danger');

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
	$this->redirect(':Home:');
    }

    
}
