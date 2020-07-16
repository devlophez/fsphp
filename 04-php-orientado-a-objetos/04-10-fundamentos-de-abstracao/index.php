<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.10 - Fundamentos da abstração");

require __DIR__ . "/source/autoload.php";

/*
 * [ superclass ] É uma classe criada como modelo e regra para ser herdada por outras classes,
 * mas nunca para ser instanciada por um objeto.
 */
fullStackPHPClassSession("superclass", __LINE__);

$client = new \Source\App\User("Pedro", "Silva");

//$account = new Source\Bank\Account(
//    "0124-4",
//    "60694-4",
//    $client,
//    "1000"
//);

var_dump(
//    $account,
    $client
);

/*
 * [ especialização ] É uma classe filha que implementa a superclasse e se especializa
 * com suas prórpias rotinas
 */
fullStackPHPClassSession("especialização.a", __LINE__);

$myAccount = new \Source\Bank\AccountSaving(
    "0124-4",
    "60694-4",
    $client,
    "0"
);

var_dump($myAccount);

$myAccount->deposit(1000);
$myAccount->withdrawal(1500);
$myAccount->withdrawal(500);
$myAccount->withdrawal(6);
$myAccount->extract();

/*
 * [ especialização ] É uma classe filha que implementa a superclass e se especializa
 * com suas prórpias rotinas
 */
fullStackPHPClassSession("especialização.b", __LINE__);

$current = new \Source\Bank\AccountCurrent(
    "01244-4",
    "46097-4",
    $client,
    "1000",
    "1000"
);

var_dump($current);

$current->deposit(1000);
$current->withdrawal(2000);
$current->withdrawal(500);
$current->extract();