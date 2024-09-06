<?php
namespace App\UI\Accessory;

use Nette\Security\Permission;

class AuthorizatorFactory
{
        /**
         * Definování rolí, zdrojí a akcí
         * @return Permission
         */
    	public static function create(): Permission
	{
		$acl = new Permission;
		$acl->addRole('guest');
                $acl->addRole('Pečovatel/ka');
                $acl->addRole('Koordinátor/ka', 'Pečovatel/ka');
                $acl->addRole('admin', 'Koordinátor/ka');
                
		$acl->addResource('carers');
                $acl->addResource('blogy');
                $acl->addResource('users');
                
                $acl->allow('guest', 'carers', 'view');
		$acl->allow('Pečovatel/ka', ['carers', 'blogy'], 'view');
                $acl->allow('Koordinátor/ka', 'users', 'view');
                
		return $acl;
	}
}
