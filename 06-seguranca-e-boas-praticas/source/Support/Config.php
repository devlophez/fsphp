<?php
/**
 * DATABASE
 */

define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "");
define("CONF_DB_NAME", "fsphp_pdo");


/**
 * PROJECT URLs
 */

//Windows
//define("CONF_URL_BASE", "http://localhost/fsphp");

//Linux
define("CONF_URL_BASE", "http://localhost/web/upinside/fsphp");
define("CONF_URL_ADMIN", CONF_URL_BASE . "/admin");
define("CONF_URL_ERROR", CONF_URL_BASE . "/404");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * SESSIONS
 */
define("CONF_SES_PATH", __DIR__ . "/../../storage/sessions");