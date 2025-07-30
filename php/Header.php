<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Restaurante El Olivo: Cocina mediterránea tradicional con ingredientes frescos y ambiente acogedor."
    />
    <link rel="stylesheet" href="styles/variables.css" />
    <link rel="stylesheet" href="styles/header.css" />
    <link rel="stylesheet" href="styles/footer.css" />
    <link rel="stylesheet" href="styles/index.css" />
    <link rel="stylesheet" href="styles/menu.css" />
    <link rel="stylesheet" href="styles/contacto.css" />
    <link rel="stylesheet" href="styles/admin.css" />
    <link rel="stylesheet" href="styles/nuevo_plato.css" />
    <link rel="stylesheet" href="styles/register.css" />
    <link rel="stylesheet" href="styles/login.css" />
    <link rel="icon" type="image/png" href="images/favicon.png" />
    <title>Restaurante El Olivo</title>
  </head>
  <body>
    <!-- Encabezado -->
    <header>
      <div class="container">
        <div class="starter">
          <h1>Restaurante El Olivo</h1>
          <p class="bienvenida-sesion">
            <?php if (isset($_SESSION['usuario'])): ?>
              Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>.
            <?php else: ?>
              No ha iniciado sesión.
            <?php endif; ?>
          </p>
          <p>
            Disfruta del sabor auténtico en El Olivo, donde la tradición y la
            cocina mediterránea se encuentran en cada plato.
          </p>
        </div>
        <div></div>
        <nav class="enlaces" aria-label="Navegación principal">
          <a href="index.php" class="enlace<?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo ' active'; ?>">Info</a>
          <a href="menu.php" class="enlace<?php if(basename($_SERVER['PHP_SELF']) == 'menu.php') echo ' active'; ?>">Menú</a>
          <a href="contacto.php" class="enlace<?php if(basename($_SERVER['PHP_SELF']) == 'contacto.php') echo ' active'; ?>">Contacto</a>
          <a href="login.php" class="enlace<?php if(basename($_SERVER['PHP_SELF']) == 'login.php') echo ' active'; ?>">Iniciar Sesión</a>
        </nav>
      </div>
    </header>
