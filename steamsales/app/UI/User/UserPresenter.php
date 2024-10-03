<?php
namespace App\UI\User;

use Nette;
use Nette\Application\UI\Form;
use App\UI\Accessory\DbFacade;
use App\UI\Accessory\FiltrFormFactory;
use Nette\Database\Explorer;
use Exception;

final class UserPresenter extends Nette\Application\UI\Presenter
{
    private Explorer $explorer;
    private DbFacade $db;
    private UserFormFactory $userForm;
    private FiltrFormFactory $filtrForm;

    /**
     * Konstruktor
     * @param DbFacade $db
     * @param Explorer $explorer
     * @param UserFormFactory $userForm
     * @param FiltrFormFactory $filtrForm
     */
    public function __construct(
        DbFacade $db,
	Explorer $explorer,
	UserFormFactory $userForm,
	FiltrFormFactory $filtrForm
    )  {
        parent::__construct();
	
	$this->db = $db;
	$this->explorer = $explorer;
	$this->userForm = $userForm;
	$this->filtrForm = $filtrForm;
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
        
        if (!$this->getUser()->isAllowed('users', 'edit')) {
                $this->flashMessage('Nemáte dostatečná práva.', 'alert-warning');
                $this->redirect(':Admin:Admin:default');
	}
    } 
    /**
     * Připraví data pro formulář editace uživatele
     * @param int $userId
     * @return void
     */
    public function actionEdit(int $userId): void
    {
	try {
	    $user = $this->db->getById('user', $userId);
	    $this->getComponent('userForm')
		->setDefaults($user);	    
	} catch (Exception $e) {
	    $this->flashMessage('Záznam nenalezen', 'alert-warning');
	}
    }
    /**
     * Vytvoří formulář pro uživatele
     * @return Form
     */
    protected function createComponentUserForm() : Form
    {
	return $this->userForm->create();
    }
    /**
     * Vytvoří formulář pro filtrování
     * @return Form
     */
    public function createComponentFiltrForm(): Form 
    {
	return $this->filtrForm->create();
    }
    /**
     * Vloží data do šablony vč. stránkování a filtrování
     * @param int $page
     * @param string $filtr
     * @return void
     */
    public function renderDefault(int $page = 1, string $filtr = null): void
    {
	$users = $this->explorer->table('user')->where('last_name LIKE ? OR first_name LIKE ?', '%'.$filtr.'%', '%'.$filtr.'%');

	$lastPage = 0;
	$this->template->users = $users->page($page, 15, $lastPage);
	
	$this->template->page = $page;
	$this->template->lastPage = $lastPage;
    }
}