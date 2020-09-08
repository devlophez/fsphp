<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> <?= $title; ?> </title>
</head>
<body>

<header>
    <h3 class="trigger accept"><?= $title; ?></h3>
</header>

<?php if ($v->section("nav")): ?>

    <nav class="trigger info">
        <?= ($v->section("nav")); ?>
    </nav>

<?php else: ?>
    <p class="trigger info">lista de usuários</p>

<?php endif; ?>

<?= $v->section("content"); ?>

</body>
</html>