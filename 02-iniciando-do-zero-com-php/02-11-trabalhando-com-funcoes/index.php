<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.11 - Trabalhando com funções");

/*
 * [ functions ] https://php.net/manual/pt_BR/language.functions.php
 */
fullStackPHPClassSession("functions", __LINE__);

require __DIR__ . "/functions.php";
var_dump(functionName("Atendimento", "Suporte", "Desenvolvimento"));
var_dump(functionName("Leneia", "Igo", "Pedro"));

var_dump(optionArgs("Pedro"));
var_dump(optionArgs("Pedro", "Airton"));
var_dump(optionArgs("Pedro", "Airton", "Anderson"));

/*
 * [ global access ] global $var
 */
fullStackPHPClassSession("global access", __LINE__);

$weight = 62;
$height = 1.68;
echo calcImc();

/*
 * [ static arguments ] static $var
 */
fullStackPHPClassSession("static arguments", __LINE__);

$pay = payTotal(200);
$pay = payTotal(150);
$pay = payTotal(300);
echo $pay;

/*
 * [ dinamic arguments ] get_args | num_args
 */
fullStackPHPClassSession("dinamic arguments", __LINE__);

var_dump(myTeam("Pedro", "Airton", "Juan", "Gerson"));