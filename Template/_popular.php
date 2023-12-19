
 <!-- upcoming contents section starts  -->
 <section id="iq-upcoming-movie">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 overflow-hidden">
          <div class="iq-main-header d-flex align-items-center justify-content-between">
            <h4 class="main-title">Popular Movies</h4>
            <a href="#" class="iq-view-all">View All</a>
          </div>
          <div class="favorite-contens">
            <ul class="favorites-slider list-inline row p-0 mb-0">
              <!-- slide item 1 -->
              <?php
                $popular = getAllPopular("content"); 
                if (mysqli_num_rows($popular) > 0) 
                {
                    foreach ($popular as $item) 
                    {
                        ?>
                          <li class="slide-item">
                            <div class="block-images position-relative">
                              <div class="img-box" >
                                <img src="<?= BASE_URL ?>/uploads/wallpaper/<?= $item['wallpaper'];?>" class="img-fuid"  width="300" height="168" alt="" />
                              </div>
                              <div class="block-description">
                                <h6 class="iq-title">
                                  <a href="<?=BASE_URL?>/genre_include/content_details.php?movie=<?=$item['slug'] ?>"><?= stripslashes($item['title']); ?> </a>
                                </h6>
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
                                  <span class="text-white"><?= $item['duration'];?></span>
                                </div>
                                <div class="hover-buttons">
                                    <a href="<?=BASE_URL?>/genre_include/watch.php?movie=<?=$item['slug'] ?>" class="btn btn-hover iq-button">
                                      <i class="fa fa-play mr-1"></i>
                                      Play Now
                                    </a>
                                </div>
                              </div>
                              <div class="block-social-info">
                                <ul class="list-inline p-0 m-0 music-play-lists">
                                  <li class="share">
                                    <span><i class="fa fa-share-alt"></i></span>
                                    <div class="share-box">
                                      <div class="d-flex align-items-center">
                                      <!-- <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                      <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                      <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>-->
                                      </div>
                                    </div>
                                  </li>
                                  <li>
                                    <span><i class="fa fa-eye"></i></span>
                                    <span class="count-box"><?= $item['views'];?></span>
                                  </li>
                                  <li>
                                    <span><i class="fa fa-plus"></i></span>
                                  </li>
                                </ul>
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
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</section>
    <!-- upcoming contents section ends -->