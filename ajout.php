<?php
    if (isset($_POST['titre'], $_POST['auteur'], $_POST['annee'], $_POST['disponible'])) {
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $annee = $_POST['annee'];
        $disponible = $_POST['disponible'];

        include 'conn.php';
        $stmt = $conn->prepare("INSERT INTO livres (titre, auteur, année, disponible) VALUES (:titre, :auteur, :annee, :disponible)");
        $stmt->execute([
            ':titre' => $titre,
            ':auteur' => $auteur,
            ':annee' => $annee,
            ':disponible' => $disponible]);

        header("Location: gestion_livres.php");
        exit();
    }

?>