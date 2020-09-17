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
        echo "<h1>Home</h1>";
    }

    public function error(array $data): void
    {
        echo "<h1>Erro</h1>";
        var_dump($data);
    }
}