function confirmDeletion(playerID) {
    if (confirm('Czy na pewno chcesz usunąć zawodnika ?')) {
        window.location.href = 'delete-player.php?id=' + playerID;
    }
}