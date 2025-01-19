<?php
// Haal de films op uit het JSON-bestand
$movies = json_decode(file_get_contents('movies.json'), true);

// Verkrijg de gegevens van het formulier
$id = $_POST['id']; // Film ID die we willen bewerken
$titel = $_POST['titel'];
$afbeelding = $_FILES['afbeelding']['name'] ?? null;
$beschrijving = $_POST['beschrijving'];
$mening = $_POST['mening'];
$rating = $_POST['rating'];  // Verkrijg de rating van het formulier

// Zoek de film op basis van het ID en werk de gegevens bij
foreach ($movies as &$movie) {
    if ($movie['id'] == $id) {
        // Werk de gegevens bij
        $movie['titel'] = $titel;
        $movie['beschrijving'] = $beschrijving;
        $movie['mening'] = $mening;
        $movie['rating'] = $rating;

        // Als er een nieuwe afbeelding is geüpload, verwerk deze
        if ($afbeelding) {
            move_uploaded_file($_FILES['afbeelding']['tmp_name'], 'images/' . $afbeelding);
            $movie['afbeelding'] = $afbeelding;
        }

        break; // Stop de loop zodra de film is gevonden en bijgewerkt
    }
}

// Sla de bijgewerkte films op in het JSON-bestand
file_put_contents('movies.json', json_encode($movies, JSON_PRETTY_PRINT));

// Geef een succesbericht terug (of ander bericht als je dat wilt)
echo json_encode(['success' => true]);
?>
