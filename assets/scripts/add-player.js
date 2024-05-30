document.getElementById("player-form").onsubmit = function(event){
    event.preventDefault();

    const form = event.target;

    if (form.checkValidity()) {
        const firstName = form.querySelector('input[name="firstName"]').value;
        const lastName = form.querySelector('input[name="lastName"]').value;
        const age = form.querySelector('input[name="age"]').value;
        const height = form.querySelector('input[name="height"]').value;
        const weight = form.querySelector('input[name="weight"]').value;
        const position = form.querySelector('select[name="position"]').value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add-edit-player-action.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById("player-info-container").innerHTML = "<p>Pomyślnie dodano gracza</p>";
            } else {
                console.error('Błąd podczas ładowania danych.');
            }
        };

        const data = `firstName=${encodeURIComponent(firstName)}&lastName=${encodeURIComponent(lastName)}&age=${encodeURIComponent(age)}&height=${encodeURIComponent(height)}&weight=${encodeURIComponent(weight)}&position=${encodeURIComponent(position)}`;
        xhr.send(data);
    }
};
