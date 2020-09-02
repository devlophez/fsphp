<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.05 - Sintetizando e abstraindo");

require __DIR__ . "/../vendor/autoload.php";

/*
 * [ synthesize ]
 */
fullStackPHPClassSession("synthesize", __LINE__);

$email = (new \Source\Core\Email())->bootstrap(
    "Olá, Mundo. Esse é meu disparo de e-mail utilizando um componente",
    "<h1>Olá, Mundo</h1>",
    "pedro.leandrog@gmail.com",
    "Pedro Leandro"
);

//var_dump($email);

$email->attach(__DIR__ . "/../../../fsphp/fullstackphp/fsphp.css", "fsphp_css");

//verificar qual tipo de arquivo é permitido

if ($email->send()) {
    echo message()->success("E-mail enviado com sucesso.");
} else {
    echo $email->message();
}