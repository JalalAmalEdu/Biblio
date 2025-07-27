<?php

$dsn = "mysql:host=localhost;dbname=biblio";

$user = "root";

$pass = "";
try {
    $conn = new PDO($dsn, $user, $pass);
    //echo "Connexion réussie";
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
