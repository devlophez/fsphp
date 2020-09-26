<?php
/**
 * DATABASE
 */
define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "");
define("CONF_DB_NAME", "cafecontrol");

/**
 * PROJECT URLs
 */
//Windows
//define("CONF_URL_BASE", "http://localhost/fsphp/");

//Linux
define("CONF_URL_BASE", "http://localhost/web/upinside/fsphp");
define("CONF_URL_HOMO", "http://localhost/web/upinside/fsphp");
define("CONF_URL_ADMIN", "/admin");

/**
 * SITE
 */
define("CONF_SITE_NAME", "CafeControl");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "upinside.com.br");
define("CONF_SITE_TITLE", "Gerencie suas finanças com o melhor café");
define("CONF_SITE_DESC", "O CafeControl é um gerenciador de contas simples, poderoso e gratuito. O prazer de tomar um café e ter o controle total de suas contas.");
define("CONF_SITE_ADDR_STREET", "Rua Castelo Branco - Campo de Belém");
define("CONF_SITE_ADDR_NUMBER", "1119 F");
define("CONF_SITE_ADDR_COMPLEMENT", "Residência");
define("CONF_SITE_ADDR_CITY", "Caxias");
define("CONF_SITE_ADDR_STATE", "MA");
define("CONF_SITE_ADDR_ZIPCODE", "65609-130");

/**
 * SOCIAL
 */

define("CONF_SOCIAL_TWITTER_CREATOR", "@pedroleandrog");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "@pedroleandrog");
define("CONF_SOCIAL_FACEBOOK_APP", "629370597769942");
define("CONF_SOCIAL_FACEBOOK_PAGE", "pedroleandro.gomesdasilva.3");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "pedroleandro.gomesdasilva.3");
define("CONF_SOCIAL_GOOGLE_PAGE", "");
define("CONF_SOCIAL_GOOGLE_AUTHOR", "");
define("CONF_SOCIAL_INSTAGRAM_PAGE", "pedroleandrogsilva");
define("CONF_SOCIAL_YOUTUBE_PAGE", "");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * MESSAGE
 */
define("CONF_MESSAGE_CLASS", "message");
define("CONF_MESSAGE_INFO", "info icon-info");
define("CONF_MESSAGE_SUCCESS", "success icon-check-square-o");
define("CONF_MESSAGE_WARNING", "warning icon-warning");
define("CONF_MESSAGE_ERROR", "error icon-warning");

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_THEME", "cafeweb");
define("CONF_VIEW_APP", "cafeapp");
define("CONF_VIEW_EXT", "php");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
/**
 * MAIL
 */
define("CONF_MAIL_HOST", "smtp.sendgrid.net");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USER", "apikey");
define("CONF_MAIL_PASS", "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");
define("CONF_MAIL_SUPPORT", "pedroleandro@acad.ifma.edu.br");
define("CONF_MAIL_SENDER", [
    "name" => "Pedro Leandro",
    "address" => "pedroleandro@acad.ifma.edu.br"
]);

define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");