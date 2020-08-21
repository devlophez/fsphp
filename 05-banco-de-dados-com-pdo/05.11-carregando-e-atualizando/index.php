<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.11 - Carregando e atualizando");

require __DIR__ . "/../source/autoload.php";

/*
 * [ save update ] Salvar o usuário ativo (Active Record)
 */
fullStackPHPClassSession("save update", __LINE__);

$model = new \Source\Models\User();

$user = $model->load(5);

$user->first_name = "Airton";
$user->last_name = "Sousa";
$user->email = "airton@credvip.com";

if($user != $model->load(5)){
    $user->save();
    echo "<p class='trigger accept'>Atualizado!</p>";
}else{
    echo "<p class='trigger warning'>Já atualizado!</p>";
}

var_dump($user);