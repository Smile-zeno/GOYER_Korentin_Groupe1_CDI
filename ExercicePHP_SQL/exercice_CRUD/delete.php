<?php

require 'connexion.php';

try {
    if (isset($_GET['id'])) {
        $delete = $pdo->prepare("DELETE FROM produits WHERE id = :id");
        $delete->execute([
            'id' => $_GET['id']
        ]);
    }

    header('Location: index.php');
} catch (PDOException $e) {
    echo "Erreur lors de la suppression de données : " . $e->getMessage();
}

?>