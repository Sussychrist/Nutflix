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
    <div class="card">
        <div class="card-header">
            <h4>Series</h4>
            <div class="button-container" style="text-align: right;">
                <a href="add-series.php" class="btn btn-success" style="margin-right: 10px;"><i class="fa fa-solid fa-plus" style="color: #ffffff;"></i> Add New</a>
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="card-body" id="series_table">
            <table class="table table-bordered table-group-divider table-hover">
                <thead>
                <tr>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Tags</th>
                    <th>Country</th>
                    <th>Release year</th>
                    <th>Seasons</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $series = getOrderAll($con, "series", "title ASC"); 
                if (mysqli_num_rows($series) > 0) {
                    foreach ($series as $item) {
                        ?>
                        <tr>
                            <td>
                                <div class="movie_item">
                                    <div class="movie_item_pic">
                                        <img src="../uploads/serie_poster/<?= $item['img'];?>" class="img-fluid rounded-2" alt="<?= $item['img']; ?>">
                                        <div class="ep"><?= getName("popularity", $item['popularity_id']); ?></div>
                                        <div class="comment"><i class="fa fa-star"></i> <?=$item['score']; ?></div>
                                        <div class="view"><i class="fa fa-eye"></i> <?=$item['total_view'];?></div>
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
                            <?= stripslashes($item['title']); ?>
                            </td>
                            <td style="width:300px">
                                <style>.tag-container {
                                    white-space: pre-wrap;
                                }</style>
                                 <div class="tag-container">
                                 <?php
                                    $tags = trim($item['tags']);
                                ?>
                                    <?= $tags ?> 
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
                                <?= $item['release_year']; ?>  
                            </td >
                            <td style="width:50px">
                                <a href="seasons.php?id=<?= $item['id']; ?>" class="btn btn-success">Seasons</a>
                            </td>
                            <td style="width:60px">
                                <a href="edit-serie.php?id=<?= $item['id']; ?>" class="btn btn-primary">Edit</a>
                            </td>
                            <td style="width:60px">
                                <button type="button" class="btn btn-danger delete_serie_btn"
                                        value="<?= $item['id']; ?>">Delete
                                </button>
                            </td>
                        </tr>
                            <?php
                        }
                    } else {
                        echo "No records found!";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>