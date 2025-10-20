<?php
echo "✅ PHP funciona correctamente<br>";
echo "Versión PHP: " . PHP_VERSION . "<br>";
echo "Extensión mysqli: " . (extension_loaded('mysqli') ? '✅ Disponible' : '❌ No disponible') . "<br>";
echo "Directorio actual: " . __DIR__ . "<br>";

// Verificar archivos
$files = ['config.inc.php', 'main.php', 'index.php'];
foreach ($files as $file) {
    echo "Archivo $file: " . (file_exists($file) ? '✅ Existe' : '❌ No existe') . "<br>";
}

// Probar configuración
if (file_exists('config.inc.php')) {
    include 'config.inc.php';
    echo "Configuración cargada: " . (isset($cfg) ? '✅ OK' : '❌ Error') . "<br>";
    if (isset($cfg['Servers'][1]['host'])) {
        echo "Host DB: " . $cfg['Servers'][1]['host'] . "<br>";
    }
}
?>