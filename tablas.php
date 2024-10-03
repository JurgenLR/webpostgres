<?php

$host = "cfls9h51f4i86c.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com";
$port = "5432";
$dbname = "d53o7ipa6fmj6s";
$user = "u9piua758j8vs1";
$password = "pef633ca3bffe7d2a7c483ad1e76412830748ce6321d1fe2288a53a890ab07ce8";

try {

    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema='public'";
    $stmt = $pdo->query($sql);
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        echo "<h2>Tabla: $table</h2>";
        echo "<ul>";
        $sql = "SELECT column_name FROM information_schema.columns WHERE table_name='$table'";
        $stmt = $pdo->query($sql);
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($columns as $column) {
            echo "<li>$column</li>";
        }
        echo "</ul>";
    }
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
?>