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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* exact same styles from gestion_livres.php */
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            margin: 2rem auto;
            padding: 2rem;
            max-width: 800px;
        }

        .section-title {
            background: var(--secondary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            border: none;
            overflow: hidden;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: var(--hover-shadow);
            transform: translateY(-2px);
        }

        .form-card .card-header {
            background: var(--success-gradient);
            color: white;
            border: none;
            padding: 1.5rem;
        }

        .form-card .card-header h5 {
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-save {
            background: var(--success-gradient);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-container fade-in">
            <h2 class="section-title">
                <i class="bi bi-pencil-fill me-2"></i>
                Modifier le Livre
            </h2>

            <div class="form-card">
                <div class="card-header">
                    <h5>
                        <i class="bi bi-info-circle-fill"></i>
                        Informations actuelles
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="update.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-hash me-1"></i>
                                ID
                            </label>
                            <div class="form-control bg-light"><?= htmlspecialchars($_GET['id']) ?></div>
                        </div>

                        <div class="mb-3">
                            <label for="titre" class="form-label">
                                <i class="bi bi-bookmark-fill me-1"></i>
                                Titre
                            </label>
                            <input type="text" class="form-control" id="titre" name="titre" value="<?= htmlspecialchars($livre->titre) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="auteur" class="form-label">
                                <i class="bi bi-person-fill me-1"></i>
                                Auteur
                            </label>
                            <input type="text" class="form-control" id="auteur" name="auteur" value="<?= htmlspecialchars($livre->auteur) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="annee" class="form-label">
                                <i class="bi bi-calendar-fill me-1"></i>
                                Année
                            </label>
                            <input type="number" class="form-control" id="annee" name="annee" value="<?= htmlspecialchars($livre->année) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="disponible" class="form-label">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                Disponible
                            </label>
                            <select class="form-select" id="disponible" name="disponible">
                                <option value="1" <?= $livre->disponible ? "selected" : "" ?>>Oui</option>
                                <option value="0" <?= !$livre->disponible ? "selected" : "" ?>>Non</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-save w-100">
                            <i class="bi bi-save me-2"></i>
                            Enregistrer les modifications
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
