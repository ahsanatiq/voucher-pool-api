<?php
namespace App;

use App\Exceptions\ExceptionHandler;
use Illuminate\Config\Repository as ConfigRepository;
use Symfony\Component\Finder\Finder;

class Application extends \Slim\App
{
    public static $instance;
    public static $container;
    public $config;
    public $settings;
    public $db;

    private function __construct()
    {
        if (self::$instance) {
            return self::$instance;
        }
        $this->loadProperEnvironment();
        $this->loadConfig();
        parent::__construct(['settings' => $this->settings]);
        self::$container = $this->getContainer();
        $this->registerConfig();
        $this->registerDependencies();
        $this->registerMiddlewares();
        $this->registerRoutes();
        $this->registerRepositories();
        self::$instance = $this;
    }

    public static function getContainerInstance()
    {
        return self::$container;
    }

    public static function getInstance()
    {
        if(self::$instance)
        {
            return self::$instance;
        }
        return new self;
    }

    // public function run()
    // {
    //     try {
    //         return parent::run(false);
    //     } catch (\Exception $e) {
    //         ExceptionHandler::handle($e);
    //     }
    // }

    private function loadConfig()
    {
        $configItems = [];
        $finder = (new Finder)->files()->in(__DIR__.'/../config/');
        foreach ($finder as $file) {
            $configItems = array_merge($configItems, [
                $file->getBasename('.php') => require($file->getRealPath())
            ]);
        }
        $this->config = new ConfigRepository();
        $this->config->set($configItems);
        $this->settings = $configItems['app']??[];
        foreach($configItems as $key => $config) {
            if($key!='app') {
                $this->settings[$key] = $config;
            }
        }
    }

    private function registerConfig()
    {
        self::$container['config'] = $this->config;
    }

    private function registerDependencies()
    {
        $finder = (new Finder)->files()->in(__DIR__ . '/../dependencies/');
        foreach ($finder as $file) {
            self::$container[$file->getBasename('.php')] = function($container) use ($file) {
                return require($file->getRealPath());
            };
        }
    }

    private function registerRoutes()
    {
        $finder = (new Finder)->files()->in(__DIR__.'/../routes/');
        $app = $this; // $app instance is used inside each route
        foreach ($finder as $file) {
            require($file->getRealPath());
        }
    }

    private function registerMiddlewares()
    {
        $finder = (new Finder)->files()->in(__DIR__ . '/Middlewares/');
        foreach ($finder as $file) {
            $class = '\\App\\Middlewares\\'.$file->getBasename('.php').'';
            $this->add(new $class);
        }
    }

    private function registerRepositories()
    {
        // $this->container->bind(
        //     \App\Repositories\Contracts\RecipeRepositoryInterface::class,
        //     \App\Repositories\Eloquent\RecipeRepository::class
        // );
    }

    public function loadProperEnvironment()
    {
        if (isset($_SERVER['HTTP_APP_ENV']) && !empty($_SERVER['HTTP_APP_ENV'])) {
            $envFile = __DIR__ . '/../.env.' . $_SERVER['HTTP_APP_ENV'];
        } else {
            $commandArgs = parseCliArguments();
            if (isset($commandArgs['env']) && !empty($commandArgs['env'])) {
                $envFile = __DIR__ . '/../.env.' . $commandArgs['env'];
            }
        }
        $envFile = $envFile ?? __DIR__ . '/../.env';
        if (file_exists($envFile)) {
            loadEnvironmentFromFile($envFile);
        }
    }
}
