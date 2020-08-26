<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("06.14 - Consulta em palavras reservadas");

require __DIR__ . "/../source/autoload.php";

/*
 * [ query params ]
 */
fullStackPHPClassSession("query params", __LINE__);

$user = (new \Source\Models\User())->findById(1);
$user->first_name = "Pedro";
$user->last_name = "Silva";
$user->email = "ti@credvip.com";
$user->password = 1234576543;
$user->document = 22.22;
$user->save();
var_dump($user);

$user = (new \Source\Models\User())->find("document = :d", "d=22.22");
var_dump($user);

$list = (new \Source\Models\User())->all(2);
var_dump($list);