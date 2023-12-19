    <div class="col-md-4">
            <div class="section-title">
                <h5>Popular Right Now</h5>
            </div>
            <div class="content__details__sidebar" style="max-height: 620px; overflow: auto;">
            <?php
            $pop = getAllPopular("content"); 
            if (mysqli_num_rows($pop) > 0) {
                foreach ($pop as $item) {
                    ?>
                    
                    <div class="product__sidebar__view__item set-bg" data-setbg="<?= BASE_URL ?>/uploads/wallpaper/<?= $item['wallpaper'];?>">
                        <div class="ep">
                            <?php
                            $status = getContentTypeName("status",$item['status_id']); // Replace with the appropriate function

                            if ($status !== null) {
                                echo $status;
                            } else {
                                echo "No Content Type available";
                            }
                            ?>
                        </div>
                        <div class="view"><i class="fa fa-eye"> </i> <?= $item['views']?></div>
                        <h5><a href="<?= BASE_URL ?>/genre_include/content_details.php?movie=<?= $item['slug'] ?>"><?= stripslashes($item['title']); ?></a></h5>
                        <div class="flag"> <?php
                                        $flag = getFlag($item['id']);
                                        foreach ($flag as $flags) {
                                            ?>
                                            <img src="<?= BASE_URL ?>/uploads/flags/<?=$flags?>" class="img-fluid rounded" width="40px" alt="">
                                            <?php 
                                        }
                                      ?></div>
                    </div>
                    <?php
                }
            } else {
                echo "No records found!";
            }
            ?>
        </div>
    </div>
</div>
</section>