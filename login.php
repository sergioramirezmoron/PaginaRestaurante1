<?php
session_start();
include 'php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $usuario = $_POST['usuario'];
  $pass = MD5($_POST['contrasena']);

  $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$usuario' AND contrasena = '$pass'";
  $resultado = $conn->query($sql);

  if ($resultado && $resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();
    $_SESSION['usuario'] = $fila['nombre_usuario'];
    $_SESSION['es_admin'] = $fila['es_admin'];
    header('Location: admin.php');
    exit;
  } else {
    $error = "Credenciales inválidas";
  }
}
?>

<form method="post">
  Usuario: <input type="text" name="usuario" required><br>
  Contraseña: <input type="password" name="contrasena" required><br>
  <button type="submit">Entrar</button>
</form>

<?php if (!empty($error)) echo "<p>$error</p>"; ?>
