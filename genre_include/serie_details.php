<?php
include('../functions/userfunction.php')
?>
<?php 
include ('header.php');
?>
<?php
if(isset($_GET['series']))
{
    $content_slug = $_GET['series'];
    $content_data = getSlugActive("series", $content_slug);
    $content = mysqli_fetch_array($content_data);
    $SeriesId=$content['id'];
    $title = $content['title'];
    if($content)
    { ?>
            <?php 
            include ('../genre_include/Template/_bread_crumb_option_serie.php');
            ?>
            
            <!-- Breadcrumb End -->
            <section class="content-details spad">
                <div class="container">
                    <div class="content__details__content">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="content__details__pic set-bg" data-setbg="<?=BASE_URL?>/uploads/serie_poster/<?=$content['img']; ?>">
                                    <div class="comment"><i class="fa fa-star"></i><?=$content['score']?></div>
                                    <div class="view"><i class="fa fa-eye"></i> <?=$content['total_view']?></div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="content__details__text">
                                    <div class="content__details__title">
                                        <h3><?= stripslashes($content['title']); ?></h3>
                                        <span><?=$content['tags']?></span>
                                    </div>
                                    <p><?= stripslashes($content['description']); ?></p>
                                    <div class="content__details__widget">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <ul>
                                                    <li><span>Type:</span> <?php
                                                        $content_type = getContentTypeName("content_type",$content['content_type_id']); // Replace with the appropriate function

                                                        if ($content_type !== null) {
                                                            echo $content_type;
                                                        } else {
                                                            echo "No Content Type available";
                                                        }
                                                        ?>
                                                        </li>
                                                    <li><span>Creator:</span> <?=$content['creator']?></li>
                                                    <li><span>Release year:</span> <?=$content['release_year']?></li>
                                                    <li><span>Status:</span> <?php
                                                        $status = getContentTypeName("status",$content['status_id']); // Replace with the appropriate function

                                                        if ($status !== null) {
                                                            echo $status;
                                                        } else {
                                                            echo "No Content Type available";
                                                        }
                                                        ?></li>
                                                    <li><span>Genre:</span> <?php
                                                    $genres = getGenreForSerie($content['id']);
                                                    echo implode(', ', $genres);
                                                  ?></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <ul>
                                                    <li><span>Subtitle:</span> <?=$content['subtitle']?></li>
                                                    <li><span>Duration:</span> <?=$content['duration_per_ep']?></li>
                                                    <li><span >Quality:</span> <?php 
                                                     $quality = getQualityForSeries($content['id']);
                                                     echo implode(', ', $quality);
                                                    ?></li>
                                                    <li><span>Views:</span> <?=$content['total_view']?></li>
                                                    <li><span>Actors:</span> <?=$content['actor']?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                        /* Style for truncating text with an ellipsis */
                                        ul li {
                                            white-space: nowrap;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            max-width: 500px; /* Adjust the max width as needed */
                                        }
                                    </style>
                                    <div class="content__details__btn">
                                        <a href="#" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</a>
                                        <?php
                                            $seasonData = getSeasonDataForSeries($SeriesId);

                                            if ($seasonData) {
                                                $SeasonId = $seasonData['season_id'];
                                                $episodeData = getEpisodeData($SeasonId);

                                                if ($episodeData) {
                                                    ?>
                                                    <a href="<?= BASE_URL ?>/genre_include/serie-watch.php?serie_watch=<?= $episodeData['ep_slug'] ?>" class="watch-btn">
                                                        <span>Watch Now</span> <i class="fa fa-angle-right"></i>
                                                    </a>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        include('./Template/_seasons.php');
                        ?>
                        <?php
                        include('./Template/_comment.php');
                        ?>
                        <?php
                            include('./Template/_suggestion.php');
                        ?>
                         <?php
                            include('./Template/_recommend.php');
                        ?>

      <?php
     } else {
        echo "Content not found"; // Debugging: Print a message when content is not found
    }
} else {
    echo "Content parameter not set"; // Debugging: Print a message when the content parameter is not set
}
?>


<?php 
include ('footer.php');
?>