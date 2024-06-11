document.getElementById('season-select').addEventListener('change', function() {
    const seasonID = this.value;
    const xhr = new XMLHttpRequest();

    xhr.open('GET', '/040Basket-Leauge/views/teams/get-results.php?seasonID=' + seasonID, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('results-container').innerHTML = xhr.responseText;
        } else {
            console.error('Błąd podczas ładowania danych.');
        }
    };
    xhr.send();
});