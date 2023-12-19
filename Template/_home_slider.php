
<?php
include('./functions/custom.php');
?>
<!-- Define your styles in the head of your HTML or in a separate CSS file -->
</style>
<!-- slider starts  -->
  <section id="home" class="iq-main-slider p-0 mb-4">
    <div id="home-slider" class="slider m-0 p-0">
    <?php
            $home = getAllPopular("content"); 
            if (mysqli_num_rows($home) > 0) 
            {
                foreach ($home as $item) 
                {
                    ?>
                      <div class="slide slick-bg s-bg-1" style="background-image: url(<?= BASE_URL ?>/uploads/wallpaper/<?= $item['wallpaper'];?>);">             
                        <div class="container-fluid position-relative h-100">
                          <div class="slider-inner h-100">
                            <div class="row align-items-center h--100">
                              <div class="col-xl-6 col-lg-12 col-md-12">
                                <a href="javascript:void(0)">
                                  <div class="channel-logo" data-animation-in="fadeInLeft" data-delay-in="0.1">
                                    <img src="images/logo-no-background.png" class="c-logo" alt="" />
                                  </div>
                                </a>
                                <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft" data-delay-in="0.6" style="font-size: 45px;">
                                    <?= stripslashes($item['title']); ?>
                                </h1>
                                <div class="d-flex flex-wrap align-items-center fadeInLeft animated" data-animation-in="fadeInLeft"
                                  style="opacity: 1">
                                  <div class="slider-ratting d-flex align-items-center mr-4 mt-2 mt-md-3">
                                    <ul
                                      class="ratting-start p-0 m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                                      <li><i class="fa fa-star"></i></li>
                                      <li><i class="fa fa-star"></i></li>
                                      <li><i class="fa fa-star"></i></li>
                                      <li><i class="fa fa-star"></i></li>
                                      <li><i class="fa fa-star-half"></i></li>
                                    </ul>
                                    <span class="text-white ml-2"><?= $item['score'] ?>(imbd)</span>
                                  </div>
                                  <div class="d-flex align-items-center mt-2 mt-md-3">
                                     <?php
                                        $flag = getFlag($item['id']);
                                        foreach ($flag as $flags) {
                                            ?>
                                            <img src="<?= BASE_URL ?>/uploads/flags/<?=$flags?>" class="img-fluid rounded" width="40px" alt="">
                                            <?php 
                                        }
                                      ?>
                                   <?php
                                      $quality = getQualityForMovie($item['id']);
                                      foreach ($quality as $qualities) {
                                    ?>
                                    <span class="badge badge-secondary p-2 ml-2"><?=$qualities?></span> 
                                    <?php
                                     }
                                    ?>             
                                    <span class="ml-3"><?= $item['duration'];?></span>
                                  </div>
                                </div>
                                <p data-animation-in="fadeInUp">
                                <?= stripslashes($item['description']); ?>
                                </p>
                                <div class="trending-list" data-animation-in="fadeInUp" data-delay-in="1.2">
                                  <div class="text-primary title starring">
                                    Actors :
                                    <span class="text-body"><?= $item['actor']; ?></span>
                                  </div>
                                  <div class="text-primary title starring">
                                    Director :
                                    <span class="text-body"><?= $item['director']; ?></span>
                                  </div>
                                  <div class="text-primary title genres">
                                    Genres : <span class="text-body">
                                                  <?php
                                                    $genres = getGenreForContent($item['id']);
                                                    echo implode(', ', $genres);
                                                  ?>
                                            </span>
                                  </div>
                                  <div class="text-primary title tag">
                                    Tags :
                                    <span class="text-body"><?= $item['tags']; ?></span>
                                  </div>
                                </div>
                                <div class="d-flex align-items-center r-mb-23 mt-4" data-animation-in="fadeInUp" data-delay-in="1.2">
                                  <a href="<?=BASE_URL?>/genre_include/watch.php?movie=<?=$item['slug'] ?>" class="btn btn-hover iq-button"><i class="fa fa-play mr-3"></i>Play Now</a>
                                  <a href="<?=BASE_URL?>/genre_include/content_details.php?movie=<?=$item['slug'] ?>" class="btn btn-link">More Details</a>
                                </div>
                              </div>
                              <div class="col-xl-5 col-lg-6 col-md-6 trailor-video">
                                <a href="<?= $item['trailer_url'];?>" class="video-open playbtn">
                                  <img src="images/play.png" class="play" alt="" />
                                  <span class="w-trailor">Watch Trailer</span>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php
                }
            } 
            else {
                echo "No records found!";
            }
        ?>
    </div>
  </section>
