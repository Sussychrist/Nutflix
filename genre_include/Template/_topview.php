<div class="col-lg-4 col-md-6 col-sm-8">
    <div class="product__sidebar">
        <div class="product__sidebar__view">
            <div class="section-title">
                <h5>Top Views</h5>
            </div>
            <ul class="filter__controls">
                <li class="active" data-filter="*">Day</li>
                <li data-filter=".week">Week</li>
                <li data-filter=".month">Month</li>
                <li data-filter=".years">Years</li>
            </ul>
            <?php
            $pop = getAllCinema("content"); 
            if (mysqli_num_rows($pop) > 0)
            {
                foreach ($pop as $item) 
                {
                    ?>
                    <div class="filter__gallery">
                        <div class="product__sidebar__view__item set-bg mix day years"
                        data-setbg="<?=BASE_URL?>/uploads/wallpaper/<?=$item['wallpaper']; ?>">
                        <div class="ep"><?php
                            $status = getContentTypeName("status",$item['status_id']); // Replace with the appropriate function

                            if ($status !== null) {
                                echo $status;
                            } else {
                                echo "No Content Type available";
                            }
                            ?></div>
                        <div class="view"><i class="fa fa-eye"></i> <?=$item['score']; ?></div>
                        <h5><a href="<?= BASE_URL ?>/genre_include/content_details.php?movie=<?= $item['slug'] ?>"><?= stripslashes($item['title']); ?></a></h5>
                        </div>
                    </div>
                     <?php
                }
            } else {
                echo "No records found!";
            }
            ?>
        </div>
    </div>
                