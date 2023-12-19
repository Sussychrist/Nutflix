<?php
include('../functions/userfunction.php')
?>
<?php 
include('header.php');
?>
<?php
if(isset($_GET['movie']))
{
    $content_slug = $_GET['movie'];
    $content_data = getSlugActive("content", $content_slug);
    $content = mysqli_fetch_array($content_data);
    if($content)
    { ?>
    
        <section class="content-details spad">   
            <?php 
            include ('../genre_include/Template/_bread_crumb_option.php');
            ?>
                    <div class="container">
                       <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <div class="section-title">
                                    <h5 style="font-size:30px; color:white;"> <?= stripslashes($content['title']); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="content__video__player">
                                    <video id="player" playsinline controls data-poster="<?=BASE_URL?>/uploads/wallpaper/<?=$content['wallpaper']?>">
                                        <source src="<?=$content['video_url']?>" type="video/mp4" />
                                        <!-- Captions are optional -->
                                        <track kind="captions" label="English captions" src="english-captions.vtt" srclang="en" default />
                                        <track kind="captions" label="Vietnamese captions" src="vietnamese-captions.vtt" srclang="vi" />
                                    </video>
                                </div>
                                <div class="content__details__episodes">
                                        <div class="d-flex align-items-center mt-2 mt-md-3">
                                            <?php
                                            $flag = getFlag($content['id']);
                                            foreach ($flag as $flags) {
                                                ?>
                                                <img src="<?= BASE_URL ?>/uploads/flags/<?=$flags?>" class="img-fluid rounded mr-1" width="40px" alt="">
                                                <?php 
                                            }
                                            ?>
                                        <?php
                                            $quality = getQualityForMovie($content['id']);
                                            foreach ($quality as $qualities) {
                                        ?>
                                        <span class="badge badge-secondary p-2 ml-2"><?=$qualities?></span> 
                                        <?php
                                            }
                                        ?>             
                                        </div>
                                     
                                        <div class="section-title mt-4">
                                            <h5>Description</h5>
                                             <h6 style="color:white; margin-top:20px; width: 850px;"><?= stripslashes($content['description']); ?></h6>
                                        </div>
                                        <div class="section-title">
                                            <h5>Tags</h5>
                                             <h6 style="color:white; margin-top:20px;"><?=$content['tags']?></h6>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
                        <?php
                        include('./Template/_comment.php');
                        ?>
                        <?php
                            include('./Template/_suggestion.php');
                        ?>
                         <?php
                            include('./Template/_recommend.php');
                        ?>
                        <?php
     } else {
        echo "Content not found"; // Debugging: Print a message when content is not found
    }
} else {
    echo "Content parameter not set"; // Debugging: Print a message when the content parameter is not set
}
?>
<?php 
include('footer.php');
?>