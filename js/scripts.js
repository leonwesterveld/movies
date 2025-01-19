// Functie om sterren te genereren
function generateStars(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        stars += `<span class="star" data-star="${i}">&#9733;</span>`;
    }
    return stars;
}

// Functie voor het aanklikken van sterren en de rating opslaan
function highlightStars(element) {
    const rating = parseInt(element.dataset.rating);
    const stars = element.querySelectorAll('.star');
    stars.forEach((star, index) => {
        star.style.color = index < rating ? 'gold' : 'gray';
    });
}

// Reset de sterrenkleur bij mouseout
function resetStars(element) {
    const stars = element.querySelectorAll('.star');
    stars.forEach(star => {
        star.style.color = 'gray';
    });
}

// Functie voor het filteren van films op naam
function filterMovies() {
    const searchTerm = document.getElementById('search').value.toLowerCase();
    const filteredMovies = window.movies.filter(movie => 
        movie.titel.toLowerCase().includes(searchTerm)
    );
    displayMovies(filteredMovies);
}

// Functie om de rating te geven bij klikken
function rateMovie(starElement) {
    const rating = starElement.dataset.rating;
    document.getElementById("rating").dataset.rating = rating;
    // Update de sterrencollectie op het formulier
    document.querySelector("#rating .stars").innerHTML = generateStars(rating);
}

// Functie om sterren te highlighten bij hover
function highlightStars(starElement) {
    const rating = starElement.dataset.rating;
    const stars = starElement.querySelectorAll('.star');
    stars.forEach((star, index) => {
        star.style.color = index < rating ? 'gold' : 'gray';
    });
}

// Functie om de sterren te resetten bij mouseout
function resetStars(starElement) {
    const rating = starElement.dataset.rating;
    const stars = starElement.querySelectorAll('.star');
    stars.forEach(star => {
        star.style.color = 'gray';
    });
}

// Functie om de rating te geven bij klikken
function rateMovie(starElement) {
    const rating = starElement.dataset.rating;
    document.getElementById("rating").dataset.rating = rating;
    // Update de sterrencollectie op het formulier
    document.querySelector("#rating .stars").innerHTML = generateStars(rating);
}