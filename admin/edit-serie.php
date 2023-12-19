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
    <div class="row">
        <div class="col-md-12">
        <?php 
                if(isset($_GET['id']))
                {       
                    $id = $_GET['id'];

                    $serie = getId("series",$id);
                    
                    if(mysqli_num_rows($serie)>0)
                    {
                        $data = mysqli_fetch_array($serie);             
                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Serie
                                    <a href="series.php" class="btn btn-primary float-end">Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">        
                                        <div class="row">
                                        <div class="col-md-10">
                                                <label>Select Genre</label>
                                                <?php 
                                                    $genre = getOrderAll($con, "genre", "name ASC"); 
                                                    if (mysqli_num_rows($genre) > 0) 
                                                    {
                                                        // Retrieve the selected genre IDs for the movie
                                                        $selectedGenres = getSelectedStuff("series", $data['id'] , "serie_genre", "genre_id");
                                                        foreach ($genre as $item) 
                                                        {
                                                            // Check if the genre should be pre-selected
                                                            $isChecked = in_array($item['id'], $selectedGenres) ? 'checked' : '';
                                                            ?>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="genre_<?=$item['id']?>" name="genre_id[]" value="<?=$item['id']?>" <?=$isChecked?>>
                                                                <label class="form-check-label" for="genre_<?=$item['id']?>" style="display: inline-block; margin-left: 10px;"><?=$item['name']?></label>
                                                            </div>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo "No Genre available";
                                                    }
                                                ?>
                                            </div>         
                                            <div class="col-md-5">
                                                <label>Select Content Type </label>
                                                <select name ="content_type_id" class="form-select mb-2" >
                                                    <option selected>Content Type</option>
                                                    <?php 
                                                        $content_type = getAll("content_type");
                                                        if(mysqli_num_rows($content_type)> 0)
                                                        {
                                                            foreach($content_type as $item)
                                                            {
                                                               ?>
                                                               <option value="<?=$item['id'] ?>" <?=$data['content_type_id'] == $item['id']?'selected':''?>><?=$item['name'] ?></option>
                                                               <?php
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo "No Content Type available";
                                                        }
                                                        
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <label>Select Quality </label>
                                                    <?php 
                                                        $quality = getAll("quality");
                                                        if(mysqli_num_rows($quality)> 0)
                                                        {
                                                                $selectedQuality = getSelectedStuff("series", $data['id'] , "serie_quality", "quality_id");
                                                                foreach($quality as $item)
                                                                {
                                                                    $isChecked = in_array($item['id'], $selectedQuality) ? 'checked' : '';
                                                                    ?>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox" id="quality_<?=$item['id']?>" name="quality_id[]" value="<?=$item['id']?>" <?=$isChecked?>>
                                                                            <label class="form-check-label" for="quality_<?=$item['id']?>" style="display: inline-block; margin-left: 10px;"><?=$item['name']?></label>
                                                                        </div>
                                                                    <?php
                                                                }                                                            
                                                        }else
                                                            {
                                                                echo "No Quality available";
                                                            }    
                                                    ?>
                                            </div>
                                            <div class="col-md-10">
                                                <label>Select Region</label>
                                                    <?php 
                                                        $region = getOrderAll($con, "countries", "name ASC"); 
                                                        if(mysqli_num_rows($region) > 0) 
                                                        {
                                                            $selectedRegion = getSelectedStuff("series", $data['id'] , "serie_country", "country_id");
                                                            foreach($region as $item)
                                                            
                                                            {
                                                                $isChecked = in_array($item['id'], $selectedRegion) ? 'checked' : '';
                                                                ?>
                                                                    <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox" id="countries_<?=$item['id']?>" name="countries_id[]" value="<?=$item['id']?>" onclick="limitRegions()"<?=$isChecked?>>
                                                                        <img src="../uploads/flags/<?= $item['flag']; ?>" width="50px" alt="<?= $item['flag']; ?>">
                                                                        <label class="form-check-label" for="countries_<?=$item['id']?>" style="display: inline-block; margin-left: 10px;"><?=$item['name']?></label>
                                                                    </div>
                                                                <?php
                                                            }
                                                        }
                                                        else {
                                                            echo "No countries available";
                                                        }
                                                    ?>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="hidden" name ="serie_id" value="<?=$data['id']; ?>">
                                                <label class="mt-2" for="name">Title</label>
                                                <input type="text" required name="title" value="<?= stripslashes($data['title']); ?>"  placeholder="Enter Movie Title" class="form-control">
                                            </div>
                                            <div class="col-md-5">
                                                <label class="mt-2" for="slug">Slug</label>
                                                <input type="text" required name="slug" value="<?= $data['slug'] ?>" placeholder="Enter slug" class="form-control">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="tags">Tags</label>
                                                <input type="text" required name="tags" value="<?= $data['tags'] ?>" placeholder="Enter Tags" class="form-control">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="release_year">Release Year</label>
                                                <input type="text" required name="release_year" value="<?= $data['release_year'] ?>" placeholder="Enter release year" class="form-control">
                                            </div>
                                            <div class="col-md-10">
                                                <label for="description">Description</label>
                                                <textarea rows="5" required name="description" placeholder="Enter description" class="form-control"><?= stripslashes($data['description']); ?></textarea>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="actor">Actors</label>
                                                <input type="text" required name="actor" value="<?= $data['actor'] ?>" placeholder="Enter Actors" class="form-control">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="creator">Creator</label>
                                                <input type="text" required name="creator" value="<?= $data['creator'] ?>" placeholder="Enter creators" class="form-control">
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
                                                <input type="hidden" name="old_image" value="<?= $data['img'] ?>"  class="form-control"/>
                                                <div class="square-image-container">
                                                    <img src="../uploads/serie_poster/<?= $data['img'] ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="wallpaper">Upload Wallpaper</label>
                                                <div class="wallpaper-upload">
                                                    <input type="file" name="wallpaper" id="wallpaper" class="form-control" accept="image/*" onchange="previewWallpaper(this);">
                                                    <i class="fa fa-picture-o"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                            <label for="old_wallpaper">Current Wallpaper</label>
                                                <input type="hidden" name="old_wallpaper" value="<?= $data['wallpaper'] ?>"  class="form-control" />
                                                <div class="square-wallpaper-container">
                                                    <img src="../uploads/serie_wallpaper/<?= $data['wallpaper'] ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="trailer" class="mt-3">Enter Trailer URL</label>
                                                <div class="trailer-preview">
                                                    <video id="trailer-player" controls></video>
                                                </div>
                                                <input type="text" name="trailer" id="trailer" class="form-control" placeholder="Enter new trailer URL" onchange="previewTrailer(this);">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="old_trailer" class="mt-3">Current Trailer URL</label>
                                                <input type="text" hidden name="old_trailer" id="old_trailer" class="form-control" value="<?= $data['trailer_url'] ?>" placeholder="Enter the trailer URL" onchange="previewTrailer(this);">
                                                <div class="trailer-preview">
                                                    <video id="trailer-player" controls><source src="<?= $data['trailer_url'] ?>" type="video/mp4"></video>
                                                </div>
                                            </div>                                  
                                            <div class="col-md-5">
                                                <label class="mt-3" for="subtitle">Subtitle</label>
                                                <input type="text" required name="subtitle" value="<?= $data['subtitle'] ?>" placeholder="Enter subtitle" class="form-control">
                                            </div>
                                            <div class="col-md-5">
                                                <label class="mt-3" for="subtitle">Duration/Episode</label>
                                                <input type="text" required name="duration" value="<?= $data['duration_per_ep'] ?>" placeholder="/Episode" class="form-control">
                                            </div>
                                            <div class="col-md-8">
                                                <label>Select Status </label>
                                                    <?php 
                                                        $status = getAll("status");
                                                        if(mysqli_num_rows($status)> 0)
                                                        {
                                                            foreach($status as $item)
                                                            {
                                                                ?>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" id="status_<?=$item['id']?>" name="status_id" value="<?=$item['id']?>"<?=$data['status_id'] == $item['id'] ? 'checked' : ''?>>
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
                                                <label class="" for="score">Critic Score</label>
                                                <input type="number" required name="score" value="<?= $data['score'] ?>" placeholder="/10" class="form-control" min="1" max="10" step="0.5" style="width: 100px;">
                                            </div>
                                            <div class="col-md-12">
                                                <label>Select Popularity </label>
                                                    <?php 
                                                        $pop = getAll("popularity");
                                                        if(mysqli_num_rows($pop)> 0)
                                                        {
                                                            foreach($pop as $item)
                                                        {
                                                            ?>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="pop_<?=$item['id']?>" name="pop_id" value="<?=$item['id']?>" <?=$data['popularity_id'] == $item['id'] ? 'checked' : ''?>>
                                                                    <label class="form-check-label" for="pop_<?=$item['id']?>" style="display: inline-block; margin-left: 3px;"><?=$item['name']?></label>
                                                                </div>
                                                            <?php
                                                        }
                                                        }
                                                        else
                                                        {
                                                            echo "No Popularity Status available";
                                                        }
                                                    ?>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" name="update_serie_btn">Update</button>
                                            </div>
                                        </div>
                                    </form>
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
    </div>
</div>
<?php
include('includes/footer.php');
?>