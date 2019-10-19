#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Illuminate\Database\Capsule\Manager as Capsule;

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$capsule = new Capsule;

$container = new DI\Container();

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '192.168.10.10',
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$application = new Application();
$application->add(new \App\Commands\HelloWorldCommand());
$application->add(new \App\Commands\SendMailCommand());
$application->add(new \App\Commands\CreateUserCommand());
$application->run();