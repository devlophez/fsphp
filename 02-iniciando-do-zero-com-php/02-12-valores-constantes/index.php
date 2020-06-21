<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.12 - Constantes e constantes mágicas");

/*
 * [ constantes ] https://php.net/manual/pt_BR/language.constants.php
 */
fullStackPHPClassSession("constantes", __LINE__);

/**
 * a diferença entre define e const é que em
 * define está em runtime da aplicação, isto é, é interpretado enquanto a aplicação estiver ativa; enquanto que
 * const está em compare time, isto é, ocorre antes da execução, por isso não dá pra utilizar um const numa condição
 */

define("COURSE", "Full Stack PHP");
const AUTHOR = "Pedro";

$formation = true;

if ($formation) {
    define("COURSE_TYPE", "Formação");
} else {
    define("COURSE_TYPE", "Curso");
}

echo "<p>COURSE COURSE_TYPE AUTHOR</p>";
echo "<p>{COURSE} {COURSE_TYPE} {AUTHOR}</p>";

echo "<p>", COURSE, " ", COURSE_TYPE, " de ", AUTHOR, "</p>";
echo "<p>" . COURSE . " " . COURSE_TYPE . " de " . AUTHOR . "</p>";

class Config
{
    const USER = "root";
    const HOST = "localhost";
}

echo "<p>" . Config::HOST . "</p>";

var_dump(get_defined_constants(true)["user"]);

/*
 * [ constantes mágicas ] https://php.net/manual/pt_BR/language.constants.predefined.php
 */
fullStackPHPClassSession("constantes mágicas", __LINE__);

var_dump([
    __LINE__,
    __FILE__,
    __DIR__
]);

function fullStackPhp()
{
    return __FUNCTION__;
}

var_dump(fullStackPhp());

//é um comportamento definido dentro de orientação a objetos
trait MyTrait
{
    public $traitName = __TRAIT__;
}

class FsPhp
{
    use MyTrait;

    public $className = __CLASS__;
}

var_dump(new FsPhp());

require __DIR__ . "/MyClass.php";

//apenas o nome do namespace
var_dump(new \Source\MyClass());

//nome completo do namespace
var_dump(\Source\MyClass::class);