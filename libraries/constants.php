<?php

declare(strict_types=1);

/**
 * phpMyAdmin constants
 */

if (! defined('PHPMYADMIN')) {
    exit;
}

/**
 * Misc settings
 */
define('PMA_VERSION', '5.2.3');
define('PMA_MAJOR_VERSION', 5);

/**
 * Path definitions
 */
define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

if (! defined('CONFIG_FILE')) {
    define('CONFIG_FILE', ROOT_PATH . 'config.inc.php');
}

if (! defined('CUSTOM_HEADER_FILE')) {
    define('CUSTOM_HEADER_FILE', ROOT_PATH . 'config.header.inc.php');
}

if (! defined('CUSTOM_FOOTER_FILE')) {
    define('CUSTOM_FOOTER_FILE', ROOT_PATH . 'config.footer.inc.php');
}

/**
 * Autoloader
 */
if (! defined('AUTOLOAD_FILE')) {
    define('AUTOLOAD_FILE', ROOT_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
}

/**
 * Directory separator
 */
if (! defined('DIRECTORY_SEPARATOR')) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        define('DIRECTORY_SEPARATOR', '\\');
    } else {
        define('DIRECTORY_SEPARATOR', '/');
    }
}

/**
 * Other constants
 */
define('PMA_USR_OS', 'Win');
define('PMA_USR_BROWSER_VER', '');
define('PMA_USR_BROWSER_AGENT', '');

/**
 * MySQL constants
 */
define('PMA_MYSQL_STR_VERSION', '5.7.0');
define('PMA_MYSQL_INT_VERSION', 50700);

/**
 * phpMyAdmin theme path
 */
define('PMA_THEME_PATH', ROOT_PATH . 'themes' . DIRECTORY_SEPARATOR);
define('PMA_THEME_VERSION', 2);

/**
 * Cookie constants
 */
define('PMA_COOKIE_EXPIRY_TIME', 1440);

/**
 * String constants
 */
define('PMA_STRING_NATIVE', 'native');
define('PMA_STRING_COOKIE', 'cookie');
define('PMA_STRING_HTTP', 'http');
define('PMA_STRING_SIGNON', 'signon');
define('PMA_STRING_CONFIG', 'config');

/**
 * Server constants
 */
define('PMA_ENGINE_KEYWORD', 'ENGINE');
define('PMA_DRIZZLE', 0);

/**
 * Relation constants
 */
define('PMA_FOREIGN_KEY_DROPDOWN_ORDER', array('content-id', 'id-content'));

/**
 * Max field size
 */
define('PMA_MAX_FIELD_SIZE', 1000);

/**
 * Other useful constants
 */
define('PMA_MYSQL_MAJOR_VERSION', (int) substr(PMA_MYSQL_STR_VERSION, 0, 1));

if (! defined('PMA_IS_WINDOWS')) {
    if (defined('PHP_OS')) {
        define('PMA_IS_WINDOWS', (stristr(PHP_OS, 'win') && !stristr(PHP_OS, 'darwin')) ? 1 : 0);
    } else {
        define('PMA_IS_WINDOWS', 0);
    }
}

/**
 * Charset to convert to
 */
define('PMA_CHARSET_TO_CONVERT', 'iso-8859-1');