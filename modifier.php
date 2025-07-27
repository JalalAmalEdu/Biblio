<?php
    session_start();
    if(!isset($_SESSION)){
        echo "<h1>Accès interdit</h1>";
        header("Location: gestion_livres.php");
        exit();
    }
?>

<?php 
    $id = $_GET['id'];
    $_SESSION['idupdate'] = $id;
    include 'conn.php';
    $stmt = $conn->prepare("SELECT * FROM livres WHERE id_livre = :id");
    $stmt->execute(['id' => $id]);
    $livre = $stmt->fetch(PDO::FETCH_OBJ);

    
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier le Livre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container my-5">
        <div class="text-center mb-4">
            <h2 class="text-primary">Modifier le Livre</h2>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <form action="update.php" method="POST">


                    <div class="mb-3">
                        <label for="titre" class="form-label">ID</label>
                        <div class="form-control bg-light">
                            <?= htmlspecialchars($_GET['id']) ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?= $livre->titre ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="auteur" class="form-label">Auteur</label>
                        <input type="text" class="form-control" id="auteur" name="auteur" value="<?= $livre->auteur ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="annee" class="form-label">Année</label>
                        <input type="number" class="form-control" id="annee" name="annee" value="<?= $livre->année ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="disponible" class="form-label">Disponible</label>
                        <select class="form-select" id="disponible" name="disponible">
                            <option value="1" <?= $livre->disponible ? "selected": ""?> >Oui</option>
                            <option value="0" <?= $livre->disponible ? "": "selected"?> >Non</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>