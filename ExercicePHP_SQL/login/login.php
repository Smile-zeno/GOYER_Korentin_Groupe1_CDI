<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
</head>
<body>
	<h1>Bienvenue sur la page de connexion</h1>

    <form action="login.php" method="POST">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Se connecter</button>
	</form>

    <form action="create.php" method="POST">
        <br>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">S'inscrire</button>
	</form>

</body>
</html>

<?php

try {

    $pdo = new PDO('mysql:host=localhost;dbname=exercice_login', 'root', '');
    
    // Nettoyer les chaines de caractères
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        // Valider l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email invalide";
            exit;
        }

        $stmt = $pdo->prepare("SELECT id, email, password FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            echo "Connesion réussie !";

            // Session :
            session_start();
            $_SESSION['utilisateur_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Redirection vers la page d'acceuil
            header('Location: acceuil.php');
        } else {
            echo "Email ou mot de passe incorrect"; 
        }
    }

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

?>