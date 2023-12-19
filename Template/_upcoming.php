
<?php
$cinema = getAllCinema("content"); 
if (mysqli_num_rows($cinema) > 0) 
{
?>

<!-- Start of Carousel -->
<div id="cinemaCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">

    <?php
    $firstItem = true; // To set the first item as active
    foreach ($cinema as $index => $item) {
      $activeClass = $firstItem ? 'active' : '';
    ?>
          <div class="carousel-item <?= $activeClass ?>">
          <!-- parallax section  -->
              <section id="parallex" class="parallax-window" style="background-image: url(<?= BASE_URL ?>/uploads/wallpaper/<?= $item['wallpaper'];?>);">
                <div class="container-fluid h-100">
                  <div class="row align-items-center justify-content-center h-100 parallaxt-details">
                    <div class="col-lg-4 r-mb-23">
                      <div class="text-left">
                        <a href="javascript:void(0)">
                          <h1 class="parallax-heading"><?= stripslashes($item['title']); ?></h1>
                        </a>
  
                        <div class="parallax-ratting d-flex align-items-center mt-3 mb-3">
                          <ul
                            class="ratting-start p-o m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                            <li>
                              <a href="#" class="text-primary"><i class="fa fa-star"></i></a>
                            </li>
                            <li>
                              <a href="#" class="text-primary"><i class="pl-2 fa fa-star"></i></a>
                            </li>
                            <li>
                              <a href="#" class="text-primary"><i class="pl-2 fa fa-star"></i></a>
                            </li>
                            <li>
                              <a href="#" class="text-primary"><i class="pl-2 fa fa-star"></i></a>
                            </li>
                            <li>
                              <a href="#" class="text-primary"><i class="pl-2 fa fa-star-half-o"></i></a>
                            </li>
                          </ul>
                          <span class="text-white ml-3"><?=$item['score']?>(Imbd)</span>
                        </div>
                        <div class="movie-time d-flex align-items-center mb-3">
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
                          <span class="text-white"><?=$item['duration']?></span>
                        </div>
                        <p>
                        <?= stripslashes($item['description']); ?>
                        </p>
                        <div class="parallax-buttons">
                          <a href="<?=BASE_URL?>/genre_include/watch.php?movie=<?=$item['slug']; ?>" class="btn btn-hover">Watch Trailer</a>
                          <a href="<?=BASE_URL?>/genre_include/content_details.php?movie=<?=$item['slug']; ?>" class="btn btn-link">More Details</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="parallax-img">
                        <a href="<?=BASE_URL?>/genre_include/content_details.php?movie=<?=$item['slug']; ?>"><img src="<?= BASE_URL ?>/uploads/wallpaper/<?= $item['wallpaper'];?>" alt="" class="img-fluid w-100" /></a>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              </div>
              <?php
      $firstItem = false;
    }
    ?>
</div>
 <!-- Carousel Controls -->
 <a class="carousel-control-prev" href="#cinemaCarousel" role="button" data-slide="prev"  style="width: 100px ; height: 100px" >
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  </a>
  <style>
  /* Custom CSS to adjust carousel controls position */
  .carousel-control-prev, .carousel-control-next {
    top: 50%; /* Adjust the vertical position */
    transform: translateY(-50%); /* Vertically center the controls */
  }
</style>
  <a class="carousel-control-next" href="#cinemaCarousel" role="button" data-slide="next"  style="width: 100px ; height: 100px">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
  </a>
</div>
<?php
} else {
  echo "No records found!";
}
?>