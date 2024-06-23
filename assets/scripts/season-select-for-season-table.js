function loadSeasonData(seasonID) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/040Basket-Leauge/views/season-table/get-season-table.php?seasonID=' + seasonID, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('season-table-container').innerHTML = xhr.responseText;
        } else {
            console.error('Błąd podczas ładowania danych.');
        }
    };
    xhr.send();
}

document.addEventListener('DOMContentLoaded', function() {
    const seasonSelect = document.getElementById('season-select');
    const selectedOption = seasonSelect.options[seasonSelect.selectedIndex];
    loadSeasonData(selectedOption.value);

    seasonSelect.addEventListener('change', function() {
        loadSeasonData(this.value);
    });
});