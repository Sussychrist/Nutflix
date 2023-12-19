<section id="season">
<link rel="stylesheet" href="../css/custom.css" type="text/css">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10">
                <div class="section-title">
                    <h4>Serie's Season</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 float-left">
            <div class="btn__all">
                    <a href="#" class="primary-btn float-end">View All <span class="arrow_right"></span></a>
                </div>
            </div>
        </div>
                <!--owl carousel-->
                <div class="owl-carousel owl-theme" style="margin-bottom:20px;"> 
                    <?php
                    $seasons = getAllSeasonsForSeries($SeriesId);
                    if ($seasons) {
                        foreach ($seasons as $season) {
                    ?>
                            <div class="product__item" style="margin-left:10px;">
                                <div class="product__sidebar__view__item set-bg" data-setbg="<?= BASE_URL ?>/uploads/serie_wallpaper/seasons_wallpaper/<?= $season['season_wallpaper'];?>" style="width: 350px;">
                                    <div class="ep">
                                        <?php
                                            echo countEpisodes($season['season_id']) . '/' . $season['season_eps'];
                                        ?>
                                    </div>
                                    <div class="view"><i class="fa fa-eye"></i> <?= $season['views'];?></div>
                                </div>
                                <h5><a href="<?= BASE_URL ?>/genre_include/season_details.php?season=<?= $season['season_slug'] ?>" style="color: white;"><?= stripslashes($title); ?> Season (<?= $season['season_number'];?>)</a></h5>
                            </div>
                    <?php
                        }
                    }
                    ?>
              </div>
        <!--owl carousel--> 
</section>

