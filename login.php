<?php
include 'php/Header.php';
//session_start();
include 'php/conexion.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];

  // Buscar usuario por nombre_usuario
  $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $usuario);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado && $resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();

    // Verificar la contraseña usando password_verify
    if (password_verify($contrasena, $fila['contrasena'])) {
      $_SESSION['usuario'] = $fila['nombre_usuario'];
      $_SESSION['es_admin'] = $fila['es_admin'];
      header('Location: admin.php');
      exit;
    } else {
      $error = "Credenciales inválidas";
    }
  } else {
    $error = "Credenciales inválidas";
  }
  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link rel="stylesheet" href="css/login.css" />
</head>
<body>

  <div class="login-contenedor">
    <form method="post" class="login-formulario">
      <label for="usuario">Usuario:</label>
      <input type="text" id="usuario" name="usuario" required>

      <label for="contrasena">Contraseña:</label>
      <input type="password" id="contrasena" name="contrasena" required>

      <button type="submit">Entrar</button>
    </form>

    <?php if (!empty($error)) : ?>
      <p class="login-error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <p class="login-register-text">
      ¿No tienes cuenta? <a href="register.php" class="login-register-link">Regístrate aquí</a>
    </p>
  </div>

</body>
</html>
