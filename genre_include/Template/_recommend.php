<section id="top-sale">
    <div class="container py-5" style="width:1100px">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10">
                <div class="section-title">
                    <h4>Trending Now</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 float-left">
                <div class="btn__all">
                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                </div>
            </div>
        </div>
        <hr>

        <!--owl carousel-->
        <div class="owl-carousel owl-theme"> 
        <?php
        $trending = getAllPopular("content"); 
        if (mysqli_num_rows($trending) > 0) 
        {
            foreach ($trending as $item) 
            {
                ?>                       
                        <div class="product__item" style="margin-left:10px; width: 250px !important;">
                            <div class="product__item__pic set-bg" data-setbg="<?= BASE_URL ?>/uploads/movies_poster/<?= $item['img'];?>"  style="width: 230px;">
                                <div class="ep"> <?php
                                    $status = getContentTypeName("status",$item['status_id']); // Replace with the appropriate function

                                    if ($status !== null) {
                                        echo $status;
                                    } else {
                                        echo "No Content Type available";
                                    }
                                    ?></div>
                                <div class="comment"><i class="fa fa-star"></i> <?= $item['score'];?></div>
                                <div class="view"><i class="fa fa-eye"></i> <?= $item['views'];?></div>
                            </div>
                            <div class="product__item__text">
                                <ul>
                                <?php
                                    $genres = getGenreForContent($item['id']);
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
                                <h5><a href="<?= BASE_URL ?>/genre_include/content_details.php?movie=<?= $item['slug'] ?>"><?= stripslashes($item['title']); ?></a></h5>
                            </div>
                        </div>
                        <?php
                }
        } else 
        {
            echo "No records found!";
        }
        ?>           
        </div>
        <!--owl carousel--> 
    </div>
</section>