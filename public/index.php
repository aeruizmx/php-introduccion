<?php

require_once('../vendor/autoload.php');

session_start();

$dotenv = Dotenv\Dotenv::create(__DIR__.'/..');
$dotenv->load();

if(getenv('DEBUG')==='TRUE'){
    ini_set('display_errors',1);
    ini_set('display_startup_error',1);
    error_reporting(E_ALL);
}

use App\Middlewares\AuthenticationMiddleware;
use Aura\Router\Matcher;
use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use WoohooLabs\Harmony\Harmony;
use WoohooLabs\Harmony\Middleware\FastRouteMiddleware;
use WoohooLabs\Harmony\Middleware\DispatcherMiddleware;
use WoohooLabs\Harmony\Middleware\HttpHandlerRunnerMiddleware;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Franzl\Middleware\Whoops\WhoopsMiddleware;

$log = new Logger('app');
$log->pushHandler(new StreamHandler(__DIR__ .'/../logs/app.log', Logger::WARNING));

$capsule = new Capsule;

$container = new DI\Container();

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
    'App\Controllers\IndexController',
    'index'
]);
$map->get('indexJobs','/jobs',[
    'App\Controllers\JobsController',
    'index',
    'auth' => true
]);
$map->get('deleteJobs','/jobs/delete',[
    'App\Controllers\JobsController',
    'delete',
    'auth' => true
]);
$map->get('addJobs','/jobs/add',[
    'App\Controllers\JobsController',
    'create',
    'auth' => true
]);
$map->post('saveJobs','/jobs/add',[
    'App\Controllers\JobsController',
    'store',
    'auth' => true
]);
$map->get('addProjects','/projects/add',[
    'App\Controllers\ProjectsController',
    'create',
    'auth' => true
]);
$map->post('saveProjects','/projects/add',[
    'App\Controllers\ProjectsController',
    'store',
    'auth' => true
]);
$map->get('addUsers','/users/add',[
    'App\Controllers\UsersController',
    'create',
    'auth' => true
]);
$map->post('saveUsers','/users/add',[
    'App\Controllers\UsersController',
    'store',
    'auth' => true
]);
$map->get('loginForm','/login',[
    'App\Controllers\AuthController',
    'index'
]);
$map->post('auth','/auth',[
    'App\Controllers\AuthController',
    'check'
]);
$map->get('admin','/admin',[
    'App\Controllers\AdminController',
    'index',
    'auth' => true
]);
$map->get('logout','/logout',[
    'App\Controllers\AuthController',
    'logout'
]);
$map->get('error403','/error403',[
    'App\Controllers\ErrorsController',
    'error403'
]);
$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);
if(!$route){
 echo 'No route';   
}else{
    try{
        $harmony = new Harmony($request, new Response());
        $harmony
            ->addMiddleware(new HttpHandlerRunnerMiddleware(new SapiEmitter()));
            if(getenv('DEBUG')==='TRUE'){
                $harmony->addMiddleware(new \Franzl\Middleware\Whoops\WhoopsMiddleware);
            }
        $harmony->addMiddleware(new AuthenticationMiddleware())
            ->addMiddleware(new Middlewares\AuraRouter($routerContainer))
            ->addMiddleware(new DispatcherMiddleware($container, 'request-handler'))
            ->run();
    }catch(Exception $e){
        $log->warning($e->getMessage());
        $emitter = new SapiEmitter();
        $emitter->emit(new EmptyResponse(400));
    }catch(Error $e){
        $emitter = new SapiEmitter();
        $emitter->emit(new EmptyResponse(500));
    }
    // $handlerData = $route->handler;
    // $controllerName = $handlerData['controller'];
    // $actionName = $handlerData['action'];
    // $needsAuth = $handlerData['auth'] ?? false;
    
    //$controller = new $controllerName;
    // $controller = $container->get($controllerName);
    // if($needsAuth && !(isset($_SESSION['userId'])) ){
    //     $response = new RedirectResponse('/error403');
    // }else{
    //     $response = $controller->$actionName($request);
    // }
    // foreach ($response->getHeaders() as $name => $values) {
    //     foreach ($values as $value) {
    //         header(sprintf('%s: %s',$name,$value), false);
    //     }
    // }
    // http_response_code($response->getStatusCode());
    // echo $response->getBody();
}
