<?php
echo "<h2>🔍 Diagnóstico de Red</h2>";

// Cargar configuración
include 'config.inc.php';

$host = $cfg['Servers'][1]['host'];
$port = $cfg['Servers'][1]['port'] ?? 3306;

echo "<h3>Información de conexión:</h3>";
echo "<p><strong>Host:</strong> $host</p>";
echo "<p><strong>Puerto:</strong> $port</p>";

echo "<h3>Pruebas de conectividad:</h3>";

// Prueba 1: Resolución DNS
echo "<p><strong>1. Resolución DNS:</strong> ";
$ip = gethostbyname($host);
if ($ip !== $host) {
    echo "✅ OK - IP: $ip";
} else {
    echo "❌ Fallo - No se puede resolver el hostname";
}
echo "</p>";

// Prueba 2: Conectividad de puerto
echo "<p><strong>2. Conectividad de puerto:</strong> ";
$connection = @fsockopen($host, $port, $errno, $errstr, 10);
if ($connection) {
    echo "✅ OK - Puerto accesible";
    fclose($connection);
} else {
    echo "❌ Fallo - Puerto no accesible ($errno: $errstr)";
}
echo "</p>";

// Prueba 3: Extensión mysqli
echo "<p><strong>3. Extensión mysqli:</strong> ";
if (extension_loaded('mysqli')) {
    echo "✅ OK - Disponible";
} else {
    echo "❌ Fallo - No disponible";
}
echo "</p>";

// Prueba 4: Configuración PHP
echo "<h3>Configuración PHP:</h3>";
echo "<p><strong>default_socket_timeout:</strong> " . ini_get('default_socket_timeout') . " segundos</p>";
echo "<p><strong>mysqli.default_port:</strong> " . ini_get('mysqli.default_port') . "</p>";
echo "<p><strong>mysqli.default_host:</strong> " . ini_get('mysqli.default_host') . "</p>";

// Información del servidor
echo "<h3>Información del servidor:</h3>";
echo "<p><strong>IP del servidor:</strong> " . $_SERVER['SERVER_ADDR'] ?? 'No disponible' . "</p>";
echo "<p><strong>Hora del servidor:</strong> " . date('Y-m-d H:i:s T') . "</p>";
?>