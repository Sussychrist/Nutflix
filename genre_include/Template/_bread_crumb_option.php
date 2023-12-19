<div class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="breadcrumb__links">
                            <a href="<?=BASE_URL?>/index.php"><i class="fa fa-home"></i> Home</a>
                            <a href="./categories.html">Genre</a>
                            <?php
                               $genres = getGenreForContent($content['id']);
                               foreach ($genres as $genreList) {
                                   echo "<a>$genreList</a>";
                               }
                            ?>
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