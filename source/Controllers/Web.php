<?php


namespace Source\Controllers;


use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Faq\Channel;
use Source\Models\Faq\Question;
use Source\Core\Connect;
use Source\Models\Post;
use Source\Models\User;
use Source\Support\Pager;

/**
 * Class Web
 * @package Source\Controllers
 */
class Web extends Controller
{
    /**
     * Web constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");
    }

    /**
     * SITE HOME
     */
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
            "video" => "Fl2xeTCxNQo",
            "blog" => (new Post())
                ->find()
                ->order("post_at DESC")
                ->limit(6)
                ->fetch(true)
        ]);
    }

    /**
     * SITE ABOUT
     */
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
            "video" => "Fl2xeTCxNQo",
            "faq" => (new Question())
                ->find("channel_id = :id", "id=1", "question, response")
                ->order("order_by")
                ->fetch(true)
        ]);
    }

    /**
     * SITE BLOG
     * @param array|null $data
     */
    public function blog(?array $data): void
    {
        $head = $this->seo->render(
            "Blog - " . CONF_SITE_TITLE,
            "Confira em nosso blog dicas e sacadas de como controlar melhor suas contas. Vamos tomar um café?",
            url("/blog"),
            theme("/assets/images/share.jpg")
        );

        $blog = (new Post())->find();
        $pager = new Pager(url("/blog/p/"));
        $pager->pager($blog->count(), 9, $data['page'] ?? 1);

        echo $this->view->render("blog", [
            "head" => $head,
            "blog" => $blog->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }


    /**
     * SITE BLOG SEARCH
     * @param array $data
     */
    public function blogSearch(array $data): void
    {
        if (!empty($data['s'])) {
            $search = filter_var($data['s'], FILTER_SANITIZE_STRIPPED);
            echo json_encode(["redirect" => url("/blog/buscar/{$search}/1")]);
            return;
        }

        if (empty($data['terms'])) {
            redirect("/blog");
        }

        $search = filter_var($data['terms'], FILTER_SANITIZE_STRIPPED);
        $page = (filter_var($data['page'], FILTER_VALIDATE_INT) >= 1 ? $data['page'] : 1);

        $head = $this->seo->render(
            "Pesquisa por {$search} - " . CONF_SITE_NAME,
            "Confira os resultados de sua pesquisa para {$search}",
            url("/blog/buscar/{$search}/{$page}"),
            theme("/assets/images/share.jpg")
        );

        $blogSearch = (new Post())->find("(title LIKE :s OR subtitle LIKE :s)", "s=%{$search}%");

        if (!$blogSearch->count()) {
            echo $this->view->render("blog", [
                "head" => $head,
                "title" => "PESQUISA POR:",
                "search" => $search
            ]);
            return;
        }

        $pager = new Pager(url("/blog/buscar/{$search}/"));
        $pager->pager($blogSearch->count(), 9, $page);

        echo $this->view->render("blog", [
            "head" => $head,
            "title" => "PESQUISA POR:",
            "search" => $search,
            "blog" => $blogSearch->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    /**
     * SITE BLOG POST
     * @param array $data
     */
    public function blogPost(array $data): void
    {
        $post = (new Post())->findByUri($data["uri"]);

        if (!$post) {
            redirect("/404");
        }

        $post->views += 1;
        $post->save();

        $head = $this->seo->render(
            "{$post->title} - " . CONF_SITE_TITLE,
            $post->subtitle,
            url("/blog/{$post->uri}"),
            image($post->cover, 1200, 628)
        );

        echo $this->view->render("blog-post", [
            "head" => $head,
            "post" => $post,
            "related" => (new Post())
                ->find("category = :c AND id != :i", "c={$post->category}&i={$post->id}")
                ->order("rand()")
                ->limit(3)
                ->fetch(true)
        ]);
    }

    /**
     * SITE LOGIN
     * @param null|array $data
     */
    public function login(?array $data): void
    {
        if (Auth::user()) {
            redirect("/app/");
        }

        if (!empty($data["csrf"])) {
            if (!csrf_verify($data)) {
                $json["message"] = $this->message->error("Erro ao enviar, verifique suas credenciais")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data["email"]) || empty($data["password"])) {
                $json["message"] = $this->message->warning("Informe corretamente seu e-mail e senha")->render();
                echo json_encode($json);
                return;
            }

            $save = (!empty($data["save"]) ? true : false);
            $auth = new Auth();
            $login = $auth->login($data["email"], $data["password"], $save);

            if ($login) {
                $json["redirect"] = url("/app");
            } else {
                $json["message"] = $auth->message()->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Entrar - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/entrar"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("auth-login", [
            "head" => $head,
            "cookie" => filter_input(INPUT_COOKIE, "authEmail")
        ]);
    }

    /**
     * SITE FORGET
     * @param null|array $data
     */
    public function forget(?array $data): void
    {
        if (!empty($data["csrf"])) {
            if (!csrf_verify($data)) {
                $json["message"] = $this->message->error("Erro ao enviar, verifique se o e-mail está correto")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data["email"])) {
                $json["message"] = $this->message->info("Informe seu e-mail para continuar")->render();
                echo json_encode($json);
                return;
            }

            $auth = new Auth();
            if ($auth->forget($data["email"])) {
                $json["message"] = $this->message->success("Acesse seu e-mail para redefinir sua senha")->render();
            } else {
                $json["message"] = $auth->message()->render();
            }

            echo json_encode($json);
            return;
        }

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

    /**
     * SITE REGISTER
     * @param null|array $data
     */
    public function register(?array $data): void
    {
        if (!empty($data["csrf"])) {
            if (!csrf_verify($data)) {
                $json["message"] = $this->message->error("Erro ao enviar, verifique os dados do formulário")->render();
                echo json_encode($json);
                return;
            }

            if (in_array("", $data)) {
                $json["message"] = $this->message->info("Informe seus dados corretamente para criar a conta")->render();
                echo json_encode($json);
                return;
            }

            $auth = new Auth();
            $user = new User();

            $user->bootstrap(
                $data["first_name"],
                $data["last_name"],
                $data["email"],
                $data["password"]
            );

            if ($auth->register($user)) {
                $json["redirect"] = url("/confirma");
            } else {
                $json["message"] = $auth->message()->render();
            }

            echo json_encode($json);
            return;
        }

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

    /**
     * SITE CONFIRM
     */
    public function confirm(): void
    {
        $head = $this->seo->render(
            "Confirme seu cadastro - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/confirma"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("optin", [
            "head" => $head,
            "data" => (object)[
                "title" => "Falta pouco! Confirme seu cadastro.",
                "desc" => "Enviamos um link de confirmação para seu e-mail. Acesse e siga as instruções para concluir seu cadastro e comece a controlar com o CaféControl",
                "image" => theme("/assets/images/optin-confirm.jpg")
            ]
        ]);
    }

    /**
     * SITE SUCCESS
     * @param array $data
     */
    public function success(array $data): void
    {
        $email = base64_decode($data["email"]);
        $user = (new User)->findByEmail($email);

        if ($user && $user->status != "confirmed") {
            $user->status = "confirmed";
            $user->save();
        }

        $head = $this->seo->render(
            "Bem vindo(a) ao " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/obrigado"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("optin", [
            "head" => $head,
            "data" => (object)[
                "title" => "Tudo pronto. Você já pode controlar :)",
                "desc" => "Bem-vindo(a) ao seu controle de contas, vamos tomar um café?",
                "image" => theme("/assets/images/optin-success.jpg"),
                "link" => url("/entrar"),
                "linkTitle" => "Fazer Login"
            ]
        ]);
    }

    /**
     * SITE TERMS
     */
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

    /**
     * SITE ERROR
     * @param array $data
     */
    public function error(array $data): void
    {
        $error = new \stdClass();

        switch ($data["errcode"]) {
            case "problemas":
                $error->code = "OPS!!!";
                $error->title = "Estamos enfrentando problemas!";
                $error->message = "Parece que nossos serviços não estão disponíveis no momento. Já estamos analisando isso, mas caso seja urgente, nos envie um e-mail. :/";
                $error->linkTitle = "Envie um e-mail.";
                $error->link = "mailto:" . CONF_MAIL_SUPPORT;
                break;

            case "manutencao":
                $error->code = "OPS!!!";
                $error->title = "Desculpe, estamos em manutenção!";
                $error->message = "Voltamos logo! Neste momento estamos trabalhando para você controlar melhor as suas contas. :P";
                $error->linkTitle = null;
                $error->link = null;
                break;

            default:
                $error->code = $data["errcode"];
                $error->title = "Whoops!!! Serviço indisponível!";
                $error->message = "Sinto muito :/, mas o conteúdo que você está tentando acessar não existe, está indisponível no momento ou já foi removido.";
                $error->linkTitle = "Não fique por aqui. Continue navegando.";
                $error->link = url_back();
                break;
        }

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