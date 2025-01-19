// Functie om het bewerkformulier in te schakelen
function toggleEditForm() {
    const editForm = document.getElementById('editForm');
    editForm.style.display = (editForm.style.display === 'none' || editForm.style.display === '') ? 'block' : 'none';
}

// Functie voor het verzenden van het bewerkformulier via AJAX
const editForm = document.getElementById('editFilmForm');
editForm.addEventListener('submit', function(e) {
    e.preventDefault(); // Voorkom herladen van de pagina

    const formData = new FormData(editForm); // Verzend de formuliergegevens via AJAX

    fetch('update_movie.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Film succesvol bewerkt!");
            window.location.reload(); // Herlaad de pagina om de gewijzigde gegevens weer te geven
        } else {
            alert("Er is een fout opgetreden bij het bewerken van de film.");
        }
    })
    .catch(error => console.error("Error updating movie:", error));
});