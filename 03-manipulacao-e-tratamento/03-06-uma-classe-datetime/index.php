<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.06 - Uma classe DateTime");

/*
 * [ DateTime ] http://php.net/manual/en/class.datetime.php
 */
fullStackPHPClassSession("A classe DateTime", __LINE__);

define("DATE_BR", "d/m/Y H:i:s");
define("DATE_TIMEZONE", "America/Sao_Paulo");

$dateNow = new DateTime();
$dateBirth = new DateTime("1997-06-28");
$dateStatic = DateTime::createFromFormat("d/m/Y", "28/06/1997");

var_dump([
    $dateNow,
    $dateBirth,
    $dateStatic
]);

var_dump([
    $dateNow->format(DATE_BR),
    $dateNow->format("d")
]);

echo "<p>Hoje é dia {$dateNow->format("d")} de {$dateNow->format("m")} do ano {$dateNow->format("Y")}</p>";

$newTimeZone = new DateTimeZone("Pacific/Apia");
$newDateTime = new DateTime("now", $newTimeZone);

var_dump([
    $newTimeZone,
    $newDateTime,
    $dateNow
]);

/*
 * [ DateInterval ] http://php.net/manual/en/class.dateinterval.php
 * [ interval_spec ] http://php.net/manual/en/dateinterval.construct.php
 */
fullStackPHPClassSession("A classe DateInterval", __LINE__);

$dateInterval = new DateInterval("P10Y7MT10H5M");
var_dump($dateInterval);

$dateTime = new DateTime("now");
//adicionar tempo de intervalo na data de agora
//$dateTime->add($dateInterval);
//subtrair tempo de intervalo na data de agora
$dateTime->sub($dateInterval);

var_dump($dateTime);

$myBirthDay = new DateTime("2020-06-28");
$dateNow = new DateTime("now");

//o diff (different) é pra informar a diferença entra as datas configuradas
$diff = $dateNow->diff($myBirthDay);

var_dump([
    $myBirthDay,
    $diff
]);

/**
 * em diff->invert da pra saber quantos dias passou após aquela data se o retorno for 1
 * ou quantos dias faltam para aquela data se o retorno for 0
 */

if ($diff->invert) {
    echo "<p>Seu aniversário foi há {$diff->days} dias!</p>";
} else {
    echo "<p>Faltam {$diff->days} dias para o seu aniversário</p>";
}

$dateResources = new DateTime("now");
var_dump([
    $dateResources->format(DATE_BR),
    $dateResources->sub(DateInterval::createFromDateString("10days")),
    $dateResources->sub(DateInterval::createFromDateString("10days"))->format(DATE_BR),
    $dateResources->add(DateInterval::createFromDateString("10days")),
]);

/**
 * [ DatePeriod ] http://php.net/manual/pt_BR/class.dateperiod.php
 */
fullStackPHPClassSession("A classe DatePeriod", __LINE__);

$start = new DateTime("now");
$interval = new DateInterval("P1M");
$end = new DateTime("2021-01-01");

$period = new DatePeriod($start, $interval, $end);

var_dump([
    $start->format(DATE_BR),
    $interval,
    $end->format(DATE_BR)
], $period, get_class_methods($period));

echo "<h1>Sua assinatura: </h1>";
foreach ($period as $item){
    echo "<p>Próximo vencimento {$item->format(DATE_BR)}</p>";
}
