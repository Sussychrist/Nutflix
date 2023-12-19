<?php
include('../functions/userfunction.php');
include('header.php');

if (isset($_GET['serie_watch'])) {
    $content_slug = $_GET['serie_watch'];
    $content_data = getSlugEpisodeActive("episode", $content_slug);
    $content = mysqli_fetch_array($content_data);
    $SeriesId=$content['series_id'];
    $SeasonId = $content['season_id'];
    if ($content) {
        include('../genre_include/Template/_bread_crumb_option_season.php');
?>
            <?php
            $seriesData = getSeriesData($SeriesId);
            $title = $seriesData['title'];
            if($seriesData)
            {
                $seasonData = getSeasonData($SeasonId);
                if($seasonData){
            ?>
                <section class="content-details spad">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <div class="section-title">
                                    <h5 style="font-size: 30px; color: white;"><?= stripslashes($title); ?> Season <?=$seasonData['season_number']?> <?=$content['ep_name']?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Video Player Section -->
                                <div class="content__video__player">
                                    <video id="player" playsinline controls data-poster="">
                                        <source src="<?= $content['ep_url'] ?>" type="video/mp4" />
                                        <!-- Captions are optional -->
                                        <track kind="captions" label="English captions" src="english-captions.vtt" srclang="en" default />
                                        <track kind="captions" label="Vietnamese captions" src="vietnamese-captions.vtt" srclang="vi" />
                                    </video>
                                </div>
                                <div class="content__details__episodes">
                                    <div class="section-title">
                                        <h5>Episodes</h5>
                                    </div>
                                    <?php
                                            $episodes = getEpisodesForSeason($SeasonId);
                                            foreach ($episodes as $episode) {
                                            ?>
                                                <a href="<?= BASE_URL ?>/genre_include/serie-watch.php?serie_watch=<?= $episode['ep_slug'] ?>" class="episode-btn">Ep <?= $episode['episode_number'] ?></a>
                                            <?php
                                            }
                                            ?>
                                </div>

                                <!-- Flags and Quality Section -->
                                <div class="d-flex align-items-center mt-2 mt-md-3">
                                    <?php
                                    $flag = getFlagSerie($SeriesId);
                                    foreach ($flag as $flags) {
                                        ?>
                                        <img src="<?= BASE_URL ?>/uploads/flags/<?=$flags?>" class="img-fluid rounded mr-1" width="40px" alt="">
                                        <?php 
                                    }
                                    ?>
                                <?php
                                    $quality = getQualityForSeries($SeriesId);
                                    foreach ($quality as $qualities) {
                                ?>
                                <span class="badge badge-secondary p-2 ml-2"><?=$qualities?></span> 
                                <?php
                                    }
                                ?>             
                                </div>
                                                
                                <!-- Description Section -->
                                <div class="section-title mt-4">
                                    <h5>Description</h5>
                                    <h6 style="color: white; margin-top: 20px; width: 850px;"><?= stripslashes($seasonData['season_description']); ?></h6>
                                </div>
                                
                                <!-- Tags Section -->
                                <div class="section-title">
                                    <h5>Tags</h5>
                                    <h6 style="color: white; margin-top: 20px;"><?= $seriesData['tags'] ?></h6>
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
                }
            }
     } else {
        echo "Content not found"; // Debugging: Print a message when content is not found
    }
} else {
    echo "Content parameter not set"; // Debugging: Print a message when the content parameter is not set
}
?>
<?php 
include('footer.php');
?>