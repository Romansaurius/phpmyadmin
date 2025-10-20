<?php

declare(strict_types=1);

if (! defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
}

if (PHP_VERSION_ID < 70205) {
    die('<p>PHP 7.2.5+ is required.</p><p>Currently installed version is: ' . PHP_VERSION . '</p>');
}

define('PHPMYADMIN', true);

// Definir constantes directamente
define('PMA_VERSION', '5.2.3');
define('CONFIG_FILE', ROOT_PATH . 'config.inc.php');
define('AUTOLOAD_FILE', ROOT_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

// Cargar configuración
global $cfg;
if (file_exists(CONFIG_FILE)) {
    include CONFIG_FILE;
}

// Verificar configuración
if (empty($cfg['Servers'][1]['host'])) {
    die('Error: No database server configured.');
}

// Redirigir a main.php
header('Location: main.php');
exit;
