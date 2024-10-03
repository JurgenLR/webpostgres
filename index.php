<?php
$host = "cfls9h51f4i86c.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com";
$port = "5432";
$dbname = "d53o7ipa6fmj6s";
$user = "u9piua758j8vs1";
$password = "pef633ca3bffe7d2a7c483ad1e76412830748ce6321d1fe2288a53a890ab07ce8";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['agregar_pelicula'])) {
        $nombre = $_POST['nombre'];
        $genero = $_POST['genero'];

        echo ($nombre . " - ". $genero);

        $sql = "INSERT INTO Peliculas (Nombre, Genero) VALUES (:nombre, :genero)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nombre' => $nombre, 'genero' => $genero]);

        echo "Pelicula '$nombre' añadida con éxito.";
    }

    $sql = "SELECT * FROM peliculas";
    $stmt = $pdo->query($sql);
    $peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
?>
<!-- ======================================================================================================================= -->
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body class="bg-dark">
  <div class="py-5 text-center">
    <div class="container">
      <div class="row">
        <div class="mx-auto col-lg-8">
          <h1 class="text-light">Base de Datos de Peliculas</h1>
          <p class="mb-4 text-light">Ingresa el Nombre y Genero de una pelicula para hacer uso de este Software</p>
          <form class="form-inline d-flex justify-content-around" action="index.php" method="post">
            <div class="form-group"> <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Pelicula" autocomplete="off" required> </div>
            <div class="form-group"> <input type="text" class="form-control" id="genero" name="genero" placeholder="Genero" autocomplete="off" required> </div> 
            <button type="submit" name="agregar_pelicula" class="btn btn-success">Insertar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            

            <table class="table table-striped table-dark">

              <thead>
                <tr>
                  <th scope="col">Pelicula</th>
                  <th scope="col">Genero</th>
                </tr>
              </thead>
              <tbody>
              <?php if (!empty($peliculas)): ?>
                <form action="limpiarTabla.php" method="post">
                    <button type="submit" name="eliminar_todas" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar todas las películas?');">Eliminar Registros</button>
                    <p>
                </form>
                <?php foreach ($peliculas as $pelicula): ?>
                    <?php if (isset($pelicula['nombre']) && isset($pelicula['genero'])): ?>
                
                <tr>
                  <td><?php echo htmlspecialchars($pelicula['nombre']) ; ?></td>
                  <td><?php echo  htmlspecialchars($pelicula['genero']); ?></td>
                </tr>
                <?php else: ?>
                        <li>Error en los datos de la película.</li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-light">No hay películas registradas.</p>
            <?php endif; ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
