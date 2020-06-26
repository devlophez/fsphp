<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.07 - Manipulação de arquivos");

/*
 * [ verificação de arquivos ] file_exists | is_file | is_dir
 */
fullStackPHPClassSession("verificação", __LINE__);

$file = __DIR__ . "/file.txt";

//verifica se existe o arquivo e se é mesmo um arquivo ou diretório
if (file_exists($file) && is_file($file)) {
    echo "<p>Existe.</p>";
} else {
    echo "<p>Não Existe.</p>";
}

/*
 * [ leitura e gravação ] fopen | fwrite | fclose | file
 */
fullStackPHPClassSession("leitura e gravação", __LINE__);

if (!file_exists($file) && !is_file($file)) {
    $fileOpen = fopen($file, "w");
    fwrite($fileOpen, "Pedro Leandro" . PHP_EOL);
    fwrite($fileOpen, "Airton Sousa" . PHP_EOL);
    fwrite($fileOpen, "Juan Carlos" . PHP_EOL);
    fwrite($fileOpen, "Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos." . PHP_EOL);
    fclose($fileOpen);
} else {
    var_dump(
        file($file),
        pathinfo($file)
    );
}

//echo file($file)[1];

foreach (file($file) as $line) {
    echo "<p>{$line}</p>";
}

$open = fopen($file, "r");

//enquanto não chega até a última linha do arquivo, execute ...
//feof => file end of file
while (!feof($open)) {
    echo "<p>" . fgets($open) . "</p>";
}

fclose($open);

/*
 * [ get, put content ] file_get_contents | file_put_contents
 */
fullStackPHPClassSession("get, put content", __LINE__);

$getContents = __DIR__ . "/fileContents.txt";

if (file_exists($getContents) && is_file($getContents)) {
    echo file_get_contents($getContents);
} else {
    $data = "<article><h1>Pedro</h1><p>Desenvolvedor Backend PHP<br>pedro.credvip@gmail.com</p></article>";
    echo file_put_contents($getContents, $data);
    echo file_get_contents($getContents);
}

if (file_exists(__DIR__ . "/fileTest.txt") && is_file(__DIR__ . "/fileTest.txt")) {
    unlink(__DIR__ . "/fileTest.txt");
}

//unlink($getContents);
//unlink($file);