// Voeg AJAX voor formulierverzending toe
const form = document.getElementById('filmForm');
form.addEventListener('submit', function(e) {
    e.preventDefault(); // Voorkom dat het formulier de pagina herlaadt

    const rating = document.getElementById('rating').getAttribute("data-rating");
    const formData = new FormData(form);
    formData.append('rating', rating); // Voeg de rating toe aan de formulierdata

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Voeg de nieuwe film toe aan de lijst en toon het meteen
            window.movies.push(data.movie);
            displayMovies(window.movies);
        } else {
            alert("Er is een fout opgetreden bij het uploaden van de film.");
        }
    })
    .catch(error => console.error("Error uploading movie:", error));
});


// Functie om films weer te geven
function displayMovies(movies) {
    const container = document.getElementById('movies-container');
    container.innerHTML = ""; // Leeg de container eerst

    movies.forEach(movie => {
        const movieDiv = document.createElement('div');
        movieDiv.classList.add('film');
        movieDiv.innerHTML = `
            <a href="movie_detail.php?id=${movie.id}">
                <img src="images/${movie.afbeelding}" alt="${movie.titel}">
            </a>
            <div>
                <h3>${movie.titel}</h3>
                <p>${movie.beschrijving}</p>
                <div class="stars" data-movie-id="${movie.id}" onmouseover="highlightStars(this)" onmouseout="resetStars(this)" onclick="rateMovie(this)">
                    ${generateStars(movie.rating)}
                </div>
            </div>
        `;
        container.appendChild(movieDiv);
    });
}

// Laad de films uit de JSON-bestanden (via PHP)
fetch('movies.json')
    .then(response => response.json())
    .then(data => {
        window.movies = data; // Sla de films op in een globale variabele
        displayMovies(data); // Toon alle films
    })
    .catch(error => console.error("Error loading movies:", error));