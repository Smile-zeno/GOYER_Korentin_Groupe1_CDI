<?php

$apiKey = '4ae2fc4421fba4275e97877c89918339';
$city = $_GET['city'] ?? 'Nice'; //parametres par defaut si pas de city dans url

require '../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric&lang=fr";

try {
    // Récuperer les informations
    $contents = file_get_contents($url);

    // Afficher les informations météo
    echo $contents;
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
    http_response_code(500);
}

?>