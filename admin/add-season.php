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
    <?php 
    if(isset($_GET['id'])) {       
        $serieId = $_GET['id'];

        // Get season details
        $series = getId("series", $serieId);
        
        if(mysqli_num_rows($series) > 0) {
            $data = mysqli_fetch_array($series); 
            $seriesName = $data['title'];            
            ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Season
                        <a href="#" id="backButton" class="btn btn-primary float-end"><i class="fa fa-arrow-left fa-2xl" style="color: #fcfcfd;"></i> Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">       
                        <input type="hidden" name="series_id" value="<?= $serieId; ?>">
                                
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="season" class="mt-3">Season Number</label>
                                    <input type="text" required name="season" id="season_number"  placeholder="Enter Serie season" class="form-control">
                                </div>
                                <input type="hidden" required name="slug" id="season_slug" placeholder="Enter slug" class="form-control">
                                <!-- Add JavaScript to dynamically update the slug -->
                                <script>
                                    const seriesName = <?= json_encode($seriesName) ?>; 
                                    function generateSlug(seriesName, seasonNumber) {
                                        const season_slug = `${seriesName.toLowerCase().replace(/\s+/g, '-')}-season-${seasonNumber}`;
                                        return season_slug;
                                    }
                                    const seasonInput = document.getElementById('season_number');
                                    const slugField = document.getElementById('season_slug');

                                    seasonInput.addEventListener('input', function () {
                                        const seasonNumber = this.value;
                                        const generatedSlug = generateSlug(seriesName, seasonNumber);
                                        console.log(generatedSlug); 
                                        slugField.value = generatedSlug;
                                    });

                                    document.querySelector('form').addEventListener('submit', function (event) {
                                        console.log('Form data before submission:', new FormData(event.target));
                                    });
                                </script>
                                <div class="col-md-5">
                                    <label for="release_year" class="mt-3">Release Year</label>
                                    <input type="text" required name="release_year" id="release_year" placeholder="Enter release year" class="form-control">
                                </div>
                                <div class="col-md-10">
                                    <label for="description">Description</label>
                                    <textarea rows="5" required name="description" id="description" placeholder="Enter description" class="form-control"></textarea>
                                </div>
                                <div class="col-md-5">
                                    <label for="image">Upload Poster</label>
                                    <div class="image-upload">
                                        <input type="file" required name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this);">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="wallpaper">Upload Wallpaper</label>
                                    <div class="wallpaper-upload">
                                        <input type="file" required name="wallpaper" id="wallpaper" class="form-control" accept="image/*" onchange="previewWallpaper(this);">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label class="mt-3" for="season_eps">Season Episodes</label>
                                    <input type="number" required name="season_episode" id="season_eps" placeholder="Enter number of Episodes" class="form-control" >
                                </div>
                                <div class="col-md-8">
                                    <label class="mt-3" >Select Status </label>
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
                                    <label class="mt-3" for="score">Critic Score</label>
                                    <input type="number" required name="score" id="score" placeholder="/10" class="form-control" min="1" max="10" step="0.5" style="width: 100px;">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" name="add_season_btn">Save</button>
                                </div>
                            </div>
                        </form>
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
</div>
<?php
include('includes/footer.php');
?>