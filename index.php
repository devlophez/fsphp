<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */
use Source\Core\Session;
use CoffeeCode\Router\Router;

$sesion = new Session();
$route = new Router(url(), "::");

/**
 * WEB ROUTE
 */
$route->namespace("Source\Controllers");
$route->get("/", "Web::home");
$route->get("/sobre", "Web::about");


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