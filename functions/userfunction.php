<?php
include('../config/dbcon.php');

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
function getContentTypeName($table,$contentId) {
    global $con; 
    $query = "SELECT name FROM $table WHERE id = $contentId";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['name'];
    }
    return null; 
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
function getSerieAllId()
{
    global $con;
    $query = "SELECT id FROM series";
    $result = mysqli_query($con, $query);
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
function getAllPopular()
{
    global $con;
    $query = "SELECT * FROM content WHERE popularity_id = '2' ORDER BY RAND()";
    return $query_run = mysqli_query($con, $query);
}
function getAllPopularOrder( $order = "")
{
    global $con;
    $orderBy = $order ? "ORDER BY $order" : "";
    $query = "SELECT * FROM content WHERE popularity_id = '2' $orderBy";
    return $query_run = mysqli_query($con, $query);
}

function getAllTrending()
{
    global $con;
    $query = "SELECT * FROM content WHERE popularity_id = '1'";
    return $query_run = mysqli_query($con, $query);
}
function getAllCinema($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE popularity_id = '5'";
    return $query_run = mysqli_query($con, $query);
}
function getSlugActive($table,$slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug ='$slug'";
    return $query_run = mysqli_query($con, $query);
}
function getSeasonData($seasonId) {
    global $con;
    $query = "SELECT * FROM season WHERE season_id = $seasonId";
    $result = mysqli_query($con, $query);
    $seriesData = mysqli_fetch_assoc($result);
    return $seriesData;
}
function getSeasonDataForSeries($serieId) {
    global $con;
    $query = "SELECT * FROM season WHERE series_id = $serieId";
    $result = mysqli_query($con, $query);
    $seriesData = mysqli_fetch_assoc($result);
    return $seriesData;
}
function getSeriesData($seriesId) {
    global $con;
    $query = "SELECT * FROM series WHERE id = $seriesId";
    $result = mysqli_query($con, $query);
    $seriesData = mysqli_fetch_assoc($result);
    return $seriesData;
}
function getEpisodeData($seasonId) {
    global $con;
    $query = "SELECT * FROM episode WHERE season_id = $seasonId";
    $result = mysqli_query($con, $query);
    $seriesData = mysqli_fetch_assoc($result);
    return $seriesData;
}
function getSlugSeasonActive($table,$slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE season_slug ='$slug'";
    return $query_run = mysqli_query($con, $query);
}
function getSlugEpisodeActive($table,$slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE ep_slug ='$slug'";
    return $query_run = mysqli_query($con, $query);
}
function getProductByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM products WHERE category_id ='$category_id' AND status='0'";
    return $query_run = mysqli_query($con, $query);
}
function getIdActive($table,$id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id ='$id' AND status='0'";
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
function getSlugAllActive($contentSlug)
{
    global $con;
    $query = "SELECT s.*, se.* FROM series s INNER JOIN season se ON s.id = se.series_id WHERE se.slug = '$contentSlug'";
    return $query_run = mysqli_query($con, $query);
}

function getAllSeasonsForSeries($seriesId)
{
    global $con; 
    $query = "SELECT * FROM season WHERE series_id = '$seriesId'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $seasons = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $seasons;
    } else {
        return false;
    }
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
?>