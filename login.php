<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
    if (isset($_GET['error']) && $_GET['error'] == '1') {
        echo '<script>alert("Erreur ");</script>';
    }

    session_start();
    if(isset($_SESSION["user"])){
        if ($_SESSION["user"]["role"]=="user"){
            header("Location:livres.php");
        }else if ($_SESSION["user"]["role"]=="admin"){
            header("Location:gestion_livres.php");
        }
    }


?>


<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Authentification</h3>
            <form action="verif.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" require placeholder="exemple@domaine.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="********">
                </div>
                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>
        </div>
    </div>

</body>

</html>