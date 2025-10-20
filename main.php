<?php

declare(strict_types=1);

if (! defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
}

define('PHPMYADMIN', true);
define('CONFIG_FILE', ROOT_PATH . 'config.inc.php');

// Cargar configuración
global $cfg;
if (file_exists(CONFIG_FILE)) {
    include CONFIG_FILE;
}

// Verificar configuración de base de datos
if (empty($cfg['Servers'][1]['host'])) {
    die('Error: No se ha configurado el servidor de base de datos.');
}

// Intentar conectar a la base de datos
$connection = @mysqli_connect(
    $cfg['Servers'][1]['host'],
    $cfg['Servers'][1]['user'],
    $cfg['Servers'][1]['password']
);

if (!$connection) {
    $error = mysqli_connect_error();
    die("Error de conexión: " . $error);
}

// Si llegamos aquí, la conexión es exitosa
mysqli_close($connection);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phpMyAdmin</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .success { color: #28a745; background: #d4edda; padding: 15px; border-radius: 4px; margin: 20px 0; }
        .info { color: #0c5460; background: #d1ecf1; padding: 15px; border-radius: 4px; margin: 20px 0; }
        h1 { color: #333; }
        .config-info { background: #f8f9fa; padding: 15px; border-left: 4px solid #007bff; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 phpMyAdmin - Configuración Exitosa</h1>
        
        <div class="success">
            <strong>¡Excelente!</strong> Tu instalación de phpMyAdmin está funcionando correctamente.
        </div>
        
        <div class="info">
            <strong>Conexión a la base de datos:</strong> ✅ Exitosa<br>
            <strong>Servidor:</strong> <?php echo htmlspecialchars($cfg['Servers'][1]['host']); ?><br>
            <strong>Usuario:</strong> <?php echo htmlspecialchars($cfg['Servers'][1]['user']); ?>
        </div>
        
        <div class="config-info">
            <h3>Para desplegar en Render:</h3>
            <ol>
                <li>Asegúrate de que tu archivo <code>render.yaml</code> esté configurado correctamente</li>
                <li>Sube tu código a un repositorio de GitHub</li>
                <li>Conecta el repositorio con Render</li>
                <li>Configura las variables de entorno en Render si es necesario</li>
            </ol>
        </div>
        
        <p><strong>Nota:</strong> Esta es una versión simplificada de phpMyAdmin. Para funcionalidad completa, 
        considera descargar la versión oficial desde <a href="https://www.phpmyadmin.net/" target="_blank">phpmyadmin.net</a></p>
    </div>
</body>
</html>