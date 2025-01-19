<?php
// Functie om sterren te genereren op basis van de rating
function generateStars($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        $stars .= $i <= $rating ? '★' : '☆';
    }
    return $stars;
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
// Haal het id van de film op uit de URL
$movieId = $_GET['id'] ?? null;

if (!$movieId) {
    die('Geen film-ID opgegeven.');
}

// Laad de films (bijvoorbeeld uit een JSON-bestand of een database)
$movies = json_decode(file_get_contents('movies.json'), true);

// Zoek de film op basis van het id
$movie = null;
foreach ($movies as $m) {
    if ($m['id'] == $movieId) {
        $movie = $m;
        break;
    }
}

if (!$movie) {
    die('Film niet gevonden.');
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Detail</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/scripts.js" defer></script>
    <script src="js/bewerk.js" defer></script>
</head>
<body>
    <h1>Film Detail</h1>
    <div class="film-detail">
        <img src="images/<?php echo $movie['afbeelding']; ?>" alt="<?php echo htmlspecialchars($movie['titel']); ?>">
        <h2><?php echo htmlspecialchars($movie['titel']); ?></h2>
        <p><strong>Beschrijving:</strong> <?php echo htmlspecialchars($movie['beschrijving']); ?></p>
        <p><strong>Mening:</strong> <?php echo htmlspecialchars($movie['mening']); ?></p>a
        <p><strong>Rating:</strong> 
            <span class="stars">
                <?php echo generateStars($movie['rating']); ?>
            </span>
        </p>
        <a href="javascript:void(0);" onclick="toggleEditForm()">Bewerk</a>
    </div>

    <!-- Formulier voor bewerken -->
    <div id="editForm" style="display:none;">
    <h2>Bewerk Film</h2>
    <form id="editFilmForm" enctype="multipart/form-data" action="update_movie.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">

        <div class="form-group">
            <label for="titel">Filmtitel:</label>
            <input type="text" id="titel" name="titel" value="<?php echo htmlspecialchars($movie['titel']); ?>" placeholder="Filmtitel" required><br><br>
        </div>

        <div class="form-group">
            <label for="afbeelding">Afbeelding:</label>
            <input type="file" id="afbeelding" name="afbeelding" accept="image/*"><br><br>
        </div>

        <div class="form-group">
            <label for="beschrijving">Beschrijving:</label><br>
            <textarea id="beschrijving" name="beschrijving" rows="4" cols="50" placeholder="Beschrijving"><?php echo htmlspecialchars($movie['beschrijving']); ?></textarea><br><br>
        </div>

        <div class="form-group">
            <label for="mening">Mening:</label><br>
            <textarea id="mening" name="mening" rows="4" cols="50" placeholder="Mening"><?php echo htmlspecialchars($movie['mening']); ?></textarea><br><br>
        </div>

        <div class="form-group">
            <label for="rating">Sterren Rating:</label><br>
            <div id="rating" class="stars" data-rating="<?php echo $movie['rating']; ?>">
                <span onclick="highlightStars(this)" class="star" data-star="1">&#9733;</span>
                <span onclick="highlightStars(this)" class="star" data-star="2">&#9733;</span>
                <span onclick="highlightStars(this)" class="star" data-star="3">&#9733;</span>
                <span onclick="highlightStars(this)" class="star" data-star="4">&#9733;</span>
                <span onclick="highlightStars(this)" class="star" data-star="5">&#9733;</span>
            </div><br><br>
        </div>

        <input type="submit" value="Bewerk Film">
    </form>
</div>

</body>
</html>
