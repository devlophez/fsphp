<?php

namespace Source\Core;

use \PDO;
use \PDOException;

/**
 * Class Connect
 * @package Source\Core
 */
class Connect
{
    /**
     * Configuração padrão de credenciais de conexão
     */
//    private const HOST = "localhost";
//    private const USER = "root";
//    private const PASSWORD = "";
//    private const DBNAME = "fsphp_pdo";

    /**
     * 1. Garante que o charset utilizado no banco de dados seja o mesmo utf8
     * 2. Sempre que ocorrer um erro, haverá uma exceção
     * 3. Retorna o resultado em convertido em objeto
     * 4. Garante que o nome das colunas sejam no mesmo padrão do banco de dados
     */
    private const OPTIONS = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ];

    /**
     * Armazena o objeto PDO e garante uma conexão por usuário (One to One)
     */
    private static $instance;

    /**
     * @return PDO
     * Verifica se já existe uma conexão estabelecida e caso não exista
     * é criada uma nova conexão e a mesma é retonada
     */
    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . CONF_DB_HOST . ";dbname=" . CONF_DB_NAME,
                    CONF_DB_USER,
                    CONF_DB_PASS,
                    self::OPTIONS
                );
            } catch (PDOException $exception) {
                die("<h1>Whooops! Erro ao conectar...</h1>");
            }
        }
        return self::$instance;
    }

    /**
     * criar os métodos como final private garante que
     * a classe não construa apenas um objeto e nem clone outros novos
     * objetos mesmo que a classe Connect seja herdada por outra classe
     */

    final private function __construct()
    {
    }

    /**
     * Connect clone
     */
    final private function __clone()
    {
        // TODO: Implement __clone() method.
    }
}