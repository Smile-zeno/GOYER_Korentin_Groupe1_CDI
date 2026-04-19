<!DOCTYPE html>
<html>
<head>
    <title>Création de compte</title>
</head>
<body>
    <form action="login.php">
        <button type="submit">Retourner à la page de connection</button>
    </form>
</body>
</html>

<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=exercice_login', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Erreur lors de la connexion à la BDD : " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $requete = $pdo->prepare("INSERT INTO utilisateurs (email, password) VALUES (:email, :password)");
        $requete->execute([
            'email' => $email,
            'password' => $hashedPassword
        ]);

        echo 'Inscription réussie';
    }else {
        echo 'Veuillez renseigner tous les champs';
    }
}

?>
