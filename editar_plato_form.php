<?php
include 'php/Header.php';
include 'php/conexion.php';

// Verificar admin
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("No se especificó el plato");
}

$id = intval($_GET['id']);
$error = "";
$exito = "";

// Si llega POST, procesar actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = floatval($_POST['precio']);

    // Validar campos básicos
    if (empty($nombre) ||  $precio <= 0) {
        $error = "Por favor, complete todos los campos correctamente.";
    } else {
        $sql = "UPDATE platos SET nombre = ?, descripcion = ?, precio = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id);
        if ($stmt->execute()) {
            $exito = "Plato actualizado correctamente.";
        } else {
            $error = "Error al actualizar el plato.";
        }
        $stmt->close();
    }
}

// Obtener datos actuales para mostrar en el formulario
$sql = "SELECT * FROM platos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Plato no encontrado.");
}

$plato = $result->fetch_assoc();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Editar Plato</title>
  <link rel="stylesheet" href="css/editar_plato_form.css" />
</head>
<body>
  <main class="editar-plato-container">
    <h1 class="titulo">Editar Plato: <?php echo htmlspecialchars($plato['nombre']); ?></h1>

    <?php if ($error): ?>
      <p class="mensaje error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if ($exito): ?>
      <p class="mensaje exito"><?php echo htmlspecialchars($exito); ?></p>
    <?php endif; ?>

    <form method="post" class="formulario-editar">
      <label for="nombre" class="label">Nombre:</label>
      <input
        type="text"
        id="nombre"
        name="nombre"
        class="input-text"
        value="<?php echo htmlspecialchars($plato['nombre']); ?>"
        required
      />

      <label for="descripcion" class="label">Descripción:</label>
      <textarea
        id="descripcion"
        name="descripcion"
        class="textarea"
      ><?php echo htmlspecialchars($plato['descripcion']); ?></textarea>

      <label for="precio" class="label">Precio (€):</label>
      <input
        type="number"
        step="0.01"
        id="precio"
        name="precio"
        class="input-text"
        value="<?php echo $plato['precio']; ?>"
        required
      />

      <button type="submit" class="btn-actualizar">Actualizar Plato</button>
    </form>

    <p class="volver-lista"><a href="editar_platos.php">← Volver a la lista</a></p>
  </main>
</body>
</html>

<?php
$conn->close();
?>
<?php include 'php/Footer.php'; ?>
