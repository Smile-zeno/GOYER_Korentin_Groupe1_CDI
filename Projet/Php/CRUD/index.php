<?php

require 'connexion.php';

$sql = "SELECT * FROM avis";

if (isset($_GET['search']) && $_GET['search'] != '') {
    $search = $_GET['search'];
    $sql = $sql . " WHERE (nom LIKE '%" . $search . "%' OR titre LIKE '%" . $search . "%')";
}

$triAutorise = ['nom', 'titre'];
if (isset($_GET['tri']) && in_array($_GET['tri'], $triAutorise)) {
    $tri = $_GET['tri'];
    $sql = $sql . " ORDER BY $tri ASC";
} else {
    $tri = 'nom';
}

$requete = $pdo->prepare($sql);
$requete->execute();

$avis = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../../Css/style.css">
    <title>catalogue de produit</title>
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
        <h1 class="CRUD_element">Bienvenue sur la page des avis</h1>

        <form method="GET" action="index.php" class="CRUD_element">
            <label>Trier par : </label>
                <select name="tri" onchange="this.form.submit()">
                    <option value="nom" <?php echo $tri === 'nom' ?  'selected' : '';?>>Nom</option>
                    <option value="titre" <?php echo $tri === 'titre' ?  'selected' : '';?>>Titre</option>
                </select>

                <input type="text" name="search" placeholder="Votre recherche">
                <button type="submit">Rechercher</button>
        </form>

        <ul>
        <?php
            foreach($avis as $avi) {
                echo "<li class='CRUD_element'>";
                echo "Par : " . $avi['nom'] . ' - ' . $avi['titre'] . ' - ' . $avi['note'] . ' / 10 ' . "<br>";
                echo $avi['avi'];
                echo "<a href='delete.php?id=".$avi['id']."' onclick=\"return confirm('Supprimer cet avi ?')\"> X </a>";
                echo "<a href='update.php?id=".$avi['id']."'> Modifier </a>";
                echo "</li>";
            }
        ?>
        </ul>

        <a href="create.php" class="CRUD_element">Ajouter un nouveau avi</a>
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