<?php

require 'connexion.php';

try {
    if (isset($_POST['nom']) && isset($_POST['titre']) && isset($_POST['avi']) && isset($_POST['note'])) {
        $requete = $pdo->prepare("INSERT INTO avis (nom, titre, avi, note) VALUES (:nom, :titre, :avi, :note)");
        $requete->execute([
            'nom' => $_POST['nom'],
            'titre' => $_POST['titre'],
            'avi' => $_POST['avi'],
            'note' => $_POST['note']
        ]);

        header('Location: index.php');
    }
} catch(PDOException $e) {
    echo "Erreur lors de l'ajout de l'avi " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../../Css/style.css">
    <title>Ajout de produit</title>
</head>
<body>
    <header>
        <!--article pour diviser header en 3 parties-->
        <article class="presentation-header" class="goingDarkLigne">
            <div class="logo">
                <a href="../../index.html"><img class="logo-img" src="../../image/clapperboard.png" alt="logo" style="height: 100%;"></a>
            </div>
            <div class="nom">
                <h1>
                    Filmographie
                </h1>
            </div>
            <div class="recherche">
                <input type="text" placeholder="Recherche">
            </div><!-- Menu hamburger -->
            <ul class="menu">
                <li class="menuItem">
                    <a class="menuItem" href="../../index.html"><img class="logo-img" src="../../image/clapperboard.png" alt="logo" style="height: 100%;"></a>
                    <label for="menuItem">Page d'accueil</label>
                </li>
                <li class="menuItem">
                    <a class="menuItem" href="../../Formulaire.html"><img class="logo-img" src="../../image/connexion.png" alt="Connexion" style="height: 100%;"></a>
                    <label for="menuItem">Formulaire</label>
                </li>
                <li class="menuItem">
                    <button class="darkMode" onclick="toggleTheme()">Dark Mode</button>
                </li>
                <li class="avi">
                    <a href="index.php">
                        <button>Avis</button>
                    </a>
                </li>
            </ul>
            <button class="hamburger"> <!-- on affiche ou non le texte nécessaire --> <!-- on affiche ou non le texte nécessaire -->
                <p class="menuIcon">Menu</p>
                <p class="closeIcon">fermer</p>
            </button>
        </article>
    </header>
    <main class="CRUD">
        <!-- CRUD -->
        <h1 class="CRUD_element">Ajout d'un produit</h1>

        <form method="POST" action="create.php" class="CRUD_element">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" required>
            <br>
            <label for="titre">Titre du film</label>
            <input type="text" name="titre" required>
            <br>
            <label for="note">Note sur 10</label>
            <input type="number" name="note" max="10" required>
            <br>
            <label for="avi">Avi</label>
            <textarea name="avi" required></textarea>
            <button type="submit" class="CRUD_element">Ajouter</button>
        </form>
    </main>
    <footer class="trop_petit">
        <!--article pour diviser footer en plusieurs parties-->
        <article class="presentation-footer" class="goingDarkLigne">
            <div class="contacter">
                <p>Nous contacter : <a href="https://youtu.be/dQw4w9WgXcQ?list=RDdQw4w9WgXcQ">on a pas de lien</a></p>
            </div>
            <div class="reseaux">
                <p>Nos réseaux : <a href="https://youtu.be/dQw4w9WgXcQ?list=RDdQw4w9WgXcQ">on a toujours pas de lien</a></p>
            </div>
        </article>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script src="../../Javascript/main.js"></script>
</body>
</html>