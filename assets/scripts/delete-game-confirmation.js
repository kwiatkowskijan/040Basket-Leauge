function confirmDeletion(gameID) {
    if (confirm('Czy na pewno chcesz usunąć ten mecz?')) {
        window.location.href = 'delete-schedule.php?id=' + gameID;
    }
}