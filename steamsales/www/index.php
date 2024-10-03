<?php

declare(strict_types=1);



require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/nette/robot-loader/src/RobotLoader/RobotLoader.php';
//\vendor\nette\robot-loader\src\RobotLoader

use App\Bootstrap;
use Nette\Loaders\RobotLoader;

$loader = new RobotLoader;

// adresáře, které má RobotLoader indexovat (včetně podadresářů)
$loader->addDirectory(__DIR__ . '/../app');
$loader->addDirectory(__DIR__ . '/../app/UI/Home');
//$loader->addDirectory(__DIR__ . '/libs');

// nastavíme cachování do adresáře 'temp'
$loader->setTempDirectory(__DIR__ . '/../temp');
$loader->register(); // spustíme RobotLoader


$configurator = Bootstrap::boot();
$container = $configurator->createContainer();
$application = $container->getByType(Nette\Application\Application::class);
$application->run();
