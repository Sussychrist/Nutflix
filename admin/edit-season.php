<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>
<head>
<link id="pagestyle" href="assets/css/material-dashboard.min.css" rel="stylesheet" />
<link id="pagestyle" href="assets/css/custom.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<div class="container">
<?php 
    if(isset($_GET['season_id']))
    {       
        $SeasonId = $_GET['season_id'];

        $season = getSeasonId("season",$SeasonId);
        
        if(mysqli_num_rows($season) > 0)
        {
            $data = mysqli_fetch_array($season);             
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Season
                            <a href="#" id="backButton" class="btn btn-primary float-end"><i class="fa fa-arrow-left fa-2xl" style="color: #fcfcfd;"></i> Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">        
                                <div class="row">
                                    <input type="hidden" name ="series_id" value="<?=$data['series_id']; ?>">
                                    <input type="hidden" name ="season_id" value="<?=$data['season_id']; ?>">
                                    <div class="col-md-5">
                                        <label for="name">Season Number</label>
                                        <input type="text" required name="season" value="<?= $data['season_number'];?>" id="season_number"  placeholder="Enter Movie Title" class="form-control">
                                    </div>
                                    <input type="hidden" required name="slug" value="<?= $data['season_slug']; ?> " id="season_slug" placeholder="Enter slug" class="form-control">
                                    <div class="col-md-5">
                                        <label for="release_year">Release Year</label>
                                        <input type="text" required name="release_year" value="<?= $data['season_release_year'] ?>" placeholder="Enter release year" class="form-control">
                                    </div>
                                    <div class="col-md-10">
                                        <label for="description">Description</label>
                                        <textarea rows="5" required name="description" placeholder="Enter description" class="form-control"><?= stripslashes($data['season_description']); ?></textarea>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="image">Upload Poster</label>
                                        <div class="image-upload">
                                            <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this);">
                                            <i class="fa fa-picture-o"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="old_image">Current Poster</label>
                                             <input type="hidden" name="old_image" value="<?= $data['season_img'];?>" class="form-control"/>
                                            <div class="square-image-container">
                                                <img src="../uploads/serie_poster/seasons_poster/<?= $data['season_img'] ?>" />
                                            </div>
                                        </div>
                                    <div class="col-md-5">
                                        <label for="wallpaper" class="mt-3" >Upload Wallpaper</label>
                                        <div class="wallpaper-upload">
                                            <input type="file"  name="wallpaper" id="wallpaper" class="form-control" accept="image/*" onchange="previewWallpaper(this);">
                                            <i class="fa fa-picture-o"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                    <label for="old_wallpaper" class="mt-3">Current Wallpaper</label>
                                        <input type="hidden" name="old_wallpaper" value="<?= $data['season_wallpaper'] ?>"  class="form-control" />
                                        <div class="square-wallpaper-container">
                                            <img src="../uploads/serie_wallpaper/seasons_wallpaper/<?= $data['season_wallpaper'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="mt-3" for="season_eps">Season Episodes</label>
                                        <input type="number" required name="season_episode" value="<?= $data['season_eps'] ?>" placeholder="Enter number of Episodes" class="form-control" style="width: 240px;">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="mt-4">Select Status </label>
                                            <?php 
                                                $status = getAll("status");
                                                if(mysqli_num_rows($status)> 0)
                                                {
                                                    foreach($status as $item)
                                                    {
                                                        ?>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="status_<?=$item['id']?>" name="status_id" value="<?=$item['id']?>"<?=$data['season_status_id'] == $item['id'] ? 'checked' : ''?>>
                                                                <label class="form-check-label" for="status_<?=$item['id']?>" style="display: inline-block; margin-left: 3px;"><?=$item['name']?></label>
                                                            </div>
                                                        <?php
                                                    }
                                                }
                                                else
                                                {
                                                    echo "No Status  available";
                                                }
                                                
                                            ?>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="mt-3" for="score">Critic Score</label>
                                        <input type="number" required name="score" value="<?= $data['season_score'] ?>" placeholder="/10" class="form-control" min="1" max="10" step="0.5" style="width: 100px;">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="update_season_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        else
        {
            echo "Product not found for given id";
        }
    }
    else
    {
        echo "Id missing from url";
    }

?>
</div>
<?php
include('includes/footer.php');
?>