<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("06.08 - Camada de manipulação pt3");

require __DIR__ . "/../source/autoload.php";

/*
 * [ validate helpers ] Funções para sintetizar rotinas de validação
 */
fullStackPHPClassSession("validate", __LINE__);

$message = new \Source\Core\Message();

$email = "ti@credvip.com";

if (!is_email($email)) {
    echo $message->error("E-mail inválido!");
} else {
    echo $message->success("E-mail válido!");
}

$passwd = "12345678";

if (!is_password($passwd)) {
    echo $message->error("Senha inválida!");
} else {
    echo $message->success("Senha válida!");
}

/*
 * [ navigation helpers ] Funções para sintetizar rotinas de navegação
 */
fullStackPHPClassSession("navigation", __LINE__);

var_dump([
    url("/blog/titulo-do-artigo"),
    url("blog/titulo-do-artigo")
]);

if (empty($_GET)) {
//    redirect("https://portal.credvip.com");
    redirect("?f=true");
}


/*
 * [ class triggers ] São gatilhos globais para criação de objetos
 */
fullStackPHPClassSession("triggers", __LINE__);

var_dump(user()->load(1));

echo message()->error("Essa é uma mensagem de erro!");
echo message()->warning("Essa é uma mensagem de advertência!");
echo message()->info("Essa é uma mensagem de informação!");
echo message()->success("Essa é uma mensagem de sucesso!");

session()->set("user", user()->load(1));

var_dump(session()->all());

