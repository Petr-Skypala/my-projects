<?php
// source: C:\xampp\htdocs\rozvrhy/config/common.neon
// source: C:\xampp\htdocs\rozvrhy/config/services.neon
// source: array

/** @noinspection PhpParamsInspection,PhpMethodMayBeStaticInspection */

declare(strict_types=1);

class Container_a6874b59b3 extends Nette\DI\Container
{
	protected array $aliases = [
		'application' => 'application.application',
		'cacheStorage' => 'cache.storage',
		'database.default' => 'database.default.connection',
		'database.default.context' => 'database.default.explorer',
		'httpRequest' => 'http.request',
		'httpResponse' => 'http.response',
		'nette.cacheJournal' => 'cache.journal',
		'nette.database.default' => 'database.default',
		'nette.database.default.context' => 'database.default.explorer',
		'nette.httpRequestFactory' => 'http.requestFactory',
		'nette.latteFactory' => 'latte.latteFactory',
		'nette.mailer' => 'mail.mailer',
		'nette.presenterFactory' => 'application.presenterFactory',
		'nette.templateFactory' => 'latte.templateFactory',
		'nette.userStorage' => 'security.userStorage',
		'session' => 'session.session',
		'user' => 'security.user',
	];

	protected array $wiring = [
		'Nette\DI\Container' => [['container']],
		'Nette\Application\Application' => [['application.application']],
		'Nette\Application\IPresenterFactory' => [['application.presenterFactory']],
		'Nette\Application\LinkGenerator' => [['application.linkGenerator']],
		'Nette\Caching\Storages\Journal' => [['cache.journal']],
		'Nette\Caching\Storage' => [['cache.storage']],
		'Nette\Database\Connection' => [['database.default.connection']],
		'Nette\Database\IStructure' => [['database.default.structure']],
		'Nette\Database\Structure' => [['database.default.structure']],
		'Nette\Database\Conventions' => [['database.default.conventions']],
		'Nette\Database\Conventions\DiscoveredConventions' => [['database.default.conventions']],
		'Nette\Database\Explorer' => [['database.default.explorer']],
		'Nette\Http\RequestFactory' => [['http.requestFactory']],
		'Nette\Http\IRequest' => [['http.request']],
		'Nette\Http\Request' => [['http.request']],
		'Nette\Http\IResponse' => [['http.response']],
		'Nette\Http\Response' => [['http.response']],
		'Nette\Bridges\ApplicationLatte\LatteFactory' => [['latte.latteFactory']],
		'Nette\Application\UI\TemplateFactory' => [['latte.templateFactory']],
		'Nette\Bridges\ApplicationLatte\TemplateFactory' => [['latte.templateFactory']],
		'Nette\Mail\Mailer' => [['mail.mailer']],
		'Nette\Security\Passwords' => [['security.passwords']],
		'Nette\Security\UserStorage' => [['security.userStorage']],
		'Nette\Security\User' => [['security.user']],
		'Nette\Http\Session' => [['session.session']],
		'Tracy\ILogger' => [['tracy.logger']],
		'Tracy\BlueScreen' => [['tracy.blueScreen']],
		'Tracy\Bar' => [['tracy.bar']],
		'Nette\Routing\RouteList' => [['01']],
		'Nette\Routing\Router' => [['01']],
		'ArrayAccess' => [
			2 => [
				'01',
				'04',
				'05',
				'06',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.12',
				'application.13',
				'application.14',
				'013',
				'014',
				'015',
			],
		],
		'Nette\Application\Routers\RouteList' => [['01']],
		'Nette\Security\Authorizator' => [['02']],
		'Nette\Security\Permission' => [['02']],
		'Nette\Http\UrlImmutable' => [['03']],
		'Stringable' => [['03']],
		'JsonSerializable' => [['03']],
		'Nette\Http\UrlScript' => [['03']],
		'Nette\Application\UI\Control' => [
			2 => [
				'04',
				'05',
				'06',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.12',
				'application.13',
				'application.14',
				'013',
				'014',
				'015',
			],
		],
		'Nette\Application\UI\Component' => [
			2 => [
				'04',
				'05',
				'06',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.12',
				'application.13',
				'application.14',
				'013',
				'014',
				'015',
			],
		],
		'Nette\ComponentModel\Container' => [
			2 => [
				'04',
				'05',
				'06',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.12',
				'application.13',
				'application.14',
				'013',
				'014',
				'015',
			],
		],
		'Nette\ComponentModel\Component' => [
			2 => [
				'04',
				'05',
				'06',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.12',
				'application.13',
				'application.14',
				'013',
				'014',
				'015',
			],
		],
		'Nette\Application\UI\Renderable' => [
			2 => [
				'04',
				'05',
				'06',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.12',
				'application.13',
				'application.14',
				'013',
				'014',
				'015',
			],
		],
		'Nette\Application\UI\StatePersistent' => [
			2 => [
				'04',
				'05',
				'06',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.12',
				'application.13',
				'application.14',
				'013',
				'014',
				'015',
			],
		],
		'Nette\Application\UI\SignalReceiver' => [
			2 => [
				'04',
				'05',
				'06',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.12',
				'application.13',
				'application.14',
				'013',
				'014',
				'015',
			],
		],
		'Nette\ComponentModel\IContainer' => [
			2 => [
				'04',
				'05',
				'06',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.12',
				'application.13',
				'application.14',
				'013',
				'014',
				'015',
			],
		],
		'Nette\ComponentModel\IComponent' => [
			2 => [
				'04',
				'05',
				'06',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.12',
				'application.13',
				'application.14',
				'013',
				'014',
				'015',
			],
		],
		'App\UI\Carer\Edit\WorkHoursFormFactory' => [['04']],
		'App\UI\Carer\Edit\DoctorsFormFactory' => [['05']],
		'App\UI\Addresses\AddressesFormFactory' => [['06']],
		'Nette\Application\UI\Presenter' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\Application\IPresenter' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
				'application.15',
				'application.16',
			],
		],
		'App\UI\Carer\Create\CreatePresenter' => [2 => ['application.1']],
		'App\UI\Carer\Doctors\DoctorsPresenter' => [2 => ['application.2']],
		'App\UI\Carer\Edit\EditPresenter' => [2 => ['application.3']],
		'App\UI\Carer\List\ListPresenter' => [2 => ['application.4']],
		'App\UI\Client\Carers\CarersPresenter' => [2 => ['application.5']],
		'App\UI\Client\Create\CreatePresenter' => [2 => ['application.6']],
		'App\UI\Client\Edit\EditPresenter' => [2 => ['application.7']],
		'App\UI\Client\List\ListPresenter' => [2 => ['application.8']],
		'App\UI\Client\Service\ServicePresenter' => [2 => ['application.9']],
		'App\UI\Error\Error4xx\Error4xxPresenter' => [2 => ['application.10']],
		'App\UI\Error\Error5xx\Error5xxPresenter' => [2 => ['application.11']],
		'App\UI\Home\HomePresenter' => [2 => ['application.12']],
		'App\UI\User\Sign\SignPresenter' => [2 => ['application.13']],
		'App\UI\User\UserPresenter' => [2 => ['application.14']],
		'NetteModule\ErrorPresenter' => [2 => ['application.15']],
		'NetteModule\MicroPresenter' => [2 => ['application.16']],
		'Nette\Security\Authenticator' => [['07']],
		'Nette\Security\IAuthenticator' => [['07']],
		'App\UI\Accessory\AuthenticatorFacade' => [['07']],
		'App\UI\Accessory\AuthorizatorFactory' => [['08']],
		'App\UI\Accessory\DaysOrderFacade' => [['09']],
		'App\UI\Accessory\DbFacade' => [['010']],
		'App\UI\Accessory\QueryFacade' => [['011']],
		'App\UI\Addresses\TravelTimesFacade' => [['012']],
		'App\UI\Carer\Edit\CarersFormFactory' => [['013']],
		'App\UI\Client\Edit\ClientsFormFactory' => [['014']],
		'App\UI\Client\Service\ServiceFormFactory' => [['015']],
	];


	public function __construct(array $params = [])
	{
		parent::__construct($params);
	}


	public function createService01(): Nette\Application\Routers\RouteList
	{
		return App\Core\RouterFactory::createRouter();
	}


	public function createService02(): Nette\Security\Permission
	{
		return App\UI\Accessory\AuthorizatorFactory::create();
	}


	public function createService03(): Nette\Http\UrlScript
	{
		return new Nette\Http\UrlScript;
	}


	public function createService04(): App\UI\Carer\Edit\WorkHoursFormFactory
	{
		return new App\UI\Carer\Edit\WorkHoursFormFactory($this->getService('010'));
	}


	public function createService05(): App\UI\Carer\Edit\DoctorsFormFactory
	{
		return new App\UI\Carer\Edit\DoctorsFormFactory($this->getService('010'));
	}


	public function createService06(): App\UI\Addresses\AddressesFormFactory
	{
		return new App\UI\Addresses\AddressesFormFactory(
			$this->getService('010'),
			$this->getService('database.default.explorer'),
			$this->getService('012'),
		);
	}


	public function createService07(): App\UI\Accessory\AuthenticatorFacade
	{
		return new App\UI\Accessory\AuthenticatorFacade(
			$this->getService('database.default.explorer'),
			$this->getService('security.passwords'),
		);
	}


	public function createService08(): App\UI\Accessory\AuthorizatorFactory
	{
		return new App\UI\Accessory\AuthorizatorFactory;
	}


	public function createService09(): App\UI\Accessory\DaysOrderFacade
	{
		return new App\UI\Accessory\DaysOrderFacade;
	}


	public function createService010(): App\UI\Accessory\DbFacade
	{
		return new App\UI\Accessory\DbFacade($this->getService('database.default.explorer'));
	}


	public function createService011(): App\UI\Accessory\QueryFacade
	{
		return new App\UI\Accessory\QueryFacade($this->getService('database.default.explorer'));
	}


	public function createService012(): App\UI\Addresses\TravelTimesFacade
	{
		return new App\UI\Addresses\TravelTimesFacade($this->getService('010'));
	}


	public function createService013(): App\UI\Carer\Edit\CarersFormFactory
	{
		return new App\UI\Carer\Edit\CarersFormFactory($this->getService('database.default.explorer'), $this->getService('010'));
	}


	public function createService014(): App\UI\Client\Edit\ClientsFormFactory
	{
		return new App\UI\Client\Edit\ClientsFormFactory($this->getService('database.default.explorer'), $this->getService('010'));
	}


	public function createService015(): App\UI\Client\Service\ServiceFormFactory
	{
		return new App\UI\Client\Service\ServiceFormFactory($this->getService('010'), $this->getService('database.default.explorer'));
	}


	public function createServiceApplication__1(): App\UI\Carer\Create\CreatePresenter
	{
		$service = new App\UI\Carer\Create\CreatePresenter($this->getService('013'));
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__10(): App\UI\Error\Error4xx\Error4xxPresenter
	{
		$service = new App\UI\Error\Error4xx\Error4xxPresenter;
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__11(): App\UI\Error\Error5xx\Error5xxPresenter
	{
		return new App\UI\Error\Error5xx\Error5xxPresenter($this->getService('tracy.logger'));
	}


	public function createServiceApplication__12(): App\UI\Home\HomePresenter
	{
		$service = new App\UI\Home\HomePresenter;
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__13(): App\UI\User\Sign\SignPresenter
	{
		$service = new App\UI\User\Sign\SignPresenter(
			$this->getService('security.passwords'),
			$this->getService('07'),
			$this->getService('010'),
		);
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__14(): App\UI\User\UserPresenter
	{
		$service = new App\UI\User\UserPresenter($this->getService('security.passwords'), $this->getService('010'));
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__15(): NetteModule\ErrorPresenter
	{
		return new NetteModule\ErrorPresenter($this->getService('tracy.logger'));
	}


	public function createServiceApplication__16(): NetteModule\MicroPresenter
	{
		return new NetteModule\MicroPresenter($this, $this->getService('http.request'), $this->getService('01'));
	}


	public function createServiceApplication__2(): App\UI\Carer\Doctors\DoctorsPresenter
	{
		$service = new App\UI\Carer\Doctors\DoctorsPresenter($this->getService('010'), $this->getService('011'), $this->getService('09'));
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__3(): App\UI\Carer\Edit\EditPresenter
	{
		$service = new App\UI\Carer\Edit\EditPresenter(
			$this->getService('010'),
			$this->getService('04'),
			$this->getService('06'),
			$this->getService('05'),
			$this->getService('013'),
		);
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__4(): App\UI\Carer\List\ListPresenter
	{
		$service = new App\UI\Carer\List\ListPresenter($this->getService('010'), $this->getService('09'), $this->getService('011'));
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__5(): App\UI\Client\Carers\CarersPresenter
	{
		$service = new App\UI\Client\Carers\CarersPresenter($this->getService('010'), $this->getService('database.default.explorer'));
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__6(): App\UI\Client\Create\CreatePresenter
	{
		$service = new App\UI\Client\Create\CreatePresenter($this->getService('014'));
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__7(): App\UI\Client\Edit\EditPresenter
	{
		$service = new App\UI\Client\Edit\EditPresenter($this->getService('010'), $this->getService('06'), $this->getService('014'));
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__8(): App\UI\Client\List\ListPresenter
	{
		$service = new App\UI\Client\List\ListPresenter($this->getService('010'), $this->getService('011'), $this->getService('09'));
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__9(): App\UI\Client\Service\ServicePresenter
	{
		$service = new App\UI\Client\Service\ServicePresenter(
			$this->getService('database.default.explorer'),
			$this->getService('010'),
			$this->getService('015'),
		);
		$service->injectPrimary(
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__application(): Nette\Application\Application
	{
		$service = new Nette\Application\Application(
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
		);
		Nette\Bridges\ApplicationDI\ApplicationExtension::initializeBlueScreenPanel(
			$this->getService('tracy.blueScreen'),
			$service,
		);
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\ApplicationTracy\RoutingPanel(
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('application.presenterFactory'),
		));
		return $service;
	}


	public function createServiceApplication__linkGenerator(): Nette\Application\LinkGenerator
	{
		return new Nette\Application\LinkGenerator(
			$this->getService('01'),
			$this->getService('http.request')->getUrl()->withoutUserInfo(),
			$this->getService('application.presenterFactory'),
		);
	}


	public function createServiceApplication__presenterFactory(): Nette\Application\IPresenterFactory
	{
		$service = new Nette\Application\PresenterFactory(new Nette\Bridges\ApplicationDI\PresenterFactoryCallback(
			$this,
			5,
			'C:\xampp\htdocs\rozvrhy/temp/cache/nette.application/touch',
		));
		$service->setMapping(['*' => 'App\UI\*\**Presenter']);
		return $service;
	}


	public function createServiceCache__journal(): Nette\Caching\Storages\Journal
	{
		return new Nette\Caching\Storages\SQLiteJournal('C:\xampp\htdocs\rozvrhy/temp/cache/journal.s3db');
	}


	public function createServiceCache__storage(): Nette\Caching\Storage
	{
		return new Nette\Caching\Storages\FileStorage('C:\xampp\htdocs\rozvrhy/temp/cache', $this->getService('cache.journal'));
	}


	public function createServiceContainer(): Nette\DI\Container
	{
		return $this;
	}


	public function createServiceDatabase__default__connection(): Nette\Database\Connection
	{
		$service = new Nette\Database\Connection(
			'mysql:host=127.0.0.1;dbname=dev_schedule',
			/*sensitive{*/'root'/*}*/,
			/*sensitive{*/'password123'/*}*/,
			[],
		);
		Nette\Bridges\DatabaseTracy\ConnectionPanel::initialize(
			$service,
			true,
			'default',
			true,
			$this->getService('tracy.bar'),
			$this->getService('tracy.blueScreen'),
		);
		return $service;
	}


	public function createServiceDatabase__default__conventions(): Nette\Database\Conventions\DiscoveredConventions
	{
		return new Nette\Database\Conventions\DiscoveredConventions($this->getService('database.default.structure'));
	}


	public function createServiceDatabase__default__explorer(): Nette\Database\Explorer
	{
		return new Nette\Database\Explorer(
			$this->getService('database.default.connection'),
			$this->getService('database.default.structure'),
			$this->getService('database.default.conventions'),
			$this->getService('cache.storage'),
		);
	}


	public function createServiceDatabase__default__structure(): Nette\Database\Structure
	{
		return new Nette\Database\Structure($this->getService('database.default.connection'), $this->getService('cache.storage'));
	}


	public function createServiceHttp__request(): Nette\Http\Request
	{
		return $this->getService('http.requestFactory')->fromGlobals();
	}


	public function createServiceHttp__requestFactory(): Nette\Http\RequestFactory
	{
		$service = new Nette\Http\RequestFactory;
		$service->setProxy([]);
		return $service;
	}


	public function createServiceHttp__response(): Nette\Http\Response
	{
		$service = new Nette\Http\Response;
		$service->cookieSecure = $this->getService('http.request')->isSecured();
		return $service;
	}


	public function createServiceLatte__latteFactory(): Nette\Bridges\ApplicationLatte\LatteFactory
	{
		return new class ($this) implements Nette\Bridges\ApplicationLatte\LatteFactory {
			public function __construct(
				private Container_a6874b59b3 $container,
			) {
			}


			public function create(): Latte\Engine
			{
				$service = new Latte\Engine;
				$service->setTempDirectory('C:\xampp\htdocs\rozvrhy/temp/cache/latte');
				$service->setAutoRefresh(true);
				$service->setStrictTypes(true);
				$service->setStrictParsing(true);
				$service->enablePhpLinter(null);
				func_num_args() && $service->addExtension(new Nette\Bridges\ApplicationLatte\UIExtension(func_get_arg(0)));
				$service->addExtension(new Nette\Bridges\CacheLatte\CacheExtension($this->container->getService('cache.storage')));
				$service->addExtension(new Nette\Bridges\FormsLatte\FormsExtension);
				$service->addExtension(new App\UI\Accessory\LatteExtension);
				return $service;
			}
		};
	}


	public function createServiceLatte__templateFactory(): Nette\Bridges\ApplicationLatte\TemplateFactory
	{
		$service = new Nette\Bridges\ApplicationLatte\TemplateFactory(
			$this->getService('latte.latteFactory'),
			$this->getService('http.request'),
			$this->getService('security.user'),
			$this->getService('cache.storage'),
			null,
		);
		Nette\Bridges\ApplicationDI\LatteExtension::initLattePanel($service, $this->getService('tracy.bar'), false);
		return $service;
	}


	public function createServiceMail__mailer(): Nette\Mail\Mailer
	{
		return new Nette\Mail\SendmailMailer;
	}


	public function createServiceSecurity__passwords(): Nette\Security\Passwords
	{
		return new Nette\Security\Passwords('2y', ['cost' => 12]);
	}


	public function createServiceSecurity__user(): Nette\Security\User
	{
		$service = new Nette\Security\User($this->getService('security.userStorage'), $this->getService('07'), $this->getService('02'));
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\SecurityTracy\UserPanel($service));
		return $service;
	}


	public function createServiceSecurity__userStorage(): Nette\Security\UserStorage
	{
		return new Nette\Bridges\SecurityHttp\SessionStorage($this->getService('session.session'));
	}


	public function createServiceSession__session(): Nette\Http\Session
	{
		$service = new Nette\Http\Session($this->getService('http.request'), $this->getService('http.response'));
		$service->setOptions(['cookieSamesite' => 'Lax']);
		return $service;
	}


	public function createServiceTracy__bar(): Tracy\Bar
	{
		return Tracy\Debugger::getBar();
	}


	public function createServiceTracy__blueScreen(): Tracy\BlueScreen
	{
		return Tracy\Debugger::getBlueScreen();
	}


	public function createServiceTracy__logger(): Tracy\ILogger
	{
		return Tracy\Debugger::getLogger();
	}


	public function initialize(): void
	{
		// constants.
		(function () {
			define('Week_hours', 40);
			define('Day_hours', 8);
		})();
		// di.
		(function () {
			$this->getService('tracy.bar')->addPanel(new Nette\Bridges\DITracy\ContainerPanel($this));
		})();
		// http.
		(function () {
			$response = $this->getService('http.response');
			$response->setHeader('X-Powered-By', 'Nette Framework 3');
			$response->setHeader('Content-Type', 'text/html; charset=utf-8');
			$response->setHeader('X-Frame-Options', 'SAMEORIGIN');
			Nette\Http\Helpers::initCookie($this->getService('http.request'), $response);
		})();
		// session.
		(function () {
			$this->getService('session.session')->autoStart(false);
		})();
		// tracy.
		(function () {
			if (!Tracy\Debugger::isEnabled()) { return; }
			$logger = $this->getService('tracy.logger');
			if ($logger instanceof Tracy\Logger) $logger->mailer = [
				new Tracy\Bridges\Nette\MailSender(
					$this->getService('mail.mailer'),
					null,
					$this->getByType('Nette\Http\Request', false)?->getUrl()->getHost(),
				),
				'send',
			];
		})();
	}
}
