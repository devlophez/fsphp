<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.09 - Membros de uma classe");

require __DIR__ . "/source/autoload.php";

/*
 * [ constantes ] http://php.net/manual/pt_BR/language.oop5.constants.php
 */
fullStackPHPClassSession("constantes", __LINE__);

use Source\Members\Config;

$config = new Config();

echo "<p>" . $config::COMPANY . "</p>";

var_dump(
    Config::COMPANY
//    Config::DOMAIN,
//    Config::SECTOR
);

/**
 * Reflection serve para debugar qualquer rotina de classe, testar
 * qualquer membro de uma classe independente da acessibilidade
 */

$reflection = new ReflectionClass($config);

//var_dump($reflection, get_class_methods($reflection));
var_dump($reflection, $reflection->getConstants());

var_dump($config);

/*
 * [ propriedades ] http://php.net/manual/pt_BR/language.oop5.static.php
 */
fullStackPHPClassSession("propriedades", __LINE__);

Config::$company = "CredVip";
Config::$domain = "credvip.com";
Config::$sector = "business";

Config::$sector = "tecnology";

var_dump(
    $config,
    $reflection->getProperties(),
    $reflection->getDefaultProperties()
);

/*
 * [ métodos ] http://php.net/manual/pt_BR/language.oop5.static.php
 */
fullStackPHPClassSession("métodos", __LINE__);

$config::setConfig("", "", "");
Config::setConfig("CredVip", "credvip.com", "business");

var_dump(
    $config,
    $reflection->getMethods(),
    $reflection->getDefaultProperties()
);

/*
 * [ exemplo ] Uma classe trigger
 */
fullStackPHPClassSession("exemplo", __LINE__);

use Source\Members\Trigger;

$trigger = new Trigger();
$trigger::show("um objeto trigger");

var_dump($trigger);

Trigger::show("Esta é uma mensagem para o usuário!");
Trigger::show("Esta é uma mensagem para o usuário!", Trigger::ACCEPT);
Trigger::show("Esta é uma mensagem para o usuário!", Trigger::WARNING);
Trigger::show("Esta é uma mensagem para o usuário!", Trigger::ERROR);

echo Trigger::push("Esse é um retorno para o usuário!");
echo Trigger::push("Esse é um retorno para o usuário!", Trigger::ACCEPT);
echo Trigger::push("Esse é um retorno para o usuário!", Trigger::WARNING);
echo Trigger::push("Esse é um retorno para o usuário!", Trigger::ERROR);