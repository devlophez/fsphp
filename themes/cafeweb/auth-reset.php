<?php $v->layout("_theme"); ?>

<article class="auth">
    <div class="auth_content container content">
        <header class="auth_header">
            <h1>Criar uma nova senha</h1>
            <p>Informe sua nova senha duas vezes para redefinir.</p>
        </header>

        <form class="auth_form" action="<?= url("/resetar") ?>" method="post"
              enctype="multipart/form-data">
            <div class="ajax_response">
                <?= flash(); ?>
            </div>
            <input type="hidden" name="code" value="<?= $code; ?>">
            <?= csrf_input(); ?>
            <label>
                <div class="unlock-alt">
                    <span class="icon-envelope">Nova senha</span>
                    <span><a title="Voltar e entrar" href="<?= url("/entrar"); ?>">Voltar e entrar!</a></span>
                </div>
                <input type="password" name="password" placeholder="Informe sua nova senha:" required/>
            </label>
            <label>
                <div class="unlock-alt">
                    <span class="icon-envelope">Repita a nova senha</span>
                </div>
                <input type="password" name="password_re" placeholder="Informe sua nova senha novamente:" required/>
            </label>

            <button class="auth_form_btn transition gradient gradient-green gradient-hover">Redefinir Senha</button>
        </form>
    </div>
</article>