# Voucher Pool API Service (slimframework)

A simple api service application to consume vouchers from the pool. This is for demo purposes and created to demonstrate architectural & programming skills.


##### Overview:

- **Nginx Container:** This service will act as an API gateway and it will route all the calls to the appropriate services ie PHP-FPM.
- **PHP-FPM Container:** This service will serve all the voucher related API endpoints.
- **MySQL Container:** This database container will store all the voucher related data, hence will be accessed and consumed by php-fpm container.

> Below are the key-design points, and how its been handled & implemented.

##### Packages Depending Management:

[Composer](https://getcomposer.org) is used to manage all the dependencies of the application. All the required packages / libraries are declared in the `composer.json` file. And can be installed by using the `composer install` command.

##### Application Entry Point:

The application entry is pointed at `public` directory, which holds only the `index.php` file and can also have assets files which can be accessed publicly. Other than this, no code or file outside this folder can be accessed directly. The idea is to protect all the files outside this directory.

##### Simple Routing with Middleware Support:

All the requests and how they need to be handled are defined in the `routes/api.php`.

##### Database & Migration:

To interact with the mySQL, we've used [Illuminate Database](https://github.com/illuminate/database) aka "Eloquent". It allows us to interact with our database via Object Relational Mapping "ORM".

To migrate & seed the database, we've used framework agnostic package [Phinx](https://github.com/robmorgan/phinx). Over the period of time application code evolves and database also evolves with it. To keep track of the code changes we use source versioning tools like git. With the migration scripts we can also keep track of the database changes. Specially helpful when working in a team environment. When team-mates pull your changes, if they see the migration scripts they can simply run it with the simple command to upgrade their local database schema changes.

##### Class Dependency Injection & Service Container:

For managing class dependencies and performing dependency injection, we've used `SlimFramwork Container`. With this we can invert the control of dependencies from application to class hence the pattern "Inversion of Control".

##### Simple Application Configuration Management & Environment Variables:

For handling the configuration settings for application, we've used the [Illuminate Config](https://github.com/illuminate/config). All the configurations are stored in the `config` directory. Also used [Symfony Dotenv](https://github.com/symfony/dotenv) to load the variables defined in `.env` file, then access them via getenv() function. This is useful to have different configuration settings for each environment i-e dev, staging, production.

##### Contextual Logging:

To understand about what's happening within our application, we've used [Monolog](https://github.com/Seldaek/monolog) library which provides robust logging services that allow you to log messages.

##### Validation of HTTP Request:

To validate your application's incoming HTTP request data, We've used [Illuminate Validation](https://github.com/illuminate/validation), which provides a variety of powerful validation rules.

##### Standard & Consistent Output of API HTTP Response:

To provide a standard & consistent output of API response data, we've used [League Fractal](https://github.com/league/fractal), so we can have presentation and transformation layer for our output data. All the transformation classes are stored in the `app/Transformers` directory.

##### Unit Testing:

To test our application service, we've used [Codeception](https://github.com/codeception/codeception), Out of the box it allows us to have all three types of tests i-e unit, functional, and acceptance tests in a unified framework. In our case, we have unit tested the core business object `\App\Services`, also written acceptance tests to check the integration & functionality of all the API's. All the test case, are stored in the `tests` directory. and can be run by the following command:

`$ php vendor/bin/codecept run --steps`

##### Code-standards and style guides:

To maintain the coding standards accross the team I've created the file `phpcs.xml`, in which all the coding standards are defined. and all the code files can be checked according to this file by running the follwoing command:

`$ php vendor/bin/phpcs`

### Installation

Development environment requirements:

- Git
- Docker >= 18.09 CE
- Docker Compose

Setting up your development environment on your local machine using setup script **(For MAC/LINUX)**:

```bash
$ git clone https://github.com/ahsanatiq/voucher-pool-api.git
$ cd voucher-pool-api
$ ./setup.sh
```

Manual setup **(For Windows)**:

```bash
$ git clone https://github.com/ahsanatiq/voucher-pool-api.git
$ cd voucher-pool-api
$ cp .env.dev .env
$ docker-compose up -d
$ docker exec -it voucher-pool-php-fpm composer install
$ docker exec -it voucher-pool-mysql mysql -u root -pnewsletter2go -e "create database newsletter2go_testing; GRANT ALL PRIVILEGES ON *.* TO 'newsletter2go'@'%' IDENTIFIED BY 'newsletter2go';";
$ docker exec -it voucher-pool-php-fpm php vendor/bin/phinx migrate
$ docker exec -it voucher-pool-php-fpm php vendor/bin/phinx seed:run
```

Now you can access the application via http://localhost:8080.

### Run Tests

Run the unit-tests & acceptance-tests in the PHP-FPM service container:

```bash
$ docker exec -it voucher-pool-php-fpm php vendor/bin/codecept run --steps
```

### API documentation

You can access the public API documentation at [Postman](https://documenter.getpostman.com/view/23622/S1TPZffV). To import and run all the API's, click "Run In Postman" on top bar, after installing and importing you will see the new collection as "Newsletter2Go - Voucher API".
