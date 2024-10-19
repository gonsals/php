<?php
// Definir la URL de la API
const API_URL = "https://www.whenisthenextmcufilm.com/api";

// Inicializar cURL para hacer la petición
$ch = curl_init(API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud y decodificar el JSON
$result = curl_exec($ch);
$data = json_decode($result, true);

// Cerrar la conexión cURL
curl_close($ch);

// Verificar si los datos fueron recibidos correctamente
if ($data === null) {
  $error_message = "Error al obtener la información de la película.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Descubre cuál es la próxima película de Marvel y cuándo se estrenará.">
  <title>Próxima Película de Marvel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>

<body>

  <main class="container">
    <section class="card">
      <h2>Próxima Película de Marvel</h2>

      <?php if (isset($error_message)): ?>
        <p><?= $error_message; ?></p>
      <?php else: ?>
        <article>
          <h3 class=" title"><?= htmlspecialchars($data['title']); ?></h3>

          <div class="grid">
            <div class=" img-container">
              <img src="<?= htmlspecialchars($data['poster_url']); ?>" width="300" alt="poster" class="rounded">
            </div>

            <div class="text-container">
              <h5>Se estrenará en <strong><?= htmlspecialchars($data['days_until']); ?></strong> días</h5>
              <h6>Fecha de estreno: <?= htmlspecialchars($data['release_date']); ?></h6>
              <p>
                Después de esta película, la siguiente será:
                <a href="next.php" role="button" class="outline"><?= htmlspecialchars($data['following_production']['title']); ?></a>
              </p>
            </div>
          </div>
        </article>
      <?php endif; ?>

    </section>
  </main>

</body>

</html>

<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
  }

  @media (max-width: 768px) {
    .img-container {
      display: flex;
      justify-content: center;

      img {
        width: 150px;
      }
    }

    .title {
      text-align: center;
    }

    .text-container {
      text-align: center;
    }
  }
</style>