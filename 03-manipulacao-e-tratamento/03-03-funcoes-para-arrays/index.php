<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.03 - Funções para arrays");

/*
 * [ criação ] https://php.net/manual/pt_BR/ref.array.php
 */
fullStackPHPClassSession("manipulação", __LINE__);

$index = [
    "AC/DC",
    "Nirvana",
    "Alter Bridge"
];

$assoc = [
    "band_1" => "AC/DC",
    "band_2" => "Nirvana",
    "band_3" => "Alter Bridge"
];

//adiciona um novo elemento no início de um array
array_unshift($index, "", "Pearl Jeam");

$assoc = [
        "band_4" => "",
        "band_5" => "Pearl Jeam"
    ] + $assoc;

//adiciona um novo elemento no final de um array
array_push($index, "");
$assoc = $assoc + [
        "band_6" => ""
    ];

//remove o primeiro valor do array
array_shift($index);
array_shift($assoc);

//remove o último valor do array
array_pop($index);
array_pop($assoc);

array_unshift($index, "");
$assoc = [
        "band_4" => ""
    ] + $assoc;

//elimina qualquer indíce que não tenha valor no array

$index = array_filter($index);
$assoc = array_filter($assoc);

var_dump(
    $index,
    $assoc
);

/*
 * [ ordenação ] reverse | asort | ksort | sort
 */
fullStackPHPClassSession("ordenação", __LINE__);

//reverte a ordem do array
$index = array_reverse($index);
$assoc = array_reverse($assoc);

//orderna pelo valor, e mantem os indíces
asort($index);
asort($assoc);

//orderna pelo índice, ignorando os valores
ksort($index);

//ordena pelo índice de forma reversa
krsort($index);

//ordena pelo valor e reindexa o índice
sort($index);

//ordena pelo valor de forma reversa e reindexa o índice
rsort($index);

var_dump(
    $index,
    $assoc
);

/*
 * [ verificação ]  keys | values | in | explode
 */
fullStackPHPClassSession("verificação", __LINE__);

var_dump(
    [
        array_keys($assoc),
        array_values($assoc)
    ]
);

//verifica se há um determinado conteúdo no array passado como parâmetro
if (in_array("AC/DC", $assoc)) {
    echo "<p>Cause I'm Back</p>";
}

//converte um array em uma string
$arrToString = implode(", ", $assoc);
echo "<p>Eu curto {$arrToString} e muitas outras!</p>";
echo "<p>{$arrToString}</p>";

//converte um string em um array
var_dump(explode(", ", $arrToString));

/**
 * [ exemplo prático ] um template view | implode
 */
fullStackPHPClassSession("exemplo prático", __LINE__);

$profile = [
    "name" => "Pedro",
    "company" => "CredVip",
    "mail" => "pedro.credvip@gmail.com"
];

$template = <<<TPL
    <article>
        <h1>{{name}}</h1>
        <p>{{company}}<br>
        <a href="mailto: {{mail}}" title="Enviar e-mail para {{mail}}">Enviar e-mail</a></p>
    </article>
TPL;

echo $template;

echo str_replace(
    array_keys($profile), array_values($profile), $template
);

$replaces = "{{" . implode("}}&{{", array_keys($profile)) . "}}";

//echo $replaces;
//var_dump(explode("&", $replaces));

$replaces = explode("&", $replaces);

echo str_replace(
    $replaces, array_values($profile), $template
);