<?php
namespace App\UI\Accessory;

use Nette\Security\Permission;

#[Requires(sameOrigin: true)]
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
                $acl->addRole('Pečovatel/ka', 'guest');
                $acl->addRole('Koordinátor/ka', 'Pečovatel/ka');
                $acl->addRole('admin', 'Koordinátor/ka');
                
		$acl->addResource('carers');
                $acl->addResource('clients');
                $acl->addResource('users');
                
                // Pečovatelka může nahlížet na přehledy
		$acl->allow('Pečovatel/ka', ['carers', 'clients'], 'view');
                // Koordinátorka může editovat
                $acl->allow('Koordinátor/ka', ['carers', 'clients'], 'edit');
                
		return $acl;
	}
}
