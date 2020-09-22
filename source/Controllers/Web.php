<?php


namespace Source\Controllers;


use Source\Support\Pager;

class Web extends Controller
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");
    }

    public function home(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("home", [
            "head" => $head,
            "video" => "Fl2xeTCxNQo"
        ]);
    }

    public function about(): void
    {
        $head = $this->seo->render(
            "Sobre - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/sobre"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("about", [
            "head" => $head,
            "video" => "Fl2xeTCxNQo"
        ]);
    }

    public function blog(?array $data): void
    {
        $head = $this->seo->render(
            "Blog - " . CONF_SITE_TITLE,
            "Confira em nosso blog dicas e sacadas de como controlar melhor suas contas. Vamos tomar um café?",
            url("/blog"),
            theme("/assets/images/share.jpg")
        );

        $pager = new Pager(url("/blog/page/"));
        $pager->pager(100, 10, $data["page"] ?? 1);

        echo $this->view->render("blog", [
            "head" => $head,
            "paginator" => $pager->render()
        ]);
    }

    public function blogPost(array $data): void
    {
        $postName = $data["postName"];

        $head = $this->seo->render(
            "POST NAME - " . CONF_SITE_TITLE,
            "POST HEADLINE",
            url("/blog/{$postName}"),
            theme("BLOG IMAGE")
        );

        echo $this->view->render("blog-post", [
            "head" => $head,
            "data" => $this->seo->data()
        ]);
    }

    public function login()
    {
        $head = $this->seo->render(
            "Entrar - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/entrar"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("auth-login", [
            "head" => $head
        ]);
    }

    public function forget()
    {
        $head = $this->seo->render(
            "Recuperar Senha - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/recuperar"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("auth-forget", [
            "head" => $head
        ]);
    }

    public function register()
    {
        $head = $this->seo->render(
            "Criar Conta - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/cadastrar"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("auth-register", [
            "head" => $head
        ]);
    }

    public function terms(): void
    {
        $head = $this->seo->render(
            "Termos de uso - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/termos"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("terms", [
            "head" => $head
        ]);
    }

    public function error(array $data): void
    {
        $error = new \stdClass();
        $error->code = $data["errcode"];
        $error->title = "Whoops!!! Serviço indisponível!";
        $error->message = "Sinto muito :/, mas o conteúdo que você está tentando acessar não existe, está indisponível no momento ou já foi removido.";
        $error->linkTitle = "Não fique por aqui. Continue navegando.";
        $error->link = url_back();

        $head = $this->seo->render(
            "{$error->code} | {$error->title}",
            $error->message,
            url("/whops/{$error->code}"),
            theme("/assets/images/share.jpg"),
            false
        );

        echo $this->view->render("error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}