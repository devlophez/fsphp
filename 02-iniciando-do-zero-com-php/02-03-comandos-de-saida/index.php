<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.03 - Comandos de saída");

/**
 * [ echo ] https://php.net/manual/pt_BR/function.echo.php
 */
fullStackPHPClassSession("echo", __LINE__);

echo "<h3>Olá Mundo! Meu nome é Pedro Leandro</h3>";
echo "<p>Olá Mundo!", " ", "<span class='tag'>#BoraProgramar</span>", "</p>";

$hello = "Olá Mundo!";
$code = "<span class='tag'>#BoraProgramar</span>";

echo "<p>$hello</p>";

$day = "dia";
echo "<p>Falta 1 $day para o evento</p>";
echo "<p>Faltam 2 {$day}s para o evento</p>";

echo "<h3>{$hello}</h3>";
echo "<h4>{$hello} {$code}</h4>";

echo '<h3>'.$hello." ". $code."</h3>";
?>

<h3><?= $hello ?> <?= $code ?></h3>

<?php
/**
 * [ print ] https://php.net/manual/pt_BR/function.print.php
 */
fullStackPHPClassSession("print", __LINE__);

print $hello;
print $code;

print "<h3>{$hello} {$code}</h3>";

/**
 * [ print_r ] https://php.net/manual/pt_BR/function.print-r.php
 */
fullStackPHPClassSession("print_r", __LINE__);

$array = [
    "company" => "Upinside",
    "course" => "FSPHP",
    "class" => "comandos de saída"
];

echo "<pre>";
print_r($array);

echo "<pre>", print_r($array, true) ,"</pre>";

/**
 * [ printf ] https://php.net/manual/pt_BR/function.printf.php
 */
fullStackPHPClassSession("printf", __LINE__);

$article = "<article><h1>%s</h1><p>%s</p></article>";
$title = "{$hello} {$code}";
$subtitle = "Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo 
utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um 
livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração 
eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques 
contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração 
eletrônica como Aldus PageMaker.";

printf($article, $title, $subtitle);
echo sprintf($article, $title, $subtitle);

/**
 * [ vprintf ] https://php.net/manual/pt_BR/function.vprintf.php
 */
fullStackPHPClassSession("vprintf", __LINE__);

$company = "<article><h1>Escola %s</h1><p><b>Curso %s</b>, <b>Aula %s</b></p></article>";

vprintf($company, $array);
echo vsprintf($company, $array);

/**
 * [ var_dump ] https://php.net/manual/pt_BR/function.var-dump.php
 */
fullStackPHPClassSession("var_dump", __LINE__);

var_dump($array);
var_dump(
    $array,
    $hello,
    $code
);