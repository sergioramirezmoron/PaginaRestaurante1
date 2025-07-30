<?php
include 'php/Header.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['es_admin'] != 1) {
  header('Location: login.php');
  exit;
}

include 'php/conexion.php';

$mensaje = "";
$mensaje_clase = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];
    $categoria = $_POST['categoria'];

    $sql = "INSERT INTO platos (nombre, descripcion, precio, imagen, categoria) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $nombre, $descripcion, $precio, $imagen, $categoria);

    if ($stmt->execute()) {
        $mensaje = "✅ Plato añadido correctamente.";
        $mensaje_clase = "exito";
    } else {
        $mensaje = "❌ Error al añadir el plato.";
        $mensaje_clase = "error";
    }

    $stmt->close();
    $conn->close();
}
?>

<div class="nuevo-plato-contenedor">

  <h1 class="nuevo-plato-titulo">Añadir nuevo plato</h1>

  <?php if (!empty($mensaje)) : ?>
    <p class="nuevo-plato-mensaje <?php echo $mensaje_clase; ?>"><?php echo $mensaje; ?></p>
  <?php endif; ?>

  <form method="POST" class="nuevo-plato-formulario">
    <label>Nombre:</label>
    <input type="text" name="nombre" palceholder="El nombre del plato" required>

    <label>Descripción (opcional):</label>
    <textarea name="descripcion" rows="4" palceholder="Pequeña descripción (opcional)"></textarea>

    <label>Precio (€):</label>
    <input type="number" step="0.01" name="precio" palceholder="Precio del plato" min="0.01" required>

    <label>URL de imagen (opcional):</label>
    <input type="text" name="imagen" palceholder="URL de la imagen del plato (opcional)">

    <label>Categoría:</label>
    <select name="categoria" required>
      <option value="Bocadillos">Bocadillos</option>
      <option value="Hamburguesas">Hamburguesas</option>
      <option value="Carnes">Carnes</option>
      <option value="Pescados">Pescados</option>
      <option value="Ensaladas">Ensaladas</option>
      <option value="Postres">Postres</option>
      <option value="Bebidas">Bebidas</option>
    </select>

    <button type="submit">Añadir plato</button>
  </form>

</div>

<?php include 'php/Footer.php'; ?>
