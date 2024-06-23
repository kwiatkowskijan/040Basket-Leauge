function confirmDeletion(seasonID) {
    if (confirm('Czy na pewno chcesz usunąć ten sezon?')) {
        window.location.href = 'delete-season.php?id=' + seasonID;
    }
}