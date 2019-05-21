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
        $this->registerServices();
        $this->registerTransformers();
        $this->registerModels();
        $this->registerControllers();
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
        $finder = (new Finder)->files()->in(__DIR__ . '/Repositories/Collection');
        foreach ($finder as $file) {
            self::$container[$file->getBasename('.php')] = function ($container) use ($file) {
                $class = '\\App\\Repositories\\Collection\\'.$file->getBasename('.php').'';
                return new $class($container);
            };
        }
        $finder = (new Finder)->files()->in(__DIR__ . '/Repositories/Contracts');
        foreach ($finder as $file) {
            self::$container[$file->getBasename('.php')] = function ($container) use ($file) {
                $class = '\\App\\Repositories\\Contracts\\'.$file->getBasename('.php').'';
                return new $class($container);
            };
        }
        $finder = (new Finder)->files()->in(__DIR__ . '/Repositories/Eloquent');
        foreach ($finder as $file) {
            self::$container[$file->getBasename('.php')] = function ($container) use ($file) {
                $class = '\\App\\Repositories\\Eloquent\\'.$file->getBasename('.php').'';
                return new $class($container);
            };
        }
    }

    private function registerServices()
    {
        $finder = (new Finder)->files()->in(__DIR__ . '/Services');
        foreach ($finder as $file) {
            self::$container[$file->getBasename('.php')] = function ($container) use ($file) {
                $class = '\\App\\Services\\'.$file->getBasename('.php').'';
                return new $class($container);
            };
        }
        $finder = (new Finder)->files()->in(__DIR__ . '/Services/Validators');
        foreach ($finder as $file) {
            self::$container[$file->getBasename('.php')] = function ($container) use ($file) {
                $class = '\\App\\Services\\Validators\\'.$file->getBasename('.php').'';
                return new $class($container);
            };
        }
    }

    private function registerTransformers()
    {
        $finder = (new Finder)->files()->in(__DIR__ . '/Transformers');
        foreach ($finder as $file) {
            self::$container[$file->getBasename('.php')] = function ($container) use ($file) {
                $class = '\\App\\Transformers\\'.$file->getBasename('.php').'';
                return new $class;
            };
        }

    }

    private function registerModels()
    {
        $finder = (new Finder)->files()->in(__DIR__ . '/Models');
        foreach ($finder as $file) {
            self::$container[$file->getBasename('.php')] = function ($container) use ($file) {
                $class = '\\App\\Models\\'.$file->getBasename('.php').'';
                return new $class;
            };
        }

    }

    private function registerControllers()
    {
        $finder = (new Finder)->files()->in(__DIR__ . '/Controllers');
        foreach ($finder as $file) {
            self::$container[$file->getBasename('.php')] = function ($container) use ($file) {
                $class = '\\App\\Controllers\\'.$file->getBasename('.php').'';
                return new $class($container);
            };
        }

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
