
 <!-- Welcome to
  
     |  ___|  __ \  |   |  _ \   _ \   
     | |      |   | |   | |   | |   |  
 \   | |      |   | |   | __ <  |   |  
\___/ \____| ____/ \___/ _| \_\\___/   
                                       
  ___|  _ \  __ \  ____|    _ )   _ _| __ \  ____|    \     ___|  
 |     |   | |   | __|     _ \ \   |  |   | __|     _ \  \___ \  
 |     |   | |   | |      ( `  <   |  |   | |      ___ \       | 
\____|\___/ ____/ _____| \___/\/ ___|____/ _____|_/    _\_____/  

  https://jcduro.bexartideas.com/index.php | 2026 | JC Duro Code & Ideas

------------------------------------------------------------------------------- -->



<?php
// Incluir tu conexión PDO
require_once __DIR__ . '/conexion.php'; // AJUSTA ESTA RUTA

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Font Awesome para iconos (si no lo tienes ya en el layout) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <!-- Font Awesome para iconos (si no lo tienes ya en el layout) -->
  <link rel="stylesheet" href="css/crud.css"/>


</head>
<body>

  
<?php

$errores = [];
$nombre = $correo = $telefono = $pais = $ciudad = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = trim($_POST['nombre'] ?? '');
    $correo   = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $pais     = trim($_POST['pais'] ?? '');
    $ciudad   = trim($_POST['ciudad'] ?? '');

    if ($nombre === '')   $errores[] = 'El nombre es obligatorio.';
    if ($correo === '')   $errores[] = 'El correo es obligatorio.';
    if ($telefono === '') $errores[] = 'El teléfono es obligatorio.';
    if ($pais === '')     $errores[] = 'El país es obligatorio.';
    if ($ciudad === '')   $errores[] = 'La ciudad es obligatoria.';

    if (!$errores) {
        try {
            $sql = "INSERT INTO form_neon (nombre, correo, telefono, pais, ciudad) 
                    VALUES (:nombre, :correo, :telefono, :pais, :ciudad)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre'   => $nombre,
                ':correo'   => $correo,
                ':telefono' => $telefono,
                ':pais'     => $pais,
                ':ciudad'   => $ciudad,
            ]);
            header('Location: crud.php');
            exit;
        } catch (PDOException $e) {
            $errores[] = "Error al guardar: " . $e->getMessage();
        }
    }
}
?>



<div class="crud-form-wrapper">
<div class="super-container">
    <h1>Nuevo registro</h1>

    <?php if ($errores): ?>
        <div class="errores">
            <ul>
                <?php foreach ($errores as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>


 

    <form class="crud-form" action="" method="post">

        <div class="neon-form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($nombre) ?>">
        
        <label for="correo">Correo</label>
        <input type="email" name="correo" id="correo" value="<?= htmlspecialchars($correo) ?>">

     
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" value="<?= htmlspecialchars($telefono) ?>">

        <label for="pais">País</label>
        <input type="text" name="pais" id="pais" value="<?= htmlspecialchars($pais) ?>">

        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad" value="<?= htmlspecialchars($ciudad) ?>">
       

        <button type="submit" class="btn-neon">Guardar</button>
        <br><br>
        <a href="crud.php" class="btn-action btn-view">Volver</a>
    </form>
    </div>
</div>





