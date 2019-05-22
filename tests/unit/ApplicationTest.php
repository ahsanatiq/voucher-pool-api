<?php
namespace Tests;

use Symfony\Component\Finder\Finder;

class ApplicationTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $app;

    public function _before()
    {
    }

    // tests
    public function testApplicationInstance()
    {
        $this->assertInstanceOf(
            \Slim\App::class,
            \App\Application::getInstance()
        );

        $class = new \ReflectionClass(\App\Application::class);
        $method = $class->getMethod('__construct');
        $this->assertTrue($method->isPrivate());
    }


    public function testContainerInstanceInsideApplication()
    {
        $this->assertInstanceOf(
            \Slim\Container::class,
            \App\Application::getContainerInstance()
        );
    }

    public function testContainerInstanceUsingHelpers()
    {
        $this->assertInstanceOf(
            \Slim\Container::class,
            container()
        );
    }

    public function testContainerSingletonInstanceUsingHelpers()
    {
        $this->assertSame(
            container(),
            container()
        );

        $this->assertSame(
            container(),
            \App\Application::getContainerInstance()
        );
    }

    public function testConfigInstanceInsideApplication()
    {
        $config = \App\Application::getInstance()->config;
        $this->assertInstanceOf(
            \Illuminate\Config\Repository::class,
            $config
        );
        $this->assertInstanceOf(
            \Illuminate\Config\Repository::class,
            config()
        );
        $this->assertSame($config, config());
    }

    public function testConfigVariablesInApplication()
    {
        $finder = (new Finder)->files()->in(codecept_root_dir('/config/'));
        $settings = container()->get('settings');

        foreach ($finder as $file) {
            $configVars = require($file->getRealPath());
            foreach($configVars as $key=>$var) {
                // test Illuminite/Config way
                $this->assertSame(config()->get( $file->getBasename('.php').'.'.$key ), $var);
                // test Slim/Container settings way
                if( $file->getBasename('.php') == 'app' ) {
                    $this->assertSame($settings[$key], $var);
                } else {
                    $this->assertSame($settings[$file->getBasename('.php')][$key], $var);
                }

            }
        }
    }

    public function testEnvironmentLoadingInApplication()
    {
        $envFile = file_exists( codecept_root_dir('.env') ) ? codecept_root_dir('.env') : codecept_root_dir('.env.dev');
        $envCurrent = parseEnvFile($envFile);
        $envDev = parseEnvFile(codecept_root_dir('.env.dev'));
        $envTesting = parseEnvFile(codecept_root_dir('.env.testing'));

        // test Current settings
        $GLOBALS['argv'] = [];
        $_SERVER['HTTP_APP_ENV'] = '';
        app()->loadProperEnvironment();
        foreach($envCurrent as $key => $var) {
            $this->assertSame(getenv($key),$var);
        }

        // test HTTP Header
        $_SERVER['HTTP_APP_ENV'] = 'testing';
        app()->loadProperEnvironment();
        foreach ($envTesting as $key => $var) {
            $this->assertSame(getenv($key), $var);
        }

        // test CLI argument
        $_SERVER['HTTP_APP_ENV'] = '';
        $GLOBALS['argv'] = ['index.php','--env=dev'];
        app()->loadProperEnvironment();
        foreach ($envDev as $key => $var) {
            $this->assertSame(getenv($key), $var);
        }
    }

    public function testApplicationSingletonInstances()
    {
        $app1 = \App\Application::getInstance();
        $app2 = \App\Application::getInstance();
        $this->assertSame(
            $app1,
            $app2
        );
    }

    public function testApplicationSingletonInstancesUsingHelpers()
    {
        $app1 = app();
        $app2 = app();
        $this->assertSame(
            $app1,
            $app2
        );

        $app1 = app();
        $app2 = \App\Application::getInstance();
        $this->assertSame(
            $app1,
            $app2
        );
    }

    public function testDependenciesInApplication()
    {
        $finder = (new Finder)->files()->in(codecept_root_dir('/dependencies/'));
        foreach ($finder as $file) {
            $this->assertTrue(container()->has($file->getBasename('.php')));
        }
    }


}
