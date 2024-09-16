<?php
namespace App\UI\User;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\Passwords;
use App\UI\Accessory\DbFacade;

#[Requires(sameOrigin: true)]
final class UserPresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     * @param Passwords $passwords
     * @param DbFacade $db
     */
    public function __construct(
        private Passwords $passwords,
        private DbFacade $db
    )  {
        parent::__construct();
    }
    /**
     * Ověření uživatele
     */
    protected function startup()
    {
	parent::startup();
	if (!$this->getUser()->isLoggedIn()) {
		$this->redirect(':User:Sign:in');
	}
        
        if (!$this->getUser()->isAllowed('users', 'view')) {
                $this->flashMessage('Nemáte dostatečná práva.', 'alert-warning');
                $this->redirect(':Home:default');
	}
    }
    
    /**
     * Formulář pro založení nového uživatele
     * @return Form
     */
    protected function createComponentNewUserForm() : Form
    {
        $form = new Form;
        $form->addText('username', 'Uživatelské jméno:')
                ->setRequired('Prosím vyplňte své uživatelské jméno.');

        $form->addEmail('email', 'Email:')
                ->setRequired('Zadejte platnou emailovou adresu.');        

        $form->addPassword('password', 'Heslo:')
                ->setRequired('Prosím vyplňte své heslo.')
                ->addRule($form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků.', 8);
        
        $form->addPassword('passwordVerify', 'Potvrzení hesla:')
            ->setRequired('Zadejte heslo znovu pro ověření.')
            ->addRule($form::EQUAL, 'Hesla se neshodují.', $form['password'])
            ->setOmitted();

        $form->addSelect('role', 'Role:', [
                'Pečovatel/ka' => 'Pečovatel/ka',
                'Koordinátor/ka' => 'Koordinátor/ka',
                'admin' => 'Admin',
            ])
            ->setPrompt('Vyberte roli')
            ->setRequired('Vyberte roli uživatele.');
        

        $form->addSubmit('register', 'Vložit');
        
        $form->onValidate[] = $this->validateNewUserForm(...);

        $form->onSuccess[] = $this->userFormSucceeded(...);
        return $form;
        
    }
    /**
     * Zvaliduje zdali uživatelské jméno není již použité
     * @param Form $form
     * @param array $data
     * @return void
     */
    private function validateNewUserForm(Form $form): void
    {
        $values = $form->getValues();
        $exists = $this->db->getAll('users')->where('username', $values['username'])->fetch();
        if ($exists) {
                $this->flashMessage('Tento uživatel již existuje : ' . $values['username'], 'alert-warning');
                $this->redirect('this');
        }
    }    
    /**
     * Vloží nového uživatele do databáze
     * @param array $data
     * @return void
     */
    private function userFormSucceeded(array $data): void
    {
       
        $data['password'] = $this->passwords->hash($data['password']);
        $this->db->insert('users', $data);
        $this->flashMessage('Nový uživatel byl úspěšně založený', 'alert-success');
        $this->redirect('this');
    }
}