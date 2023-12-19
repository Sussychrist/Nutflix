<section id="iq-topten">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 overflow-hidden">
            <div class="topten-contents">
              <h4 class="main-title iq-title topten-title">
                Trending Movies
              </h4>
              <ul id="top-ten-slider" class="list-inline p-0 m-0 d-flex align-items-center">
              <?php
                  $trending = getAllPopularOrder("title"); 
                  if (mysqli_num_rows($trending) > 0) 
                  {
                      foreach ($trending as $item) 
                      {
                        $wallpaperSrc = BASE_URL . "/uploads/wallpaper/" . $item['wallpaper'];
                          ?>
                            <li class="slick-bg">
                              <a href="<?=BASE_URL?>/genre_include/watch.php?movie=<?=$item['slug']; ?>">
                                <img src="<?= $wallpaperSrc; ?>" class="img-fluid w-100" alt="" />
                                <h6 class="iq-title"><a href="<?=BASE_URL?>/genre_include/watch.php?movie=<?=$item['slug']; ?>"><?= stripslashes($item['title']); ?></a></h6>
                              </a>
                            </li>
                            <?php
                      }
                  } 
                  else {
                      echo "No records found!";
                  }
              ?>
        
              </ul>
              <div class="vertical_s">
                <ul id="top-ten-slider-nav" class="list-inline p-0 m-0 d-flex align-items-center">
                <?php
                  $trending = getAllPopularOrder("title"); 
                  if (mysqli_num_rows($trending) > 0) 
                  {
                      foreach ($trending as $item) 
                      {
                        $wallpaperSrc = BASE_URL . "/uploads/wallpaper/" . $item['wallpaper'];
                          ?>
                          <li>
                            <div class="block-images position-relative">
                              <a href="<?=BASE_URL?>/genre_include/watch.php?movie=<?=$item['slug']; ?>">
                                <img src="<?= $wallpaperSrc;?>" class="img-fluid w-md-100"  width="2560" height="1440" alt="" />
                              </a>
                              <div class="block-description">
                                <h5><?= stripslashes($item['title']); ?></h5>
                                <div class="movie-time d-flex align-items-center my-2">
                                <?php
                                      $qualities = getQualityForMovie($item['id']);
                                      $maxQuality = 1; // Set the maximum number of genres to display

                                      foreach ($qualities as $index => $quality) {
                                          if ($index < $maxQuality) {
                                              echo '<div class="badge badge-secondary p-1 mr-2">'. $quality. '</div>';
                                          } else {
                                              break;
                                          }
                                      }
                                      if (count($qualities) > $maxQuality) {
                                          echo '<div class="badge badge-secondary p-1 mr-2">...</div>';
                                      }
                                      ?>
                                  <span class="text-white"><?=$item['duration']; ?></span>
                                </div>
                                <div class="hover-buttons">
                                  <a href="<?=BASE_URL?>/genre_include/watch.php?movie=<?=$item['slug']; ?>" class="btn btn-hover" tabindex="0">
                                    <i class="fa fa-play mr-1" aria-hidden="true"></i>
                                    Play Now
                                  </a>
                                </div>
                              </div>
                            </div>
                              </li>
                           <?php
                      }
                  } 
                  else {
                      echo "No records found!";
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>