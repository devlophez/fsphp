<?php


namespace Source\Controllers;


use Source\Core\Controller;
use Source\Core\Session;
use Source\Models\Auth;
use Source\Models\Post;
use Source\Models\User;
use Source\Support\Message;

/**
 * Class App
 * @package Source\Controllers
 */
class App extends Controller
{
    /**
     * App constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_APP);

        //RESTRIÇÃO
        if (!Auth::user()) {
            $this->message->warning("Faça login para continuar")->flash();
            redirect("/entrar");
        }
    }

    /**
     *
     */
    public function home()
    {
        $head = $this->seo->render(
            "Dashboard - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("dashboard", [
            "head" => $head,
            "user" => (new User())->findById(51)
        ]);
    }

    /**
     *
     */
    public function logoff()
    {
        (new Message())->info("Você acabou de sair " . Auth::user()->first_name . ". Volte logo :)")->flash();

        Auth::logoff();
        redirect("/entrar");
    }
}