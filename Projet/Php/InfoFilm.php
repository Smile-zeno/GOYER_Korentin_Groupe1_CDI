<?php //Pas utiliser actuellement

$apiKey = 'b408120da29830089d811abdd668f258';
$film = $_GET('film') ?? 'Titanic';
switch ($film) {
    case 'Titanic' : 
        $num = 597;
        break;
    case 'Batman_Begins' :
        $num = 272;
        break;
    case 'Arrete_moi_si_tu_peux' :
        $num = 640;
        break;
    case 'The_phoenician_scheme' :
        $num = 1137350;
        break;
    case 'Iron_Man' :
        $num = 1726;
        break;
    case 'Les_aventuriers_de_l_arche_perdu' :
        $num = 85;
        break;
    case 'Sos_fantomes' :
        $num = 620;
        break;
    case 'Green_book' :
        $num = 490132;
        break;
}

$url = "https://api.themoviedb.org/3/movie/$num?api_key=$apiKey&language=fr-FR";


// Récuperer les informations
$response = file_get_contents($url);

if ($response === FALSE) {
    http_response_code(500);
    echo json_encode(['erreur' => 'Erreur lors de la récupération des données']);
    exit;
}

header('Content-type: application/json');
echo $response;

?>