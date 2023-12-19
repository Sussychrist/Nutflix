<body>
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
            <?php
                $movies = getAll("content"); 
                if (mysqli_num_rows($movies) > 0) 
                {
                    foreach ($movies as $item) 
                    {
                    ?>
                <div class="hero__items set-bg" data-setbg="<?=BASE_URL?>/uploads/wallpaper/<?=$item['wallpaper']?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <?php
                                $genres = getGenreForContent($item['id']);
                                $maxGenres = 3; // Set the maximum number of genres to display

                                foreach ($genres as $index => $genre) {
                                    if ($index < $maxGenres) {
                                        echo "<div class='label'>$genre</div>";
                                    } else {
                                        break;
                                    }
                                }

                                if (count($genres) > $maxGenres) {
                                    echo "<div class='label'>...</div>";
                                }
                                ?>
                                <h2><?= stripslashes($item['title']); ?></h2>
                                <p><?= stripslashes($item['description']); ?></p>
                                <a href="<?=BASE_URL?>/genre_include/content_details.php?movie=<?=$item['slug'] ?>"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
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
    </section>