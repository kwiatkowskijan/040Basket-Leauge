document.getElementById('season-select').addEventListener('change', function() {
    const seasonID = this.value;
    const xhr = new XMLHttpRequest();

    xhr.open('GET', 'get_teams.php?seasonID=' + seasonID, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('teams-container').innerHTML = xhr.responseText;
        } else {
            console.error('Błąd podczas ładowania danych.');
        }
    };
    xhr.send();
});