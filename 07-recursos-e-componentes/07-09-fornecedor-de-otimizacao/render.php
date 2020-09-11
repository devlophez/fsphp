<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php
    require __DIR__ . "/../vendor/autoload.php";

    $seo = new \Source\Support\Seo();
    $seo->render(
        "Formação Full Stack PHP Developer",
        "",
        "https://www.upinside.com.br/fsphp",
        "https://www.upinside.com.br/fsphp/images/cover.jpg"
    );
    ?>

    <title>Recursos e Componentes</title>
</head>
<body>
<h1><?= $seo->title ?></h1>

<?= "<pre>", print_r($seo->data(), true), "</pre>"; ?>
</body>
</html>
