<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.10 - Requisição de arquivos");

/*
 * [ include ] https://php.net/manual/pt_BR/function.include.php
 * [ include_once ] https://php.net/manual/pt_BR/function.include-once.php
 */
fullStackPHPClassSession("include, include_once", __LINE__);

//include "file.php";
//echo "<p>Continue</p>";

//include "header.php";
include __DIR__ . "/header.php";

/**
 * StdClass representa um objeto dinâmico ou um vetor de dados
 */

$profile = new StdClass();
$profile->name = "Pedro";
$profile->company = "CredVip";
$profile->email = "pedro.leandrogs@gmail.com";
include __DIR__ . "/profile.php";

$profile->name = "Airton";
$profile->company = "CredVip";
$profile->email = "airton.sousas@gmail.com";
include __DIR__ . "/profile.php";

//var_dump($profile);

/*
 * [ require ] https://php.net/manual/pt_BR/function.require.php
 * [ require_once ] https://php.net/manual/pt_BR/function.require-once.php
 */
fullStackPHPClassSession("require, require_once", __LINE__);

//require "file.php";
//echo "<p>Continue</p>";

require __DIR__ . "/config.php";
echo "<h1>" . COURSE . "</h1>";