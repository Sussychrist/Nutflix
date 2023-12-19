<body>
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
            <?php
                    $allSeriesInfo = getAllSeriesInfo();
                    shuffle($allSeriesInfo); 
                    foreach ($allSeriesInfo as $seriesInfo) {
                        $seriesData = $seriesInfo['series'];
                        foreach ($seriesInfo['seasons'] as $seasonData) 
                        {
                    ?>
                <div class="hero__items set-bg" data-setbg="<?= BASE_URL ?>/uploads/serie_wallpaper/seasons_wallpaper/<?= $seasonData['season_wallpaper'];?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <?php
                                $genres = getGenreForSerie($seriesData['id']);
                                $maxGenres = 3; // Set the maximum number of genres to display

                                foreach ($genres as $index => $genre) {
                                    if ($index < $maxGenres) {
                                        echo "<div class='label'>$genre</div>";
                                    } else {
                                        break;
                                    }
                                }

                                if (count($genres) > $maxGenres) {
                                    echo "<div class='label'>...</div>";
                                }
                                ?>
                                <h2><?= stripslashes($seriesData['title']); ?></h2>
                                <p><?= stripslashes($seasonData['season_description']); ?></p>
                                <a href="<?= BASE_URL ?>/genre_include/season_details.php?season=<?= $seasonData['season_slug'] ?>"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                
                ?>
            </div>
        </div>
    </section>