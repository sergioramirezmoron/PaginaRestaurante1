<?php
include 'php/Header.php';
if (!isset($_SESSION['usuario']) || $_SESSION['es_admin'] != 1) {
  header('Location: index.php');
  exit;
}
?>

<!-- Contenedor principal con clase -->
<div class="admin-contenedor">

  <!-- Título con clase -->
  <h1 class="admin-titulo">Panel de administración</h1>

  <!-- Mensaje de bienvenida -->
  <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></p>

  <!-- Links para añadir plato y salir -->
  <nav>
    <a href="nuevo_plato.php" class="admin-link">Añadir nuevo plato</a> | 
    <a href="logout.php" class="admin-link">Salir</a>
  </nav>

</div>

<?php include 'php/Footer.php'; ?>

