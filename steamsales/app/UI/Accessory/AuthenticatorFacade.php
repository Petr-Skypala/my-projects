<?php
namespace App\UI\Accessory;

use Nette;
use Nette\Security\SimpleIdentity;
use Nette\Database\Explorer;
use Nette\Security\Passwords;


class AuthenticatorFacade implements Nette\Security\Authenticator
{
    private Explorer $database;
    private Passwords $passwords;

    public function __construct(
		Explorer $database,
		Passwords $passwords
	) {
	    $this->database = $database;
	    $this->passwords = $passwords;
	}
        /**
         * Vrátí identitu uživatele podle databáze
         * @param string $username
         * @param string $password
         * @return SimpleIdentity
         * @throws Nette\Security\AuthenticationException
         */
	public function authenticate(string $username, string $password): SimpleIdentity
	{
		$row = $this->database->table('user')
			->where('username', $username)
			->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('User not found.');
		}

		if (!$this->passwords->verify($password, $row->password)) {
			throw new Nette\Security\AuthenticationException('Invalid password.');
		}

		return new SimpleIdentity(
			$row->id,
			$row->role,
			['name' => $row->username,'active' => $row->active],
		);
	}
}
