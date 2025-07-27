<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    include 'conn.php';
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email =:email AND password =:password");
    $confirm = $stmt->execute([':email' => $email, ':password' => $password]);

    if ($confirm && $stmt->rowCount() > 0) {
        session_start();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['user'] = [
                "id" => $row['id_user'],
                "nom" => $row['nom'],
                "email" => $row['email'],
                "role" => $row['role']
            ];
        }

        if ($_SESSION['user']['role'] == 'admin') {
            header("Location: gestion_livres.php");
            exit();

        } else if ($_SESSION['user']['role'] == 'user'){
            header("Location: livres.php");
            exit();
        }
    } else {
        header("Location: login.php?error=1");
        exit(); 
    }
}

?>