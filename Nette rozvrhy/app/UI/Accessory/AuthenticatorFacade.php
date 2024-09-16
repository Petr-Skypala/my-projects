<?php
namespace App\UI\Accessory;

use Nette;
use Nette\Security\SimpleIdentity;

#[Requires(sameOrigin: true)]
class AuthenticatorFacade implements Nette\Security\Authenticator
{
	public function __construct(
		private Nette\Database\Explorer $database,
		private Nette\Security\Passwords $passwords,
	) {
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
		$row = $this->database->table('users')
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
			$row->role, // nebo pole více rolí
			['name' => $row->username],
		);
	}
}
