<?php

ini_set('display_errors',1);
ini_set('display_startup_error',1);
error_reporting(E_ALL);

require_once('../vendor/autoload.php');

session_start();

$dotenv = Dotenv\Dotenv::create(__DIR__.'/..');
$dotenv->load();

use Aura\Router\Matcher;
use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
use Zend\Diactoros\Response\RedirectResponse;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
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

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new RouterContainer();

$map = $routerContainer->getMap();

$map->get('index','/',[
    'controller' => 'App\Controllers\IndexController',
    'action' => 'index'
]);
$map->get('addJobs','/jobs/add',[
    'controller' => 'App\Controllers\JobsController',
    'action' => 'create',
    'auth' => true
]);
$map->post('saveJobs','/jobs/add',[
    'controller' => 'App\Controllers\JobsController',
    'action' => 'store',
    'auth' => true
]);
$map->get('addProjects','/projects/add',[
    'controller' => 'App\Controllers\ProjectsController',
    'action' => 'create',
    'auth' => true
]);
$map->post('saveProjects','/projects/add',[
    'controller' => 'App\Controllers\ProjectsController',
    'action' => 'store',
    'auth' => true
]);
$map->get('addUsers','/users/add',[
    'controller' => 'App\Controllers\UsersController',
    'action' => 'create',
    'auth' => true
]);
$map->post('saveUsers','/users/add',[
    'controller' => 'App\Controllers\UsersController',
    'action' => 'store',
    'auth' => true
]);
$map->get('loginForm','/login',[
    'controller' => 'App\Controllers\AuthController',
    'action' => 'index'
]);
$map->post('auth','/auth',[
    'controller' => 'App\Controllers\AuthController',
    'action' => 'check'
]);
$map->get('admin','/admin',[
    'controller' => 'App\Controllers\AdminController',
    'action' => 'index',
    'auth' => true
]);
$map->get('logout','/logout',[
    'controller' => 'App\Controllers\AuthController',
    'action' => 'logout'
]);
$map->get('error403','/error403',[
    'controller' => 'App\Controllers\ErrorsController',
    'action' => 'error403'
]);
$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);
function printElement($job) {
    echo '<li class="work-position">';
    echo '<h5>' . $job->title. '</h5>';
    echo '<p>' . $job->description . '</p>';
    echo '<p>' . $job->getDurationAsString() . '</p>';
    echo '<strong>Achievements:</strong>';
    echo '<ul>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '</ul>';
    echo '</li>';
  }
if(!$route){
 echo 'No route';   
}else{
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];
    $needsAuth = $handlerData['auth'] ?? false;
    $controller = new $controllerName;
    if($needsAuth && !(isset($_SESSION['userId'])) ){
        $response = new RedirectResponse('/error403');
    }else{
        $response = $controller->$actionName($request);
    }
    foreach ($response->getHeaders() as $name => $values) {
        foreach ($values as $value) {
            header(sprintf('%s: %s',$name,$value), false);
        }
    }
    http_response_code($response->getStatusCode());
    echo $response->getBody();
}
