 <!-- trending section  -->
 <section id="iq-trending" class="s-margin">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 overflow-hidden">
            <div class="iq-main-header d-flex align-items-center justify-content-between">
              <h4 class="main-title">Trending Series</h4>
            </div>
              <div class="trending-contens">
                  <ul id="trending-slider-nav" class="list-inline p-0 mb-0 row align-items-center">
                  <?php
                    $allSeriesInfo = getAll("series");
                    if (mysqli_num_rows($allSeriesInfo) > 0) 
                    {
                    foreach ($allSeriesInfo as $seriesData) 
                    {
                            ?>   
                          <li  class="slide-item">
                            <div class="block-images position-relative">
                                  <div class="movie-slick position-relative ">
                                  <div class="img-box" >
                                      <img src="<?= BASE_URL ?>/uploads/serie_wallpaper/<?= $seriesData['wallpaper']; ?>" class="img-fluid" alt="">
                                  </div>
                                  </div>
                                  <div class="block-description">
                                  <h6 class="iq-title">
                                    <a href="#"><?= stripslashes($seriesData['title']); ?> </a>
                                  </h6>
                                  <div class="movie-time d-flex align-items-center my-2">
                                  <?php
                                        $qualities = getQualityForseries($seriesData['id']);
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
                                    <span class="text-white"><?= $seriesData['duration_per_ep'];?></span>
                                  </div>
                                  <div class="hover-buttons">
                                      <a href="<?= BASE_URL ?>/genre_include/serie_details.php?series=<?= $seriesData['slug'] ?>" class="btn btn-hover iq-button">
                                        <i class="fa fa-play mr-1"></i>
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
 <!-- trending section  -->
              <ul id="trending-slider" class="list-inline p-0 m-0 d-flex align-items-center">
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>