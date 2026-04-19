<?php

require 'connexion.php';

try {
    if (isset($_GET['id'])) {
        $requete = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
        $requete->execute([
            'id' => $_GET['id']
        ]);

        $produit = $requete->fetch(PDO::FETCH_ASSOC);
        // si on trouve pas le produit
        if (!$produit) {
            header('Location: index.php');
        }
    }

    if (isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['stock']) && isset($_GET['id'])) {
        $modification = $pdo->prepare("UPDATE produits SET nom = :nom, description = :description, prix = :prix, stock = :stock WHERE id = :id");
        $modification->execute([
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'prix' => $_POST['prix'],
            'stock' => $_POST['stock'],
            'id' => $_POST['id']
        ]);

        header('Location: index.php');
    }
} catch (PDOException $e) {
    echo "Erreur lors de la modification du produit : " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Modification d'un produit</title>
</head>
<body>
    <h1>Modifier le produit</h1>
    <form method="POST" action="update.php?id=<?php echo $produit['id']; ?>">
        <label for="nom">Nom</label>
        <input type="text" name="nom" value="<?php echo $produit['nom']; ?>" required>
        <br>
        <label for="description">Description</label>
        <textarea name="description"><?php echo $produit['description']; ?></textarea>
        <br>
        <label for="prix">Prix</label>
        <input type="number" name="prix" value="<?php echo $produit['prix']; ?>" required>
        <br>
        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?php echo $produit['stock']; ?>" required>
        <button type="submit">Modifier</button>
    </form>
    
</body>
</html>