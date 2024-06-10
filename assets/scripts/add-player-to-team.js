document.getElementById("add-player-to-team").onsubmit = function (event) {
    event.preventDefault();

    const form = event.target;

    if (form.checkValidity()) {
        const player = form.querySelector('select[name="playerID"]').value;
        const team = form.querySelector('select[name="teamID"]').value;

        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'add-player-to-team-action.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                document.getElementById("team-to-player").innerHTML = "<p>Pomyślnie dodano gracza do drużyny</p>";
            } else {
                console.error('Błąd podczas ładowania danych.');
            }
        };

        const data = `playerID=${encodeURIComponent(player)}&teamID=${encodeURIComponent(team)}`;
        xhr.send(data);
    }
};
