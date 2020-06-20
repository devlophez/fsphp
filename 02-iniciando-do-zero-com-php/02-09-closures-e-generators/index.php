<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.09 - Closures e generators");

/*
 * [ closures ] https://php.net/manual/pt_BR/functions.anonymous.php
 */
fullStackPHPClassSession("closures", __LINE__);

//closures são funções anônimas

$myAge = function ($year) {
    $age = date("Y") - $year;
    return "<p>Você tem {$age} anos!</p>";
};
echo $myAge(1997);
echo $myAge(2018);
echo $myAge(1986);
echo $myAge(1975);

$priceBrl = function ($price) {
    return "R$ " . number_format($price, 2, ",", ".");
};
echo "<p>O projeto custa {$priceBrl(697)}. Vamos fechar?</p>";

/**
 * use (&$myCart) é utilizado para referenciar a variável,
 * no momento em que a closure cardAdd for atualizada,
 * a variável myCart também vai
 */

$myCart = [];
$myCart["totalPrice"] = 0;
$cardAdd = function ($item, $qtd, $price) use (&$myCart) {
    $myCart[$item] = $qtd * $price;
    $myCart["totalPrice"] += $myCart[$item];
};

$cardAdd("FSPHP", 1, 697);
$cardAdd("Laravel", 1, 497);

var_dump($myCart);

/*
 * [ generators ] https://php.net/manual/pt_BR/language.generators.overview.php
 */
fullStackPHPClassSession("generators", __LINE__);

/**
 * Geralmente a função abaixo dá um erro de over memory,
 * porque a interação pode ser maior do que a memória da variável,
 * isto é, foi utilizado mais memória do que aquela que o servidor disponibilizou.
 */

//$iterator = 400000000;
//
//function showDates($days)
//{
//    $saveDate = [];
//    for ($day = 0; $day <= $days; $day++) {
//        $saveDate[] = date("d/m/Y", strtotime("+{$day}days"));
//    }
//    return $saveDate;
//}
//
//echo "<div style='text-align: center'>";
//foreach (showDates($iterator) as $date) {
//    echo "<small class='tag'>{$date}</small>" . PHP_EOL;
//}
//echo "</div>";

/**
 * o generator yield serve pra renderizar dados em massa
 * e exibir informações enquanto que
 * a leitura e interação dos dados acontece.
 */

$iterator = 10;

function generatorDates($days)
{
    for ($day = 0; $day <= $days; $day++) {
        yield date("d/m/Y", strtotime("+{$day}days"));
    }
}

echo "<div style='text-align: center'>";
foreach (generatorDates($iterator) as $date) {
    echo "<small class='tag'>{$date}</small>" . PHP_EOL;
}
echo "</div>";
