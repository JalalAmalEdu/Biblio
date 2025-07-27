<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des Livres</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="bg-light d-flex flex-column min-vh-100">

    <div class="container my-5 flex-grow-1">
        <div class="mb-4 text-center">
            <h2 class="text-primary">Bonjour <span class="fw-bold text-dark">
                <?= $_SESSION['user']['nom'] ?>
            </span></h2>
        </div>

        <div class="card shadow mb-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Liste des Livres</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Année</th>
                            <th>Disponible</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'conn.php';
                        $stmt = $conn->prepare("SELECT * FROM livres");
                        $stmt->execute();
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($row['titre']) ?></td>
                                <td><?= htmlspecialchars($row['auteur']) ?></td>
                                <td><?= htmlspecialchars($row['année']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $row['disponible'] ? 'success' : 'danger' ?>">
                                        <?= $row['disponible'] ? 'Oui' : 'Non' ?>
                                    </span>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="text-center mt-auto">
        <a href="logout.php" class="btn btn-outline-danger px-4">Déconnexion</a>
    </div>

</body>


</html>