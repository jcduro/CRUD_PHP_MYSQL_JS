
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
    <title>Crud</title>

</head>
<body>

<?php


try {
    $stmt = $pdo->query("SELECT id, nombre, correo, telefono, pais, ciudad, fecha_registro FROM form_neon ORDER BY id DESC");
    $registros = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al obtener registros: " . $e->getMessage());
}
?>




<div class="super-container">
    <div class="top-bar">
        <h1>CRUD Form Neon</h1>
        <a href="create.php" class="btn-neon">+ Nuevo registro</a>
    </div>

<br>

  <div class="tabla-cont">
    <table class="neon-table">
      <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>País</th>
            <th>Ciudad</th>
            <th>Fecha registro</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($registros): ?>
            <?php foreach ($registros as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['correo']) ?></td>
                    <td><?= htmlspecialchars($row['telefono']) ?></td>
                    <td><?= htmlspecialchars($row['pais']) ?></td>
                    <td><?= htmlspecialchars($row['ciudad']) ?></td>
                    <td><?= htmlspecialchars($row['fecha_registro']) ?></td>
                    <td><a href="read.php?id=<?= $row['id'] ?>" class="btn-action btn-view">Ver</a></td>
                    <td><a href="update.php?id=<?= $row['id'] ?>" class="btn-action btn-edit">Editar</a></td>
                    <td> <button type="button"
                                class="btn-action btn-delete"
                                onclick="openDeleteModal(<?= (int)$row['id'] ?>)">
                            Eliminar
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No hay registros en la tabla.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<td>
    
   
   
</td>


<!-- Modal de confirmación -->
<div id="delete-modal" class="modal-overlay" style="display:none;">
    <div class="modal-neon">
        <h2>¿Eliminar registro?</h2>
        <p>Esta acción no se puede deshacer. ¿Seguro que deseas continuar?</p>
        <div class="modal-actions">
            <button type="button" class="btn-action btn-edit" onclick="closeDeleteModal()">Cancelar</button>
            <a id="delete-confirm-link" href="#" class="btn-action btn-delete">Sí, eliminar</a>
        </div>
    </div>
</div>

<!-- Modal de confirmación -->
<div id="delete-modal" class="modal-overlay" style="display:none;">
    <div class="modal-neon">
        <h2>¿Eliminar registro?</h2>
        <p>Esta acción no se puede deshacer. ¿Seguro que deseas continuar?</p>
        <div class="modal-actions">
            <button type="button" class="btn-action btn-edit" onclick="closeDeleteModal()">Cancelar</button>
            <a id="delete-confirm-link" href="#" class="btn-action btn-delete">Sí, eliminar</a>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(id) {
        const modal = document.getElementById('delete-modal');
        const link  = document.getElementById('delete-confirm-link');
        link.href   = 'delete.php?id=' + encodeURIComponent(id);
        modal.style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').style.display = 'none';
    }

    // Cerrar al hacer click fuera del cuadro
    document.addEventListener('click', function (e) {
        const modal = document.getElementById('delete-modal');
        if (!modal || modal.style.display !== 'flex') return;
        if (e.target === modal) {
            closeDeleteModal();
        }
    });
</script>



