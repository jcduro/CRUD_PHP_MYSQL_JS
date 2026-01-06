
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


$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: crud.php');
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM form_neon WHERE id = :id");
    $stmt->execute([':id' => $id]);
} catch (PDOException $e) {
    die("Error al eliminar registro: " . $e->getMessage());
}

header('Location: crud.php');
exit;



