<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.11 - Interação com URLs");

/*
 * [ argumentos ] ?[&[&][&]]
 */
fullStackPHPClassSession("argumentos", __LINE__);

echo "<h1><a href='index.php'>Clear</a></h1>";
echo "<p><a href='index.php?arg1=true&arg2=true'>Argumentos</a></p>";

$data = [
    "name" => "Pedro",
    "company" => "CredVip",
    "mail" => "pedro.credvip@gmail.com"
];

//transformar os dados para em argumentos para url
$arguments = http_build_query($data);

//var_dump(
//    $data,
//    $arguments
//);

echo "<p><a href='index.php?{$arguments}'>Args by Array</a></p>";

var_dump($_GET);

$object = (object)$data;
var_dump(
    $object,
    http_build_query($object)
);

/*
 * [ segurança ] get | strip | filters | validation
 * [ filter list ] https://php.net/manual/en/filter.filters.php
 */
fullStackPHPClassSession("segurança", __LINE__);

//transformar os dados para em argumentos para url de forma direta

$dataFilter = http_build_query(
    [
        "name" => "Pedro",
        "company" => "CredVip",
        "mail" => "pedro.credvip@gmail.com",
        "site" => "credvip.com",
        "script" => "<script>alert('Esse é um Javascript')</script>"
    ]
);

echo "<p><a href='index.php?{$dataFilter}'>Data Filter</a></p>";

/**
 * FILTER_DEFAULT = verificando todas as entradas e validando junto com o usuário,
 * mas permitindo a entrada de dados maliciosos, por isso utilizar o...
 *
 * FILTER_SANITIZE_STRIPPED = recebe os dados, tratandos os dados sem válidar,
 * mas aceitando apenas dados que não podem prejudicar a aplicação
 */

$dataUrl = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);

//pós filtro
if ($dataUrl) {
    if (in_array("", $dataUrl)) {
        echo "<p class='trigger warning'>Cautela! Faltam dados!</p>";
    } elseif (empty($dataUrl['mail'])) {
        echo "<p class='trigger warning'>Falta o e-mail!</p>";
    } elseif (!filter_var($dataUrl['mail'], FILTER_VALIDATE_EMAIL)) {
        echo "<p class='trigger warning'>E-mail inválido!</p>";
    } else {
        echo "<p class='trigger accept'>Deu tudo certo!</p>";
    }
} else {
    var_dump(false);
}

var_dump($dataUrl);

$dataFilter = http_build_query(
    [
        "name" => "Pedro",
        "company" => "CredVip",
        "mail" => "pedro.credvip@gmail.com",
        "site" => "https://credvip.com",
        "script" => "<script>alert('Esse é um Javascript')</script>"
    ]
);

//converter string de url em um arry
parse_str($dataFilter, $arrDataFilter);
var_dump($dataFilter, $arrDataFilter);


$dataPreFilter = [
    "name" => FILTER_SANITIZE_STRING,
    "company" => FILTER_SANITIZE_STRING,
    "mail" => FILTER_VALIDATE_EMAIL,
    "site" => FILTER_VALIDATE_URL,
    "script" => FILTER_SANITIZE_STRING
];

var_dump(filter_var_array($arrDataFilter, $dataPreFilter));

