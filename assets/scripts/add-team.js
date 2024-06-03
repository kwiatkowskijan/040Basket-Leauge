const message = document.getElementById("info-container");

document.getElementById("add-team").onsubmit = function (event) {
    event.preventDefault();

    const form = event.target;

    if (form.checkValidity()) {
        const teamName = document.querySelector('input[name="teamName"]').value;

        const xhr = new XMLHttpRequest();

        xhr.open('GET', 'check-team-existance.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if(xhr.status === 200) {
                addTeam();
            }
            else {
                message.innerHTML = "<p>Taka drużyna już istnieje w bazie danych</p>";
            }
        }

        xhr.send('teamName=' + encodeURIComponent(teamName));
    }
};

function addTeam() {
    const teamName = document.querySelector('input[name="teamName"]').value;
        const city = document.querySelector('input[name="city"]').value;
        const establishedYear = document.querySelector('input[name="establishedYear"]').value;
        const coach = document.querySelector('input[name="coach"]').value;

        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'add-edit-team-action.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                message.innerHTML = "<p>Pomyślnie dodano drużyune</p>";
            } else {
                console.error('Błąd podczas ładowania danych.');
            }
        }

        xhr.send('teamName=' + encodeURIComponent(teamName) + '&city=' + encodeURIComponent(city) + '&establishedYear=' + encodeURIComponent(establishedYear) + '&coach=' + encodeURIComponent(coach));
};