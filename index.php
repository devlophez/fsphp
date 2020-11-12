<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */
use Source\Core\Session;
use CoffeeCode\Router\Router;

$session = new Session();
$route = new Router(url(), "::");

/**
 * WEB ROUTE
 */
$route->namespace("Source\Controllers");
$route->get("/", "Web::home");
$route->get("/sobre", "Web::about");

//blog
$route->group("/blog");
$route->get("/", "Web::blog");
$route->get("/p/{page}", "Web::blog");
$route->get("/{uri}", "Web::blogPost");
$route->post("/buscar", "Web::blogSearch");
$route->get("/buscar/{terms}/{page}", "Web::blogSearch");
$route->get("/em/{category}", "Web::blogCategory");
$route->get("/em/{category}/{page}", "Web::blogCategory");

//auth
$route->group(null);
$route->get("/entrar", "Web::login");
$route->post("/entrar", "Web::login");

$route->get("/cadastrar", "Web::register");
$route->post("/cadastrar", "Web::register");

$route->get("/recuperar", "Web::forget");
$route->post("/recuperar", "Web::forget");

$route->get("/resetar/{code}", "Web::reset");
$route->post("/resetar", "Web::reset");

//opt-in
$route->get("/confirma", "Web::confirm");
$route->get("/obrigado/{email}", "Web::success");

//

//services
$route->get("/termos", "Web::terms");

/**
 * APP
 */
$route->group("/app");
$route->get("/", "App::home");
$route->get('/sair', "App::logoff");

/**
 * ERROR ROUTES
 */
$route->namespace("Source\Controllers")->group("/whops");
$route->get("/{errcode}", "Web::error");


/**
 * ROUTE
 */
$route->dispatch();


/**
 * ERROR REDIRECT
 */
if($route->error()){
    $route->redirect("/whops/{$route->error()}");
}

ob_end_flush();