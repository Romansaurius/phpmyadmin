<?php

declare(strict_types=1);

namespace PhpMyAdmin;

/**
 * Clase Routing básica para phpMyAdmin
 */
class Routing
{
    public static function getDispatcher()
    {
        return new class {
            public function dispatch($method, $uri) {
                return [true, 'main', []];
            }
        };
    }
    
    public static function callControllerForRoute($request, $route, $dispatcher, $containerBuilder): void
    {
        // Redirigir a la página principal de phpMyAdmin
        if (!headers_sent()) {
            header('Location: main.php');
            exit;
        }
        
        // Si no se puede redirigir, mostrar mensaje básico
        echo '<!DOCTYPE html>
<html>
<head>
    <title>phpMyAdmin</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>phpMyAdmin</h1>
    <p>Configuración completada. <a href="main.php">Ir a phpMyAdmin</a></p>
</body>
</html>';
    }
}