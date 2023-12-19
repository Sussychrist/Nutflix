                    <div class="product__sidebar__comment">
                        <div class="section-title">
                            <h5>New Show</h5>
                        </div>
                        <?php
                            $pop = getAllPopular("content"); 
                            if (mysqli_num_rows($pop) > 0) 
                            {
                                foreach ($pop as $item) 
                                {
                                    ?>
                                <div class="product__sidebar__comment__item">
                                    <div class="product__sidebar__comment__item__pic">
                                        <img src="<?= BASE_URL ?>/uploads/movies_poster/<?= $item['img'];?>" class="img_fluid rounded" width="80px" alt="">
                                    </div>
                                    <div class="product__sidebar__comment__item__text">
                                        <ul>
                                        <?php
                                            $genres = getGenreForContent($item['id']);
                                            $maxGenres = 2; // Set the maximum number of genres to display

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
                                        <span><i class="fa fa-eye"></i> <?= $item['views'];?> Views</span>
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
            </div>
        </div>
    </div>
</section>