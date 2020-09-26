<?php $v->layout("_theme"); ?>


<article class="optin_page">
    <div class="container content">
        <div class="optin_page_content">
            <?php if ($user->photo): ?>
                <img class="page_user_photo" src="<?= image($user->photo, 300); ?>" alt="<?= $user->first_name; ?>"
                     title="<?= $user->first_name; ?>"/>
            <?php endif; ?>
            <h1>Olá <?= $user->first_name; ?>,</h1>
            <p>Aqui é sua conta no projeto, mas por enquanto a única coisa que você pode fazer é sair dela :P</p>
            <p><a class="btn btn-green" href="<?= url("/app/sair"); ?>" title="Sair agora">SAIR AGORA :)</a></p>
        </div>
    </div>
</article>
