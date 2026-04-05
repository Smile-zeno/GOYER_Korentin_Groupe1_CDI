<?php

function calculerMoyenne($nombre1, $nombre2, $nombre3) {
    $somme = $nombre1 + $nombre2 + $nombre3;
    $resultat = $somme / 3;
    $resultat = round($resultat, 2);
    var_dump($resultat);
    return $resultat;
}

function afficherResultat($nom, $moyenne) {
    if ($moyenne >= 10) {
        $resultat = "suffisante";
    }else {
        $resultat = "insuffisante";
    }
    echo "La moyenne de $nom est $resultat";
}

echo calculerMoyenne(17, 12, 15);
echo "<br>";
afficherResultat("Alice", calculerMoyenne(16, 18, 14));
echo "<br>";
afficherResultat("Alice", calculerMoyenne(6, 8, 4));

?>