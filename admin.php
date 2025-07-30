<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['es_admin'] != 1) {
  header('Location: login.php');
  exit;
}
include 'php/Header.php';
?>

<h1>Panel de administración</h1>
<p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></p>
<a href="nuevo_plato.php">Añadir nuevo plato</a>
<a href="logout.php">Salir</a>

<?php include 'php/Footer.php'; ?>
