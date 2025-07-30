<?php
include 'php/Header.php';
include 'php/conexion.php';

// Solo admin puede acceder
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    header("Location: login.php");
    exit();
}

// Procesar eliminación si llega id_eliminar por GET
if (isset($_GET['id_eliminar'])) {
    $idEliminar = intval($_GET['id_eliminar']);
    $sqlEliminar = "DELETE FROM platos WHERE id = ?";
    $stmtEliminar = $conn->prepare($sqlEliminar);
    $stmtEliminar->bind_param("i", $idEliminar);
    $stmtEliminar->execute();
    $stmtEliminar->close();
    // Redirigir para evitar resubmisión
    header("Location: editar_platos.php");
    exit();
}

// Obtener todos los platos
$sql = "SELECT * FROM platos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Editar Platos</title>
  <link rel="stylesheet" href="css/editar_platos.css" />
</head>
<body>
  <div class="menu">
    <h1 class="menu-title">Lista de Platos</h1>
    <table class="editar-platos-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while($plato = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $plato['id']; ?></td>
          <td><span class="nombre"><?php echo htmlspecialchars($plato['nombre']); ?></span></td>
          <td><?php echo htmlspecialchars($plato['descripcion']); ?></td>
          <td><span class="precio"><?php echo $plato['precio']; ?> €</span></td>
          <td>
            <a href="editar_plato_form.php?id=<?php echo $plato['id']; ?>" class="editar-link">Editar</a>
            <a href="editar_platos.php?id_eliminar=<?php echo $plato['id']; ?>" 
               class="eliminar-link"
               onclick="return confirm('¿Estás seguro de eliminar este plato?');"
            >Eliminar</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>

<?php
$conn->close();
?>
<?php include 'php/Footer.php'; ?>
