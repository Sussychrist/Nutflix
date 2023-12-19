<section id="Top-series">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 overflow-hidden">
                <div class="iq-main-header d-flex align-items-center justify-content-between">
                    <h4 class="main-title">Popular Series</h4>
                    <a href="#" class="iq-view-all">View All</a>
                </div>
                <!--owl carousel-->
                <div class="owl-carousel owl-theme"> 
                    <?php
                    $allSeriesInfo = getAll("series");
                    if (mysqli_num_rows($allSeriesInfo) > 0) {
                        $shuffledSeries = shuffleSeries($allSeriesInfo);
                        foreach ($shuffledSeries as $seriesData) {
                            ?>
                            <div class="product__item" style="margin-left:10px; width: 250px !important;">
                                <div class="product__item__pic set-bg" data-setbg="<?= BASE_URL ?>/uploads/serie_poster/<?= $seriesData['img'];?>"  style="width: 200px;">
                                    <div class="ep"><?php
                                        $status = getSerieTypeName($seriesData['status_id']);
                                        if ($status !== null) {
                                            echo $status;
                                        } else {
                                            echo "No Content Type available";
                                        }
                                        ?></div>
                                    <div class="comment"><i class="fa fa-star"></i> <?= $seriesData['score'];?></div>
                                    <div class="view"><i class="fa fa-eye"></i> <?= $seriesData['total_view'];?></div>
                                </div>
                                <div class="product__item__text">
                                    <ul>
                                        <?php 
                                        $genres = getGenreForSerie($seriesData['id']);
                                        $maxGenres = 3; 

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
                                    <h5><a href="<?= BASE_URL ?>/genre_include/serie_details.php?series=<?= $seriesData['slug'] ?>"><?= stripslashes($seriesData['title']); ?></a></h5>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No records found!";
                    }

                    function shuffleSeries($allSeriesInfo) {
                        $shuffledSeries = [];
                        while ($row = mysqli_fetch_assoc($allSeriesInfo)) {
                            $shuffledSeries[] = $row;
                        }
                        shuffle($shuffledSeries);
                        return $shuffledSeries;
                    }
                    ?>
                </div>
                <!--owl carousel--> 
            </div>
        </div>
    </div>
</section>
