<?php

require 'connexion.php';

$sql = "SELECT * FROM produits";

if (isset($_GET['search']) && $_GET['search'] != '') {
    $search = $_GET['search'];
    $sql = $sql . " WHERE (nom LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%')";
}

// $tri = isset($_GET['tri']) ? isset($_GET['tri']) : 'nom';
$triAutorise = ['nom', 'prix'];
if (isset($_GET['tri']) && in_array($_GET['tri'], $triAutorise)) {
    $tri = $_GET['tri'];
    $sql = $sql . " ORDER BY $tri ASC";
} else {
    $tri = 'nom';
}

$requete = $pdo->prepare($sql);
$requete->execute();

$produits = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>catalogue de produit</title>
</head>
<body>
    <h1>Bienvenue sur notre catalogue</h1>
    <h2>Nos produits :</h2>

    <form method="GET" action="index.php">
        <label>Trier par : </label>
            <select name="tri" onchange="this.form.submit()">
                <option value="nom" <?php echo $tri === 'nom' ?  'selected' : '';?>>Nom</option>
                <option value="prix" <?php echo $tri === 'prix' ?  'selected' : '';?>>Prix</option>
            </select>

            <input type="text" name="search" placeholder="Votre recherche">
            <button type="submit">Rechercher</button>
    </form>

    <ul>
    <?php
        foreach($produits as $produit) {
            echo "<li>";
            echo $produit['nom'] . ' - ' . $produit['prix'] . ' € / Stock : ' . $produit['stock'] . "<br>";
            echo $produit['description'];
            echo "<a href='delete.php?id=".$produit['id']."' onclick=\"return confirm('Supprimer ce produit ?')\"> X </a>";
            echo "<a href='update.php?id=".$produit['id']."'> Modifier </a>";
            echo "</li>";
        }
    ?>
    </ul>

    <a href="create.php">Ajouter un nouveau produit</a>
    
</body>
</html>