<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meteo</title>
</head>
<body>
    
<input type="text" name="city" id="city" placeholder="Entrer une ville">
<button id="getWeather">Voir la météo</button>
<div id="weather"></div>

<script type="text/javascript">
    document.getElementById("getWeather").addEventListener('click', () => {
        const city = document.getElementById('city').value || 'Nice';
        const url = `recupere.php?city=${city}`;

        // requete HTTP vers notre fichier php
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur reseau ou API');
                }

                return response.json();
            }).then(data => {
                const weatherDiv = document.getElementById('weather');
                weatherDiv.innerHTML = `
                <p>Ville : ${data.name} </p>
                <p>Meteo : ${data.weather[0].description} </p>
                <p>Temperature : ${data.main.temp} °C </p>
                <p>Humidité : ${data.main.humidity} % </p>
                `
            }).catch(error => {
                console.log('Erreur : ' . error);
                document.getElementById('weather').innerHTML = 'Erreur lors de la récupération des données'
            });
    })
</script>

</body>
</html>