<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['es_admin'] != 1) {
  header('Location: login.php');
  exit;
}

include 'php/conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen']; // puede ser una URL por ahora
    $categoria = $_POST['categoria'];

    $sql = "INSERT INTO platos (nombre, descripcion, precio, imagen, categoria) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $nombre, $descripcion, $precio, $imagen, $categoria);

    if ($stmt->execute()) {
        $mensaje = "✅ Plato añadido correctamente.";
    } else {
        $mensaje = "❌ Error al añadir el plato.";
    }

    $stmt->close();
    $conn->close();
}
?>

<h1>Añadir nuevo plato</h1>

<?php if (!empty($mensaje)) echo "<p>$mensaje</p>"; ?>

<form method="POST">
  <label>Nombre:</label><br>
  <input type="text" name="nombre" required><br><br>

  <label>Descripción:</label><br>
  <textarea name="descripcion" rows="4"></textarea><br><br>

  <label>Precio (€):</label><br>
  <input type="number" step="0.01" name="precio" required><br><br>

  <label>URL de imagen:</label><br>
  <input type="text" name="imagen"><br><br>

  <label>Categoría:</label><br>
  <select name="categoria" required>
    <option value="Bocadillos">Bocadillos</option>
    <option value="Hamburguesas">Hamburguesas</option>
    <option value="Carnes">Carnes</option>
    <option value="Pescados">Pescados</option>
    <option value="Ensaladas">Ensaladas</option>
    <option value="Postres">Postres</option>
    <option value="Bebidas">Bebidas</option>
  </select><br><br>

  <button type="submit">Añadir plato</button>
</form>
