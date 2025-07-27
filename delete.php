<?php
    session_start();
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header("Location: gestion_livres.php?error=1");
        exit();
    }
    include 'conn.php';
    $stmt = $conn->prepare("DELETE FROM livres WHERE id_livre = :id");
    $stmt->execute([':id' => $id]);
    if ($stmt->rowCount() > 0) {
        header("Location: gestion_livres.php?success=1");
        exit();
    } else {
        header("Location: gestion_livres.php?error=1");
        exit();
    }

?>