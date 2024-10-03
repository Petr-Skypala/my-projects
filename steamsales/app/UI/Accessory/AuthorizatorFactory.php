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
                $acl->addRole('user', 'guest');
                $acl->addRole('admin', 'user');
                
                
		$acl->addResource('sales');
                $acl->addResource('users');
                
                // Uživatel může vkládat a editovat výprodeje
		$acl->allow('user', ['sales'], 'edit');
                // Admin může vkládat a editovat uživatele + stejné jako uživatel
                $acl->allow('admin', ['users'], 'edit');
                
		return $acl;
	}
}
