<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("06.10 - Mitigando ataques XSS e CSRF");

require __DIR__ . "/../source/autoload.php";

/*
 * [ XSS ] Cross-site Scripting
 * https://pt.wikipedia.org/wiki/Cross-site_scripting
 */
fullStackPHPClassSession("xxs", __LINE__);

//$post = $_POST;

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
if ($post) {
    $data = (object)$post;
    var_dump($post);

    echo $data->first_name;
}

/*
 * [ CSRF ] Cross-Site Request Forgery
 * https://pt.wikipedia.org/wiki/Cross-site_request_forgery
 */
fullStackPHPClassSession("csrf", __LINE__);

//é o pior meio de receber uma requisição, mas é importante validar aonde tenha uma brecha maior
//var_dump($_REQUEST);

/**
 * qual é o problema? o problema é aceitar os dados do formulário toda vez que uma requisição nova é solicitada
 * advertência: isso não pode acontecer.
 * solução: criar csrf_token para cada solicitação de requisição
 *
 * a cada submissão de uma nova requisição, o token do formulário e da requisição são devidamente alterados
 *
 * mas caso a cada solicitação atualizada no navegador seja feita, o token do formulário muda,
 * mas o token da requisição não, e com isso, é possível fazer uma recusa.
 */

if ($_REQUEST && !csrf_verify($_REQUEST)) {
    var_dump("csrf bloqueada!");
} else {
    var_dump($_REQUEST);
}


/*
 * [ form ]
 */
fullStackPHPClassSession("form", __LINE__);

require __DIR__ . "/form.php";