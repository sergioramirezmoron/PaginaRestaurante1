<?php include 'php/Header.php'; ?>
<main>
  <section class="menu">
    <h1 class="menu-title">Menú Restaurante El Olivo</h1>
    <?php
      include 'php/conexion.php';

      $categorias = ['Bocadillos', 'Hamburguesas', 'Carnes', 'Pescados', 'Ensaladas', 'Postres', 'Bebidas'];

      foreach ($categorias as $categoria) {
          echo '<div class="menu-category">';
          echo '<h2>' . $categoria . '</h2>';
          echo '<ul>';

          $consulta = "SELECT nombre, descripcion, precio, imagen FROM platos WHERE categoria = '$categoria'";
          $resultado = $conn->query($consulta);

          if ($resultado && $resultado->num_rows > 0) {
              while ($plato = $resultado->fetch_assoc()) {
                  echo '<li>';
                  echo '<span class="nombre-plato">' . $plato['nombre'] . '</span>';
                  if (!empty($plato['descripcion'])) {
                      echo '<p class="descripcion-plato">' . $plato['descripcion'] . '</p>';
                  }
                  echo '<span class="precio">' . number_format($plato['precio'], 2) . ' €</span>';
                  if (!empty($plato['imagen'])) {
                      echo '<br><img src="' . $plato['imagen'] . '" alt="' . $plato['nombre'] . '" style="max-width:150px;">';
                  }
                  echo '</li>';
              }
          } else {
              echo '<li>No hay platos en esta categoría.</li>';
          }

          echo '</ul>';
          echo '</div>';
      }

      $conn->close();
    ?>
  </section>
</main>
<?php include 'php/Footer.php'; ?>
