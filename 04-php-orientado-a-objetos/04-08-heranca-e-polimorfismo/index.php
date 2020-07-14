<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.08 - Herança e polimorfismo");

require __DIR__ . "/source/autoload.php";

/*
 * [ classe pai ] Uma classe que define o modelo base da estrutura da herança
 * http://php.net/manual/pt_BR/language.oop5.inheritance.php
 */
fullStackPHPClassSession("classe pai", __LINE__);

$event = new \Source\Inheritance\Event\Event(
    "Workshop Cred Vip",
    new DateTime("2020-07-18 23:59"),
    500,
    "4"
);

var_dump($event);

$event->register("Pedro Leandro", "ti@credvip.com");
$event->register("Airton Sousa", "ti@credvip.com");
$event->register("Juan Carlos", "ti@credvip.com");
$event->register("Gerson James", "ti@credvip.com");
$event->register("João Pedro", "ti@credvip.com");
$event->register("Luan Silva", "ti@credvip.com");

/*
 * [ classe filha ] Uma classe que herda a classe pai e especializa seuas rotinas
 */
fullStackPHPClassSession("classe filha", __LINE__);

$address = new \Source\Inheritance\Address(
    "Av. Central",
    "1884-A",
    "Anda 1"
);

$event = new \Source\Inheritance\Event\EventLive(
    "Workshop Cred Vip",
    new DateTime("2020-07-18 23:59"),
    500,
    "4",
    $address
);

var_dump($event);

$event->register("Pedro Leandro", "ti@credvip.com");
$event->register("Airton Sousa", "ti@credvip.com");
$event->register("Juan Carlos", "ti@credvip.com");
$event->register("Gerson James", "ti@credvip.com");
$event->register("João Pedro", "ti@credvip.com");
$event->register("Luan Silva", "ti@credvip.com");

/*
 * [ polimorfismo ] Uma classe filha que tem métodos iguais (mesmo nome e argumentos) a class
 * pai, mas altera o comportamento desses métodos para se especializar
 */
fullStackPHPClassSession("polimorfismo", __LINE__);

$event = new \Source\Inheritance\Event\EventOnline(
    "Workshop Cred Vip",
    new DateTime("2020-07-18 23:59"),
    500,
    "https://credvip.com/aovivo"
);

var_dump($event);

$event->register("Pedro Leandro", "ti@credvip.com");
$event->register("Airton Sousa", "ti@credvip.com");
$event->register("Juan Carlos", "ti@credvip.com");
$event->register("Gerson James", "ti@credvip.com");
$event->register("João Pedro", "ti@credvip.com");
$event->register("Luan Silva", "ti@credvip.com");
