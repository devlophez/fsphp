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

//auth
$route->group(null);
$route->get("/entrar", "Web::login");

$route->get("/cadastrar", "Web::register");
$route->post("/cadastrar", "Web::register");

$route->get("/recuperar", "Web::forget");

//opt-in
$route->get("/confirma", "Web::confirm");
$route->get("/obrigado/{email}", "Web::success");

//

//services
$route->get("/termos", "Web::terms");

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