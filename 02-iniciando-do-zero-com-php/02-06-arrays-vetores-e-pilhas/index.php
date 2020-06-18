<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.06 - Arrays, vetores e pilhas");

/**
 * [ arrays ] https://php.net/manual/pt_BR/language.types.array.php
 */
fullStackPHPClassSession("index array", __LINE__);

$arrA = array(1, 2, 3);
$arrA = [0, 1, 2, 3];
var_dump($arrA);

$arrayIndex = [
    "Pedro",
    "Airton",
    "Gerson",
    "Juan",
    "João Pedro",
    "Luan Silva"
];

$arrayIndex[] = "Igo";
$arrayIndex[] = "Leneia";

var_dump($arrayIndex);


/**
 * [ associative array ] "key" => "value"
 */
fullStackPHPClassSession("associative array", __LINE__);

$arrayAssoc = [
    "coffeeMan" => "Pedro",
    "flutterMan" => "Airton",
    "boss" => "Gerson",
    "rightArm" => "Juan",
    "codeIgniterMan" => "João Pedro",
    "frontend" => "Luan Silva"
];

$arrayAssoc["suport"] = "Igo";
$arrayAssoc["attendance"] = "Leneia";

var_dump($arrayAssoc);


/**
 * [ multidimensional array ] "key" => ["key" => "value"]
 */
fullStackPHPClassSession("multidimensional array", __LINE__);

$effective = ["Gerson", "Juan", "Airton", "Luan", "João Pedro"];
$interns = ["name" => "Pedro", "office" => "backend"];
$suport = ["name" => "Igo", "office" => "suport"];

$teams = [
    $effective,
    $interns,
    $suport
];

var_dump($teams);

$teams = [
    "efetivados" => $effective,
    "estagiários" => $interns,
    "suporte" => $suport
];

var_dump($teams);

/**
 * [ array access ] foreach(array as item) || foreach(array as key => value)
 */
fullStackPHPClassSession("array access", __LINE__);

$teamTi = [
    "name" => "Team TI",
    "coffeeMan" => "Pedro",
    "flutterMan" => "Airton",
    "boss" => "Gerson",
    "rightArm" => "Juan",
    "codeIgniterMan" => "João Pedro",
    "frontend" => "Luan Silva"
];

echo "<p>O Diretor de TI é o {$teamTi["boss"]} e seu braço direito é o {$teamTi["rightArm"]}</p>";

$teamSuport = [
    "name" => "Team Suport",
    "suport" => "Igo",
    "attendance" => "Leneia",
    "financial" => "Mariana",
    "boss" => "Apolônio",
    "management" => "Thuane",
    "administrative" => "Rafael",
];

$teamsCredVip = [
    "teamTi" => $teamTi,
    "teamSuport" => $teamSuport
];

var_dump($teamsCredVip);

echo "<p>{$teamsCredVip["teamSuport"]["attendance"]}</p>";

foreach ($teamTi as $collaborator){
    echo "<p>$collaborator</p>";
}

foreach ($teamTi as $key => $collaborator){
    echo "<p>{$collaborator} is a {$key} of team</p>";
}

foreach ($teamsCredVip as $teams){
//    var_dump($teams);
    $art = "<article><h1>%s</h1><p>%s</p><p>%s</p><p>%s</p><p>%s</p><p>%s</p><p>%s</p></article>";
    vprintf($art, $teams);
}
