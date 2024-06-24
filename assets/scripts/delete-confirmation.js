function confirmDeletion(teamID) {
    if (confirm('Czy na pewno chcesz usunąć tę drużynę?')) {
        window.location.href = 'delete-team.php?id=' + teamID;
    }
}