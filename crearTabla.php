<?php
if (isset($_POST['crear_tabla'])) {

    $host = "cfls9h51f4i86c.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com";
    $port = "5432";
    $dbname = "d53o7ipa6fmj6s";
    $user = "u9piua758j8vs1";
    $password = "pef633ca3bffe7d2a7c483ad1e76412830748ce6321d1fe2288a53a890ab07ce8";

    try {

        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE IF NOT EXISTS Peliculas (
                    ID SERIAL PRIMARY KEY,
                    Nombre TEXT NOT NULL,
                    Genero TEXT NOT NULL
                )";

        $pdo->exec($sql);

        echo 'Tabla "Peliculas" creada exitosamente.';
    } catch (PDOException $e) {
        echo 'Error al crear la tabla: ' . $e->getMessage();
    }
}
?>
