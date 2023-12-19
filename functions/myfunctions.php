<?php
session_start();
include('../config/dbcon.php');

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
}
function getAllSeasonsForSerie($serieId)
{
    global $con;
    $query = "SELECT * FROM season WHERE serie_id = $serieId";
    return $query_run = mysqli_query($con, $query);
}
function getSeasonsForSeries($seriesId) {
    global $con;
    $query = "SELECT season.*, series.* FROM season JOIN series ON season.series_id = series.id WHERE series.id = $seriesId";
    return mysqli_query($con, $query);
}

function getEpisodesForSeason($seasonId) {
    global $con;
    $query = "SELECT * FROM episode WHERE season_id = $seasonId";
    return mysqli_query($con, $query);
}
function createSlug($text) {
    $slug = str_replace(' ', '-', $text);
    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    $slug = strtolower($slug);
    return $slug;
}
function countCurrentEpisodes($seasonId) {
    global $con;
    $query = "SELECT COUNT(*) as episode_count FROM episode WHERE season_id = $seasonId";
    $result = mysqli_query($con, $query);

    // Check for errors
    if ($result === false) {
        // Log the error or handle it as needed
        error_log("Error in countCurrentEpisodes query: " . mysqli_error($con));
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    $episodeCount = $row['episode_count'];

    // Free the result set
    mysqli_free_result($result);

    return $episodeCount;
}
function getOrderAll( $con,$table, $order = "") 
{
    $orderBy = $order ? "ORDER BY $order" : "";
    $query = "SELECT * FROM $table $orderBy";
    return $query_run = mysqli_query($con, $query);
}
function getAllPopular($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE popularity_id = '2";
    return $query_run = mysqli_query($con, $query);
}

function getAllTrending($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE popularity_id = '2";
    return $query_run = mysqli_query($con, $query);
}
function getId($table,$id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id ='$id'";
    return $query_run = mysqli_query($con, $query);
}
function getSeasonId($table,$Id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE season_id ='$Id'";
    return $query_run = mysqli_query($con, $query);
}
function getSerieId($table,$Id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE series_id ='$Id'";
    return $query_run = mysqli_query($con, $query);
}
function getEpisodeId($Id)
{
    global $con;
    $query = "SELECT * FROM episode WHERE episode_id ='$Id'";
    return $query_run = mysqli_query($con, $query);
}
function getName($table, $id) {
    global $con;
    $query = "SELECT name FROM $table WHERE id = $id";
    $result = mysqli_query($con, $query);
    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row['name'];
    }
}
function getFlag($contentId) 
{
    global $con;
    $flags = [];
    $query = "SELECT c.flag FROM countries AS c JOIN movie_country AS mc ON c.id = mc.country_id WHERE mc.content_id = $contentId";
    $result = mysqli_query($con, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $flags[] = $row['flag'];
        }

        mysqli_free_result($result);
    } 
    return $flags;
}
function getFlagsById($id) 
{
    global $con;
    $flags = [];
    $query = "SELECT c.flag FROM countries AS c JOIN serie_country AS sc ON c.id = sc.country_id WHERE sc.series_id = $id";
    $result = mysqli_query($con, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $flags[] = $row['flag'];
        }

        mysqli_free_result($result);
    } 
    return $flags;
}

// get genres for content
function getGenreForContent($contentId) 
{
    global $con;
    $genreNames = [];
    $query = "SELECT g.name FROM genre AS g JOIN movie_genre AS mg ON g.id = mg.genre_id WHERE mg.content_id = $contentId";
    $result = mysqli_query($con, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $genreNames[] = $row['name'];
        }

        mysqli_free_result($result);
    } 
    return $genreNames;
}
// get qualities for content
function getQualityForMovie($contentId)
{
    global $con;
    $qualityNames = [];
    $query = "SELECT q.name FROM quality AS q JOIN content_quality AS cq ON q.id = cq.quality_id WHERE cq.content_id = $contentId";
    $result = mysqli_query($con, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $qualityNames[] = $row['name'];
        }

        mysqli_free_result($result);
    } 
    return $qualityNames;
}
function getSelectedStuff($table, $tableId, $relatedTable, $relatedCol) 
{
    global $con;
    $selectedItems = [];

    // Query the relation table to retrieve the selected items for the specified entity
    $query = "SELECT $relatedCol FROM $relatedTable WHERE {$table}_id = $tableId";
    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $selectedItems[] = $row[$relatedCol];
        }
        mysqli_free_result($result);
    }

    return $selectedItems;
}
function getGenreForSerie($seriesId) {
    global $con;
    $genreNames = [];
    $query = "SELECT g.name FROM genre AS g JOIN serie_genre AS sg ON g.id = sg.genre_id WHERE sg.series_id = $seriesId";
    $result = mysqli_query($con, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $genreNames[] = $row['name'];
        }

        mysqli_free_result($result);
    } 
    return $genreNames;
}
function getQualityForSeries($seriesId)
{
    global $con;
    $qualityNames = [];
    $query = "SELECT q.name FROM quality AS q JOIN serie_quality AS sq ON q.id = sq.quality_id WHERE sq.series_id = $seriesId";
    $result = mysqli_query($con, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $qualityNames[] = $row['name'];
        }

        mysqli_free_result($result);
    } 
    return $qualityNames;
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}
function getUserInfo()
{
    global $con;
    $query = "SELECT * FROM users WHERE role_id = '0'";
    return $query_run = mysqli_query($con, $query);
}
?>
