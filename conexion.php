<?php
// db.php - Conexión PDO
$DB_HOST = 'localhost';        // en Hostinger generalmente localhost
$DB_NAME = '';
$DB_USER = '';
$DB_PASS = '';
$DB_CHAR = 'utf8mb4';

  // Configurar la zona horaria para Colombia
  date_default_timezone_set('America/Bogota');

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$DB_CHAR";
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (PDOException $e) {
    // En producción no mostrar errores completos. Guardar en log.
    error_log("DB connection failed: " . $e->getMessage());
    die('Error de conexión a la base de datos.');
}
