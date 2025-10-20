<?php

declare(strict_types=1);

namespace PhpMyAdmin;

/**
 * Clase Common básica para phpMyAdmin
 */
class Common
{
    public static function run(): void
    {
        // Configuración básica
        if (!defined('PMA_MINIMUM_COMMON')) {
            self::minimumCommon();
        }
        
        // Cargar configuración
        global $cfg;
        if (file_exists(CONFIG_FILE)) {
            include CONFIG_FILE;
        }
        
        // Configurar sesión
        if (!session_id()) {
            session_start();
        }
    }
    
    private static function minimumCommon(): void
    {
        define('PMA_MINIMUM_COMMON', true);
        
        // Configurar timezone
        if (function_exists('date_default_timezone_set')) {
            date_default_timezone_set('UTC');
        }
        
        // Configurar encoding
        if (function_exists('mb_internal_encoding')) {
            mb_internal_encoding('UTF-8');
        }
    }
}