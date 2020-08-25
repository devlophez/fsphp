<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("06.11 - Refatorando modelo de usuário");

require __DIR__ . "/../source/autoload.php";

/*
 * [ find ]
 */
fullStackPHPClassSession("find", __LINE__);

$model = new Source\Models\User();
$user = $model->find("id = :id", "id=1");

var_dump($user);

/*
 * [ find by id ]
 */
fullStackPHPClassSession("find by id", __LINE__);

$user = $model->findById(2);
var_dump($user);

/*
 * [ find by email ]
 */
fullStackPHPClassSession("find by email", __LINE__);

$user = $model->findByEmail("sidney38@email.com.br");
var_dump($user);

/*
 * [ all ]
 */
fullStackPHPClassSession("all", __LINE__);

$list = $model->all(2, 5);
var_dump($list);

/*
 * [ save ]
 */
fullStackPHPClassSession("save create", __LINE__);

$user = $model->bootstrap(
    "Pedro",
    "Silva",
    "pedro@credvip.com",
    "12345654"
);

if ($user->save()) {
    echo message()->success("Cadastro realizado com sucesso");
} else {
    echo $user->message();
    echo message()->info($user->message()->json());
}

/*
 * [ save update ]
 */
fullStackPHPClassSession("save update", __LINE__);

$user = (new \Source\Models\User())->findById(51);

$user->first_name = "Airton";
$user->last_name = "Sousa";
$user->password = 23456543;

if ($user->save()) {
    echo message()->success("Cadastro atualizado com sucesso");
} else {
    echo $user->message();
    echo message()->info($user->message()->json());
}

var_dump($user);