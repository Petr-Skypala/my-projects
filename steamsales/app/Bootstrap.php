<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;
use Tracy\Debugger;


class Bootstrap
{
	public static function boot(): Configurator
	{
		$configurator = new Configurator;
		$rootDir = dirname(__DIR__);
		Debugger::$logDirectory = __DIR__ . '/../log';


		Debugger::$showBar = false;
		Debugger::enable(Debugger::DEVELOPMENT);

		//$configurator->setDebugMode('secret@23.75.345.200'); // enable for your remote IP

		$configurator->setTempDirectory($rootDir . '/temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->addDirectory(__DIR__ . '/UI/Home')
			->register();
		
		$configurator->addConfig($rootDir . '/config/common.neon');
		$configurator->addConfig($rootDir . '/config/services.neon');

		return $configurator;
	}
}
