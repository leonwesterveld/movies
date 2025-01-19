<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Upload & Zoeken</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/scripts.js" defer></script>
    <script src="js/index.js" defer></script>
</head>
<body>
    <h1>Film Gegevens Uploaden</h1>
    <form id="filmForm" enctype="multipart/form-data">
        <label for="titel">Filmtitel:</label>
        <input type="text" id="titel" name="titel" required><br><br>

        <label for="afbeelding">Afbeelding:</label>
        <input type="file" id="afbeelding" name="afbeelding" accept="image/*" required><br><br>

        <label for="beschrijving">Beschrijving:</label><br>
        <textarea id="beschrijving" name="beschrijving" rows="4" cols="50" required></textarea><br><br>

        <label for="mening">Mening:</label><br>
        <textarea id="mening" name="mening" rows="4" cols="50" required></textarea><br><br>

        <label for="rating">Sterren Rating:</label><br>
        <div id="rating" class="stars" data-rating="0">
            <span onclick="highlightStars(this)" class="star" data-star="1">&#9733;</span>
            <span onclick="highlightStars(this)" class="star" data-star="2">&#9733;</span>
            <span onclick="highlightStars(this)" class="star" data-star="3">&#9733;</span>
            <span onclick="highlightStars(this)" class="star" data-star="4">&#9733;</span>
            <span onclick="highlightStars(this)" class="star" data-star="5">&#9733;</span>
        </div><br><br>

        <input type="submit" value="Uploaden">
    </form>

    <h2>Zoek naar Films</h2>
    <input type="text" id="search" placeholder="Zoek films op naam..." onkeyup="filterMovies()">

    <h2>Alle Films</h2>
    <div id="movies-container">
        <!-- De films worden hier geladen door JavaScript -->
    </div>
</body>
</html>

