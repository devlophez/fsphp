<?php


/**
 * ####################
 * ###   VALIDATE   ###
 * ####################
 */


/**
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param string $password
 * @return bool
 */
function is_password(string $password): bool
{
    return mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN;
}

/**
 * @param string $password
 * @return string
 */
function passwd(string $password): string
{
    return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/**
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/**
 * @param string $hash
 * @return bool
 */
function passwd_rehash(string $hash): bool
{
    return password_needs_rehash($hash, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/**
 * @return string
 */
function csrf_input(): string
{
    session()->csrf();
    return "<input type='hidden' name='csrf' value='" . (session()->csrf_token) . "'>";
}

/**
 * @param $request
 * @return bool
 */
function csrf_verify($request): bool
{
    if (empty(session()->csrf_token) || empty($request['csrf']) || $request['csrf'] != session()->csrf_token) {
        return false;
    }
    return true;
}

/**
 * ##################
 * ###   STRING   ###
 * ##################
 */


/**
 * captura uma string qualquer e transforma isso em url
 * @param string $string
 * @return string
 */
function str_slug(string $string): string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    /**
     * trim() é para tratar espaços desnecessários
     * strtr(fonte de dados, fonte de substituição, pelo quê substituir) é para fazer a susbtituição dos caracteres
     * utf8_decode() é para manter as letras após as retiradas dos acentos
     * str_replace() é para substituir, nesse exemplo, o espaço pelo traço
     */

    $slug = str_replace(
        [
            "-----",
            "----",
            "---",
            "--",
        ],
        "-",
        str_replace(
            " ",
            "-",
            trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
        )
    );
    return $slug;
}

/**
 * converter uma requisição em um nome de classe e compor um mvc
 */

/**
 * @param string $string
 * @return string
 */
function str_studly_case(string $string): string
{
    $string = str_slug($string);
    $studlyCase = str_replace(" ", "",
        mb_convert_case(str_replace("-", " ", $string), MB_CASE_TITLE)
    );
    return $studlyCase;
}

/**
 * tratar nome de métodos
 */

/**
 * @param string $string
 * @return string
 */
function str_camel_case(string $string): string
{
    return lcfirst(str_studly_case($string));
}

/**
 * Converter em título
 */

/**
 * @param string $string
 * @return string
 */
function str_title(string $string): string
{
    return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_words(string $string, int $limit, string $pointer = "..."): string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    $arrWords = explode(" ", $string);
    $numWords = count($arrWords);

    if ($numWords < $limit) return $string;

    $words = implode(" ", array_slice($arrWords, 0, $limit));

    return "{$words}{$pointer}";
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_chars(string $string, int $limit, string $pointer = "..."): string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    if (mb_strlen($string) <= $limit) {
        return $string;
    }

    $chars = mb_substr($string, 0, mb_strripos(mb_substr($string, 0, $limit), " "));
    return "{$chars}{$pointer}";
}

/**
 * ##################
 * ###   STRING   ###
 * ##################
 */

/**
 * @param string $url
 * @return string
 */
function url(string $path): string
{
    return CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
}

/**
 * ####################
 * ###   NAVIGATE   ###
 * ####################
 */

/**
 * @param string $url
 */
function redirect(string $url): void
{
    //para poder informar o redirecionamento para os diferentes motores (google, api, etc).
    header("HTTP/1.1 302 Redirect");

    //Quando há a necessidade de um redirecionamento externo com https ou http.
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    $location = url($url);
    header("Location: {$location}");
    exit;
}

/**
 * ################
 * ###   CORE   ###
 * ################
 */

/**
 * @return PDO
 */
function connect(): PDO
{
    return \Source\Core\Connect::getInstance();
}

/**
 * @return \Source\Core\Message
 */
function message(): \Source\Core\Message
{
    return new \Source\Core\Message();
}

/**
 * @return \Source\Core\Session
 */
function session(): \Source\Core\Session
{
    return new \Source\Core\Session();
}

/**
 * @return \Source\Models\User
 */
function user(): \Source\Models\User
{
    return new \Source\Models\User();
}