<section id="Trending_season">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 overflow-hidden">
                <div class="iq-main-header d-flex align-items-center justify-content-between">
                    <h4 class="main-title">Watch Now!</h4>
                    <a href="#" class="iq-view-all">View All</a>
                </div>
                <!--owl carousel-->
                <div class="owl-carousel owl-theme"> 
                    <?php
                    $allSeriesInfo = getAllSeriesInfo();
                    shuffle($allSeriesInfo); 
                    foreach ($allSeriesInfo as $seriesInfo) {
                        $seriesData = $seriesInfo['series'];
                        foreach ($seriesInfo['seasons'] as $seasonData) 
                        {
                    ?>
                            <div class="product__item" style="margin-left:10px;">
                                <div class="product__sidebar__view__item set-bg" data-setbg="<?= BASE_URL ?>/uploads/serie_wallpaper/seasons_wallpaper/<?= $seasonData['season_wallpaper'];?>" style="width: 400px;">
                                    <div class="ep">
                                        <?php
                                            echo countEpisodes($seasonData['season_id']) . '/' . $seasonData['season_eps'];
                                        ?>
                                    </div>
                                    <div class="view"><i class="fa fa-eye"></i> <?= $seriesData['total_view'];?></div>
                                    <div class="flag"> <?php
                                    $flag = getFlagSerie($seriesData['id']);
                                    foreach ($flag as $flags) {
                                        ?>
                                        <img src="<?= BASE_URL ?>/uploads/flags/<?=$flags?>" class="img-fluid rounded" style="max-width: 40px;" alt="">
                                        <?php 
                                    }
                                    ?></div>
                                </div>
                                <div class="product__item__text">
                                    <ul>
                                        <?php 
                                        $genres = getGenreForSerie($seriesData['id']);
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
                                <h6><a href="<?= BASE_URL ?>/genre_include/season_details.php?season=<?= $seasonData['season_slug'] ?>"><?= stripslashes($seriesData['title']); ?> Season (<?= $seasonData['season_number'];?>)</a></h6>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <!--owl carousel--> 
            </div>
        </div>
    </div>
</section>

