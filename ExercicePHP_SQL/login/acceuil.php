<?php
session_start();
// var_dump($_SESSION);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Acceuil</title>
</head>
<body>
	<h1>Bienvenue dans l'Acceuil</h1>

    <form action="logout.php" method="POST">
        <label for="email">Email :</label>
        <h3><?php echo $_SESSION['email']; ?></h3>
        <br>
        <button type="submit">Se déconnecter</button>
	</form>

</body>
</html>

