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

// Configurar timeout de conexión
ini_set('default_socket_timeout', 10);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$connection_success = false;
$error_message = '';

try {
    // Intentar conectar a la base de datos con puerto
    $connection = mysqli_connect(
        $cfg['Servers'][1]['host'],
        $cfg['Servers'][1]['user'],
        $cfg['Servers'][1]['password'],
        '',
        (int)($cfg['Servers'][1]['port'] ?? 3306)
    );
    
    if ($connection) {
        $connection_success = true;
        
        // Obtener lista de bases de datos
        $databases = [];
        $result = mysqli_query($connection, "SHOW DATABASES");
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                $databases[] = $row[0];
            }
        }
        
        // Obtener tablas de la base de datos 'railway'
        $tables = [];
        $current_db = 'railway';
        if (in_array('railway', $databases)) {
            mysqli_select_db($connection, 'railway');
            $result = mysqli_query($connection, "SHOW TABLES");
            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    $tables[] = $row[0];
                }
            }
        }
        
        mysqli_close($connection);
    }
} catch (Exception $e) {
    $error_message = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phpMyAdmin</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; background: #f8f9fa; }
        .header { background: #2c3e50; color: white; padding: 15px 30px; }
        .header h1 { margin: 0; font-size: 24px; }
        .container { max-width: 1200px; margin: 20px auto; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; }
        .success { color: #155724; background: #d4edda; padding: 15px; border-left: 4px solid #28a745; margin: 20px; }
        .info { color: #0c5460; background: #d1ecf1; padding: 15px; border-left: 4px solid #17a2b8; margin: 20px; }
        .content { padding: 20px; }
        .db-section { background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 6px; margin: 15px 0; }
        .db-header { background: #e9ecef; padding: 12px 15px; border-bottom: 1px solid #dee2e6; font-weight: bold; }
        .db-content { padding: 15px; }
        .table-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 10px; }
        .table-item { background: white; border: 1px solid #dee2e6; padding: 10px; border-radius: 4px; display: flex; align-items: center; }
        .table-item:hover { background: #f8f9fa; }
        ul { list-style: none; padding: 0; margin: 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🐬 phpMyAdmin</h1>
    </div>
    <div class="container">
        <div class="content">
        
        <?php if ($connection_success): ?>
        <div class="success">
            <strong>¡Excelente!</strong> Tu instalación de phpMyAdmin está funcionando correctamente.
        </div>
        
        <div class="info">
            <strong>Conexión a la base de datos:</strong> ✅ Exitosa<br>
            <strong>Servidor:</strong> <?php echo htmlspecialchars($cfg['Servers'][1]['host']); ?><br>
            <strong>Puerto:</strong> <?php echo $cfg['Servers'][1]['port'] ?? 3306; ?><br>
            <strong>Usuario:</strong> <?php echo htmlspecialchars($cfg['Servers'][1]['user']); ?>
        </div>
        
        <?php if (!empty($databases)): ?>
        <div class="config-info">
            <h3>📊 Bases de datos disponibles:</h3>
            <ul>
                <?php foreach ($databases as $db): ?>
                    <li><strong><?php echo htmlspecialchars($db); ?></strong></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        
        <div class="db-section">
            <div class="db-header">
                📋 Base de datos: railway
            </div>
            <div class="db-content">
                <?php if (!empty($tables)): ?>
                    <div class="table-list">
                        <?php foreach ($tables as $table): ?>
                            <div class="table-item">
                                🗂️ <?php echo htmlspecialchars($table); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>📝 No hay tablas en la base de datos 'railway'.</p>
                    <p><strong>Tip:</strong> Crea tablas desde Railway para verlas aquí.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php else: ?>
        <div style="color: #721c24; background: #f8d7da; padding: 15px; border-radius: 4px; margin: 20px 0;">
            <strong>❌ Error de conexión a la base de datos</strong><br>
            <strong>Servidor:</strong> <?php echo htmlspecialchars($cfg['Servers'][1]['host']); ?><br>
            <strong>Puerto:</strong> <?php echo $cfg['Servers'][1]['port'] ?? 3306; ?><br>
            <strong>Error:</strong> <?php echo htmlspecialchars($error_message); ?>
        </div>
        
        <div class="config-info">
            <h3>Posibles soluciones:</h3>
            <ul>
                <li>Verifica que el servidor de base de datos esté funcionando</li>
                <li>Confirma que el host y puerto sean correctos</li>
                <li>Verifica las credenciales de usuario y contraseña</li>
                <li>Asegúrate de que el firewall permita conexiones al puerto 3306</li>
            </ul>
        </div>
        <?php endif; ?>
        
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
    </div>
</body>
</html>