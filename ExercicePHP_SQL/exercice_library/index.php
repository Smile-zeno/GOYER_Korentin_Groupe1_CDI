<?php

try {
    // Connexion BDD
    $pdo = new PDO('mysql:host=localhost;dbname=librairie', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
    echo "<br>";

    // récuperer tous les livres et les afficher
    $query = $pdo->query("SELECT * FROM livre");
    $livre = $query->fetchAll(PDO::FETCH_ASSOC);

    echo "<ul>";
    foreach ($livre as $liv) {
        echo "<li>";
        echo $liv['titre'] . ' - ' . $liv['auteur'] . ' - ' . $liv['annee_publication'];
        echo "</li>";
    }
    echo "</ul>";

    // récuperer tous les livres publié après 2000
    $req = $pdo->prepare("SELECT * FROM livre WHERE annee_publication > :annee ORDER BY titre ASC");
    $req->execute([
        'annee' => 2000
    ]);

    $livresRecents = $req->fetchAll(PDO::FETCH_ASSOC);

    echo "<h1> Livres publiés après 2000 </h1>";
    foreach ($livresRecents as $livreRecent) {
        
        echo "<li>";
        echo $livreRecent['titre'] . ' - ' . $livreRecent['auteur'] . ' - ' . $livreRecent['annee_publication'];
        echo "</li>";
    }

    // ajouter un livre en base de données
    $requete = $pdo->prepare("INSERT INTO livre (titre, auteur, annee_publication, disponible) VALUES (:titre, :auteur, :annee, :disponible)");
    $requete->execute([
        'titre' => 'Le petit prince',
        'auteur' => 'Antoine de Saint-Exupéry',
        'annee' => 1943,
        'disponible' => 1
    ]);

    $id = $pdo->lastInsertId();
    echo "Nouvel id ajouté : " . $id;

    // modifier disponibilité d'un livre
    $update = $pdo->exec("UPDATE livre SET disponible=0 WHERE id=5");
    echo "Nombres de lignes modifiées : " . $update;

    // supprimer un livre
    $delete = $pdo->prepare("DELETE FROM livre WHERE id = :id");
    $delete->execute([
        'id' => 7 
    ]);

} catch (PDOException $e) {
    echo "Erreur de connexion " . $e->getMessage();
}