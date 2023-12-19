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
            <div class="card">
                <div class="card-header">
                    <h4>Add Movie
                    <a href="movies.php" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">        
                        <div class="row">
                            <div class="col-md-10">
                                <label>Select Genre</label>
                                <?php 
                                     $genre = getOrderAll($con, "genre", "name ASC"); 
                                    if(mysqli_num_rows($genre) > 0) {
                                        foreach($genre as $item) {
                                ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="genre_<?=$item['id']?>" name="genre_id[]" value="<?=$item['id']?>">
                                    <label class="form-check-label" for="genre_<?=$item['id']?>" style="display: inline-block; margin-left: 10px;"><?=$item['name']?></label>
                                </div>
                                <?php
                                        }
                                    }
                                    else {
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
                                            <option value="<?=$item['id'] ?>"><?=$item['name'] ?></option>
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
                                            foreach($quality as $item)
                                        {
                                            ?>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="quality_<?=$item['id']?>" name="quality_id[]" value="<?=$item['id']?>">
                                                    <label class="form-check-label" for="quality_<?=$item['id']?>" style="display: inline-block; margin-left: 10px;"><?=$item['name']?></label>
                                                </div>
                                            <?php
                                        }
                                        }
                                        else
                                        {
                                            echo "No Quality available";
                                        }
                                        
                                    ?>
                            </div>
                            <div class="col-md-10">
                                <label>Select Region</label>
                                    <?php 
                                        $region = getOrderAll($con, "countries", "name ASC"); 
                                        if(mysqli_num_rows($region) > 0) {
                                            foreach($region as $item) {
                                    ?>
                                        <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" id="countries_<?=$item['id']?>" name="countries_id[]" value="<?=$item['id']?>" onclick="limitRegions()">
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
                                <label class="mt-2" for="name">Title</label>
                                <input type="text" required name="title" id="title"  placeholder="Enter Movie Title" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label class="mt-2" for="slug">Slug</label>
                                <input type="text" required name="slug" id="slug" placeholder="Enter slug" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="tags">Tags</label>
                                <input type="text" required name="tags" id="tags" placeholder="Enter Tags" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="release_year">Release Year</label>
                                <input type="text" required name="release_year" id="release_year" placeholder="Enter release year" class="form-control">
                            </div>
                            <div class="col-md-10">
                                <label for="description">Description</label>
                                <textarea rows="5" required name="description" id="description" placeholder="Enter description" class="form-control"></textarea>
                            </div>
                            <div class="col-md-5">
                                <label for="actor">Actors</label>
                                <input type="text" required name="actor" id="actor" placeholder="Enter Actors" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="director">Director</label>
                                <input type="text" required name="director" id="director" placeholder="Enter Directors" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="image">Upload Poster</label>
                                <div class="image-upload">
                                    <input type="file" required name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this);">
                                    <i class="fa fa-picture-o"></i>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="trailer" >Enter Trailer URL</label>
                                <input type="text" required name="trailer" id="trailer" class="form-control" placeholder="Enter the trailer URL" onchange="previewTrailer(this);">
                                <div class="trailer-preview">
                                    <video id="trailer-player" controls></video>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="wallpaper" class="mt-3">Upload Wallpaper</label>
                                <div class="wallpaper-upload">
                                    <input type="file" name="wallpaper" id="wallpaper" class="form-control" accept="image/*" onchange="previewWallpaper(this);">
                                    <i class="fa fa-picture-o"></i>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="video" class="mt-3">Enter Video URL</label>
                                <input type="text" required name="video" id="video" class="form-control" placeholder="Enter the trailer URL" onchange="previewVideo(this);">
                                <div class="trailer-preview">
                                    <video id="video-player" controls></video>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label class="mt-3" for="subtitle">Subtitle</label>
                                <input type="text" required name="subtitle" id="subtitle" placeholder="Enter subtitle" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label class="mt-3" for="duration">Duration</label>
                                <input type="text" required name="duration" id="duration" placeholder="Enter Duration" class="form-control">
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
                                                    <input class="form-check-input" type="radio" id="status_<?=$item['id']?>" name="status_id" value="<?=$item['id']?>">
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
                                <input type="number" required name="score" id="score" placeholder="/10" class="form-control" min="1" max="10" step="0.5" style="width: 100px;">
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
                                                    <input class="form-check-input" type="radio" id="pop_<?=$item['id']?>" name="pop_id" value="<?=$item['id']?>">
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
                                <button type="submit" class="btn btn-primary" name="add_movie_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>