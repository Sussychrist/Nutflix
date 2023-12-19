<?php
include('../middleware/adminMiddleware.php');
include('../includes/db.php');

// Fetch series based on the search query
if (isset($_GET['search_query'])) {
    $searchQuery = mysqli_real_escape_string($con, $_GET['search_query']);

    $query = "SELECT id, title FROM series WHERE title LIKE '%$searchQuery%'";
    $result = mysqli_query($con, $query);

    $series = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $series[] = $row;
    }

    // Return the series as JSON
    header('Content-Type: application/json');
    echo json_encode($series);
    exit();
}
?>
