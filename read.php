<?php
// Incluir tu conexión PDO
require_once __DIR__ . '/conexion.php'; // AJUSTA ESTA RUTA

?>

<?php

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: crud.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM form_neon WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    if (!$row) {
        die("Registro no encontrado.");
    }
} catch (PDOException $e) {
    die("Error al obtener registro: " . $e->getMessage());
}
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle registro - Form Neon</title>
    <style>
        body { background:#050816; color:#f8f9ff; font-family:Arial, Helvetica, sans-serif; }
        .container-neon {
            max-width: 600px; margin:40px auto; padding:20px 25px;
            background:#0b1020; border-radius:10px;
            box-shadow:0 0 25px rgba(0,255,255,0.25);
            border:1px solid rgba(0,255,255,0.4);
        }
        h1 { text-align:center; color:#00e5ff; text-shadow:0 0 10px #00e5ff; margin-bottom:20px; }
        .field { margin-bottom:10px; }
        .label { font-weight:bold; color:#00e5ff; }
        .btn-secondary-neon {
            background:transparent; color:#00e5ff;
            border:1px solid #00e5ff; border-radius:4px;
            padding:8px 14px; text-decoration:none;
        }
        .btn-secondary-neon:hover { background:rgba(0,229,255,0.1); }
    </style>
</head>
<body>
<div class="container-neon">
    <h1>Detalle del registro</h1>

    <div class="field"><span class="label">ID:</span> <?= htmlspecialchars($row['id']) ?></div>
    <div class="field"><span class="label">Nombre:</span> <?= htmlspecialchars($row['nombre']) ?></div>
    <div class="field"><span class="label">Correo:</span> <?= htmlspecialchars($row['correo']) ?></div>
    <div class="field"><span class="label">Teléfono:</span> <?= htmlspecialchars($row['telefono']) ?></div>
    <div class="field"><span class="label">País:</span> <?= htmlspecialchars($row['pais']) ?></div>
    <div class="field"><span class="label">Ciudad:</span> <?= htmlspecialchars($row['ciudad']) ?></div>
    <div class="field"><span class="label">Fecha registro:</span> <?= htmlspecialchars($row['fecha_registro']) ?></div>

    <a href="crud.php" class="btn-action btn-view">Volver</a>
</div>

</div>

