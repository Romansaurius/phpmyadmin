<?php
echo "<h2>Debug phpMyAdmin</h2>";
echo "<p><strong>Directorio actual:</strong> " . __DIR__ . "</p>";
echo "<p><strong>ROOT_PATH:</strong> " . (defined('ROOT_PATH') ? ROOT_PATH : 'No definido') . "</p>";

$files_to_check = [
    'libraries/constants.php',
    'vendor/autoload.php',
    'config.inc.php',
    'main.php'
];

echo "<h3>Verificación de archivos:</h3>";
foreach ($files_to_check as $file) {
    $full_path = __DIR__ . '/' . $file;
    $exists = file_exists($full_path);
    $readable = is_readable($full_path);
    
    echo "<p><strong>$file:</strong> ";
    echo $exists ? "✅ Existe" : "❌ No existe";
    echo " | ";
    echo $readable ? "✅ Legible" : "❌ No legible";
    echo "</p>";
}

echo "<h3>Información PHP:</h3>";
echo "<p><strong>Versión PHP:</strong> " . PHP_VERSION . "</p>";
echo "<p><strong>Extensiones:</strong> " . (extension_loaded('mysqli') ? '✅ mysqli' : '❌ mysqli') . "</p>";
?>