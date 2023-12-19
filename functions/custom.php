<?php
include('config/dbcon.php');
function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
}
function getOrderAll( $con,$table, $order = "") 
{
    $orderBy = $order ? "ORDER BY $order" : "";
    $query = "SELECT * FROM $table $orderBy";
    return $query_run = mysqli_query($con, $query);
}
function getAllPopularOrder($order = "")
{
    global $con;
    $orderBy = $order ? "ORDER BY $order" : "";
    $query = "SELECT * FROM content WHERE popularity_id = '2' $orderBy";
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
function getContentType($table,$order = "") {
    global $con; 
    $orderBy = $order ? "ORDER BY $order" : "";
    $query = "SELECT * FROM $table WHERE content_type_id = '3' $orderBy" ;
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
function getAllSerieIds() {
    global $con;
    $query = "SELECT id FROM series";
    $result = mysqli_query($con, $query);

    $idArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $idArray[] = $row['series_id'];
    }

    return $idArray;
}
function getAllSeriesInfo() {
    global $con;

    $allSeriesData = array();

    // Fetch all series
    $seriesQuery = "SELECT * FROM series";
    $seriesResult = mysqli_query($con, $seriesQuery);

    while ($seriesRow = mysqli_fetch_assoc($seriesResult)) {
        $seriesId = $seriesRow['id'];

        // Fetch seasons for each series
        $seasonQuery = "SELECT * FROM season WHERE series_id = '$seriesId'";
        $seasonResult = mysqli_query($con, $seasonQuery);
        $seasonData = array();

        while ($seasonRow = mysqli_fetch_assoc($seasonResult)) {
            $seasonId = $seasonRow['season_id'];

            // Fetch episodes for each season
            $episodeQuery = "SELECT * FROM episode WHERE season_id = '$seasonId'";
            $episodeResult = mysqli_query($con, $episodeQuery);
            $episodes = array();

            while ($episodeRow = mysqli_fetch_assoc($episodeResult)) {
                $episodes[] = $episodeRow;
            }

            // Add episodes to season data
            $seasonRow['episodes'] = $episodes;

            // Add season data to the array
            $seasonData[] = $seasonRow;
        }

        // Combine all information for each series
        $allSeriesData[] = array(
            'series' => $seriesRow,
            'seasons' => $seasonData,
        );
    }

    return $allSeriesData;
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
function getAllPopular($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE popularity_id = '2' ORDER BY RAND()";
    return $query_run = mysqli_query($con, $query);
}
function getAllCinema($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE popularity_id = '5'";
    return $query_run = mysqli_query($con, $query);
}
function getId($table,$id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id ='$id'";
    return $query_run = mysqli_query($con, $query);
}
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
function getGenreForSerie($serieId) 
{
    global $con;
    $genreNames = [];
    $query = "SELECT g.name FROM genre AS g JOIN serie_genre AS sg ON g.id = sg.genre_id WHERE sg.series_id = $serieId";
    $result = mysqli_query($con, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $genreNames[] = $row['name'];
        }

        mysqli_free_result($result);
    } 
    return $genreNames;
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
function getFlagSerie($serieId) 
{
    global $con;
    $flags = [];
    $query = "SELECT c.flag FROM countries AS c JOIN serie_country AS sc ON c.id = sc.country_id WHERE sc.series_id = $serieId";
    $result = mysqli_query($con, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $flags[] = $row['flag'];
        }

        mysqli_free_result($result);
    } 
    return $flags;
}
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
function getQualityForseries($serieId)
{
    global $con;
    $qualityNames = [];
    $query = "SELECT q.name FROM quality AS q JOIN serie_quality AS sq ON q.id = sq.quality_id WHERE sq.series_id = $serieId";
    $result = mysqli_query($con, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $qualityNames[] = $row['name'];
        }

        mysqli_free_result($result);
    } 
    return $qualityNames;
}
function getContentTypeName($contentId) {
    global $con; 
    $query = "SELECT name FROM content_type WHERE id = $contentId";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['name'];
    }
    return null; 
}
function getSerieTypeName($serieId) {
    global $con; 
    $query = "SELECT name FROM status WHERE id = $serieId";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['name'];
    }
    return null; 
}
function countEpisodes($seasonId) {
    global $con;
    $query = "SELECT COUNT(*) AS episode_count FROM episode WHERE season_id = '$seasonId'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['episode_count'];
    }
    return 0;
}
?>