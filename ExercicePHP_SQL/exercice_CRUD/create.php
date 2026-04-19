<?php

require 'connexion.php';

try {
    if (isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['stock'])) {
        $requete = $pdo->prepare("INSERT INTO produits (nom, description, prix, stock) VALUES (:nom, :description, :prix, :stock)");
        $requete->execute([
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'prix' => $_POST['prix'],
            'stock' => $_POST['stock']
        ]);

        header('Location: index.php');
    }
} catch(PDOException $e) {
    echo "Erreur lors de l'ajout du produit " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajout de produit</title>
</head>
<body>
    <h1>Ajout d'un produit</h1>

    <form method="POST" action="create.php">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" required>
        <br>
        <label for="description">Description</label>
        <textarea name="description"></textarea>
        <br>
        <label for="prix">Prix</label>
        <input type="number" name="prix" required>
        <br>
        <label for="stock">Stock</label>
        <input type="number" name="stock" required>
        <button type="submit">Ajouter</button>
    </form>
    
</body>
</html>