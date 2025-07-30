<?php
include 'php/Header.php';
session_start();
include 'php/conexion.php';

$mensaje = "";
$mensaje_clase = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password !== $password_confirm) {
        $mensaje = "❌ Las contraseñas no coinciden.";
        $mensaje_clase = "error";
    } elseif (strlen($password) < 6) {
        $mensaje = "❌ La contraseña debe tener al menos 6 caracteres.";
        $mensaje_clase = "error";
    } else {
        // Comprobar si usuario existe
        $sql_check = "SELECT id FROM usuarios WHERE nombre_usuario = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $usuario);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $mensaje = "❌ El nombre de usuario ya está en uso.";
            $mensaje_clase = "error";
        } else {
            // Hashear la contraseña
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insertar usuario (con campo correcto)
            $sql_insert = "INSERT INTO usuarios (nombre_usuario, contrasena) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ss", $usuario, $password_hash);

            if ($stmt_insert->execute()) {
                $mensaje = "✅ Usuario registrado correctamente. Ahora puedes iniciar sesión.";
                $mensaje_clase = "exito";
            } else {
                $mensaje = "❌ Error al registrar usuario.";
                $mensaje_clase = "error";
            }
            $stmt_insert->close();
        }
        $stmt_check->close();
    }
    $conn->close();
}
?>

<div class="registro-contenedor">
  <h1 class="registro-titulo">Registro de usuario</h1>

  <?php if (!empty($mensaje)) : ?>
    <p class="registro-mensaje <?php echo $mensaje_clase; ?>"><?php echo $mensaje; ?></p>
  <?php endif; ?>

  <form method="POST" class="registro-formulario">
    <label>Usuario:</label>
    <input type="text" name="usuario" required>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <label>Confirmar contraseña:</label>
    <input type="password" name="password_confirm" required>

    <button type="submit">Registrarse</button>
  </form>
   <p class="login-register-text">
      ¿Ya tienes una cuenta? <a href="login.php" class="login-register-link">Inicia Sesión</a>
    </p>
</div>

<?php include 'php/Footer.php'; ?>
