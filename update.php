<?php
    session_start();

    if (isset($_POST['titre'], $_POST['auteur'], $_POST['annee'], $_POST['disponible'])) {
        $id = $_SESSION['idupdate'];
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $annee = $_POST['annee'];
        $disponible = $_POST['disponible'] ? 1 : 0;

        include 'conn.php';
        $stmt = $conn->prepare("UPDATE livres SET titre = :titre, auteur = :auteur, année = :annee, disponible = :disponible WHERE id_livre = :id");
        $stmt->execute([
            ':id' => $id,
            ':titre' => $titre,
            ':auteur' => $auteur,
            ':annee' => $annee,
            ':disponible' => $disponible
        ]);
        if ($stmt->rowCount() > 0) {
            header("Location: gestion_livres.php?success=1");
            exit();
        } else {
            header("Location: modifier.php?id=$id&error=1");
            exit();
        }
        unset($_SESSION['idupdate']);
    
    }


?>