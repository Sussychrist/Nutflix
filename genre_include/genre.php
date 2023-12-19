<?php
include('../functions/userfunction.php')
?>
<?php 
include('header.php');
?>
<?php 
include('./Template/_home_slider_movies.php');
?>
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="breadcrumb__links">
                    <a href="<?=BASE_URL?>/index.php"><i class="fa fa-home"></i> Home</a>
                    <a href="./categories.html">Genre</a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 float-left">
                <div class="btn__all">
                    <a href="#" id="backButton" class="primary-btn font-size-20"><i class="fa fa-arrow-left fa-2xl" style="color: #fcfcfd;"></i> Back</a>
                </div>
            </div>  
        </div>
    </div>
</div>
 <!-- Product Section Begin -->
            <section class="product-page spad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="product__page__content">
                                    <div class="product__page__title">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <div class="section-title">
                                                    <h4>Movies</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="product__page__filter">
                                                    <p>Order by:</p>
                                                    <select>
                                                        <option value="">A-Z</option>
                                                        <option value="">1-10</option>
                                                        <option value="">10-50</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <?php
                                        $movies = getContentType("content"); 
                                        if (mysqli_num_rows($movies) > 0) 
                                        {
                                            foreach ($movies as $item) 
                                            {
                                            ?>
                                                <div class="col-lg-4 col-md-6 col-sm-6">
                                                    <div class="product__item">
                                                        <div class="product__item__pic set-bg" data-setbg="<?=BASE_URL?>/uploads/movies_poster/<?=$item['img']; ?>">
                                                            <div class="ep"><?php
                                                                $status = getContentTypeName("status",$item['status_id']); // Replace with the appropriate function

                                                                if ($status !== null) {
                                                                    echo $status;
                                                                } else {
                                                                    echo "No Content Type available";
                                                                }
                                                                ?></div>
                                                            <div class="comment"><i class="fa fa-star"></i> <?=$item['score']; ?></div>
                                                            <div class="view"><i class="fa fa-eye"></i> <?=$item['views']; ?></div>
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
                                                            <h5><a href="<?=BASE_URL?>/genre_include/content_details.php?movie=<?=$item['slug'] ?>"><?= stripslashes($item['title']); ?></a></h5>
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
                                
                                <div class="product__pagination">
                                        <a href="#" class="current-page">1</a>
                                        <a href="#">2</a>
                                        <a href="#">3</a>
                                        <a href="#">4</a>
                                        <a href="#">5</a>
                                        <a href="#"><i class="fa fa-angle-double-right"></i></a>
                                    </div>
                                    
                                </div>
                               
                                <?php
                                    include('./Template/_topview.php');
                                ?>
                                <?php
                                    include('./Template/_new_stuff.php');
                                ?>
                                
                        

<?php 
include('footer.php');
?>