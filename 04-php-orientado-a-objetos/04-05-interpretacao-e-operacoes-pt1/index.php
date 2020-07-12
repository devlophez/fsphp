<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.05 - Interpretação e operações pt1");

require __DIR__ . "/source/autoload.php";

/*
 * [ construct ] Executado automaticamente por meio do operador new
 * http://php.net/manual/pt_BR/language.oop5.decon.php
 */
fullStackPHPClassSession("__construct", __LINE__);

//$user = new \Source\Interpretation\User();

$user = new \Source\Interpretation\User(
    "Pedro Leandro",
    "Gomes da Silva",
    "ti@credvip.com"
);

var_dump($user);

/*
 * [ clone ] Executado automaticamente quando um novo objeto é criado a partir do operador clone.
 * http://php.net/manual/pt_BR/language.oop5.cloning.php
 */
fullStackPHPClassSession("__clone", __LINE__);

$pedro = $user;
$airton = $pedro;

$airton->setFirstName("Airton");
$airton->setLastName("Sousa");

$pedro->setFirstName("Pedro Leandro");
$pedro->setLastName("Gomes da Silva");

$airton = clone $pedro;
$airton->setFirstName("Airton");
$airton->setLastName("Sousa");

$gerson = clone $pedro;

var_dump(
    $pedro,
    $airton,
    $gerson
);

/*
 * [ destruct ] Executado automaticamente quando o objeto é finalizado
 * http://php.net/manual/pt_BR/language.oop5.decon.php
 */
fullStackPHPClassSession("__destruct", __LINE__);