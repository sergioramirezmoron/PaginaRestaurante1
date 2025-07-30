<?php include 'php/Header.php'; ?>
<main>
  <section class="contacto">
    <h1 class="contacto-title">Contacto</h1>
    <div class="contacto-content">
      <div class="contacto-formulario">
        <h2>Contacta con nosotros</h2>
        <form action="#" method="post" class="form">
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre" name="nombre" required>

          <label for="email">Correo electrónico</label>
          <input type="email" id="email" name="email" required>

          <label for="mensaje">Mensaje</label>
          <textarea id="mensaje" name="mensaje" rows="5" required></textarea>

          <button type="submit">Enviar</button>
        </form>
      </div>
    </div>
    <div class="contacto-mapa">
      <h2>¿Dónde estámos?</h2>
      <iframe
        src="https://www.openstreetmap.org/export/embed.html?bbox=-3.6645%2C37.2365%2C-3.6475%2C37.2475&amp;layer=mapnik&amp;marker=37.2420,-3.6560"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Mapa Restaurante El Olivo"
      ></iframe>
    </div>
  </section>
</main>
<?php include 'php/Footer.php'; ?>