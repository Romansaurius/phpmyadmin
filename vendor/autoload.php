<?php

// Autoloader básico para phpMyAdmin
spl_autoload_register(function ($class) {
    // Convertir namespace a path
    $prefix = 'PhpMyAdmin\\';
    $base_dir = __DIR__ . '/../libraries/classes/';
    
    // Verificar si la clase usa el namespace prefix
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    // Obtener el nombre relativo de la clase
    $relative_class = substr($class, $len);
    
    // Reemplazar namespace separators con directory separators
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    // Si el archivo existe, incluirlo
    if (file_exists($file)) {
        require $file;
    }
});

// Funciones básicas requeridas
if (!function_exists('_')) {
    function _($text) {
        return $text;
    }
}

if (!function_exists('_ngettext')) {
    function _ngettext($singular, $plural, $number) {
        return ($number == 1) ? $singular : $plural;
    }
}