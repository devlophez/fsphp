<?php


namespace Source\Controllers;


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
            url("/assets/images/share.jpg")
        );

        echo $this->view->render("home", [
            "head" => $head,
            "video" => "Fl2xeTCxNQo"
        ]);
    }

    public function about()
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/assets/images/share.jpg")
        );

        echo $this->view->render("about", [
            "head" => $head,
            "video" => "Fl2xeTCxNQo"
        ]);
    }


    public function terms()
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/assets/images/share.jpg")
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
            url_back("/whops/{$error->code}"),
            url("/assets/images/share.jpg"),
            false
        );

        echo $this->view->render("error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}