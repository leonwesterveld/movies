<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg de formuliervelden
    $titel = $_POST["titel"];
    $beschrijving = $_POST["beschrijving"];
    $mening = $_POST["mening"];
    $rating = $_POST['rating']; // Verkrijg de rating

    // Verwerk de afbeelding
    if (isset($_FILES["afbeelding"])) {
        $afbeeldingNaam = $_FILES["afbeelding"]["name"];
        $afbeeldingPad = "images/" . $afbeeldingNaam; // Zorg ervoor dat de map 'images' bestaat
        move_uploaded_file($_FILES["afbeelding"]["tmp_name"], $afbeeldingPad);
    }

    // Laad het bestaande JSON-bestand
    $jsonFile = 'movies.json';
    $movies = json_decode(file_get_contents($jsonFile), true);

    // Voeg een unieke ID toe aan de nieuwe film
    $newMovieId = count($movies) + 1;
    
    // Voeg de nieuwe film toe aan de array
    $newMovie = [
        "id" => $newMovieId,
        "titel" => $titel,
        "afbeelding" => $afbeeldingNaam,
        "beschrijving" => $beschrijving,
        "mening" => $mening,
        "rating" => $rating // Bewaar de rating
    ];
    $movies[] = $newMovie;

    // Sla het bijgewerkte array op in het JSON-bestand
    file_put_contents($jsonFile, json_encode($movies, JSON_PRETTY_PRINT));

    // Stuur een JSON-respons terug naar de browser
    echo json_encode([
        'success' => true,
        'movie' => $newMovie
    ]);
}
?>
