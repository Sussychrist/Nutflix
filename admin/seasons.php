<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>
<head>
<link id="pagestyle" href="assets/css/material-dashboard.min.css" rel="stylesheet" />
<link id="pagestyle" href="assets/css/list.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<div class="container">
<?php 
    if(isset($_GET['id']))
    {       
        $SeriesId = $_GET['id'];

        $serie = getId("series",$SeriesId);
        
        if(mysqli_num_rows($serie)>0)
        {
            $data = mysqli_fetch_array($serie);             
            ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Season</h4>
                        <div class="button-container" style="text-align: right;">
                            <a href="add-season.php?id=<?=$SeriesId?>" class="btn btn-success" style="margin-right: 10px;"><i class="fa fa-solid fa-plus" style="color: #ffffff;"></i> Add New</a>
                            <a href="series.php?series_id=<?=$SeriesId?>" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                    <div class="card-body" id="season_table">
                        <table class="table table-bordered table-group-divider table-hover">
                            <thead>
                            <tr>
                                <th>Poster</th>
                                <th>Season</th>
                                <th>Description</th>
                                <th>Country</th>
                                <th>Release year</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             $seasons = getSeasonsForSeries($SeriesId);

                             if ($seasons !== false && mysqli_num_rows($seasons) > 0) 
                             {
                                 foreach ($seasons as $item) 
                                 {
                                        ?>
                                        <tr>
                                            <td style="width:220px">
                                                <div class="movie_item">
                                                    <div class="movie_item_pic">
                                                        <img src="../uploads/serie_poster/seasons_poster/<?= $item['season_img'];?>" class="img-fluid rounded-2" alt="<?= $item['img']; ?>">
                                                        <div class="ep"><?= getName("status", $item['season_status_id']); ?></div>
                                                        <div class="comment"><i class="fa fa-star"></i> <?=$item['season_score']; ?></div>
                                                        <div class="view"><i class="fa fa-eye"></i> <?=$item['views'];?></div>
                                                    </div>
                                                    <div class="movie_item_quality mb-2">
                                                        <ul>
                                                            <?php
                                                            $quality = getQualityForSeries($item['id']);
                                                            foreach ($quality as $qualities) {
                                                                echo "<li>$qualities</li>";
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="movie_item_text">
                                                        <ul>
                                                        <?php
                                                            $genres = getGenreForSerie($item['id']);
                                                            $maxGenres = 3; // Set the maximum number of genres to display

                                                            foreach ($genres as $index => $genre) {
                                                                if ($index < $maxGenres) {
                                                                    echo "<li>$genre</li>";
                                                                } else {
                                                                    break;
                                                                }
                                                            }

                                                            if (count($genres) > $maxGenres) {
                                                                echo "<li>...</li>";
                                                            }
                                                            ?>    
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                Season <?= $item['season_number']; ?>  
                                            </td >
                                            <td style="width:300px">
                                                <style>.tag-container {
                                                    white-space: pre-wrap;
                                                }</style>
                                                <div class="tag-container">
                                                <?php
                                                    $description = trim($item['season_description']);
                                                ?>
                                                    <?= stripslashes($description); ?>
                                                </div>
                                            </td>
                                            <td>
                                                <?php
                                                    $flag = getFlagsById($item['id']);
                                                    foreach ($flag as $flags) {
                                                        ?>
                                                        <img src="../uploads/flags/<?=$flags?>" class="img-fluid rounded" width="40px" alt="">
                                                        <?php 
                                                    }
                                                ?>
                                            </td>
                                            <td style="width:50px">
                                                <?= $item['season_release_year']; ?>  
                                            </td >
                                            <td style="width:60px">
                                                <a href="episode.php?season_id=<?= $item['season_id']; ?>" class="btn btn-success">Episode</a>
                                            </td>
                                            <td style="width:60px">
                                                <a href="edit-season.php?season_id=<?= $item['season_id']; ?>" class="btn btn-primary">Edit</a>
                                            </td>
                                            <td style="width:60px">
                                                <button type="button" class="btn btn-danger delete_season_btn"
                                                        value="<?= $item['season_id']; ?>">Delete
                                                </button>
                                            </td>
                                        </tr>
                                            <?php
                                       }
                                    } else {
                                        echo "No seasons found for the given series ID.";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
        }
        else
        {
            echo "Product not found for given id";
        }
    }
    else
    {
        echo "Id missing from url";
    }

?>
</div>
<?php
include('includes/footer.php');
?>