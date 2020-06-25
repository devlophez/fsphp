<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.05 - Manipulação de datas");

/*
 * [ a função date ] setup | output
 * [ date ] https://php.net/manual/pt_BR/function.date.php
 * [ timezones ] https://php.net/manual/pt_BR/timezones.php
 */
fullStackPHPClassSession("a função date", __LINE__);

var_dump([
    date_default_timezone_get(),
    date(DATE_W3C),
    date("d/m/Y H:i:s")
]);

define("DATE_BR", "d/m/Y H:i:s");
define("DATE_TIMEZONE", "America/Sao_Paulo");
//define("DATE_TIMEZONE", "Pacific/Apia");

date_default_timezone_set(DATE_TIMEZONE);
var_dump([
    date_default_timezone_get(),
    date(DATE_BR)
]);

var_dump(getdate());

echo "<p>Hoje é dia ", getdate()["mday"], " de ", getdate()["month"], "</p>";

/**
 * [ string to date ] strtotime | strftime
 */
fullStackPHPClassSession("string to date", __LINE__);

var_dump([
    "strtotime" => strtotime("now"),
    "time" => time(),
    "strtotime+10d" => strtotime("+10days"),
    "date DATE_BR" => date(DATE_BR),
    "date +10days" => date(DATE_BR, strtotime("+10days")),
    "date -10days" => date(DATE_BR, strtotime("-10days")),
    "date +1year" => date(DATE_BR, strtotime("+1year")),
    "date +2years" => date(DATE_BR, strtotime("+2years")),
]);

$format = "%d/%m/%Y %Hh%M minutos";

echo "<p>A data de hoje é ", strftime($format) ,"</p>";
echo strftime("<p>A data de hoje é %d do %m de %Y às %H horas e %M minutos.</p>");