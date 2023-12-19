<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>
<head>
    <link id="pagestyle" href="assets/css/material-dashboard.min.css" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<div class="container">
<?php
        if (isset($_GET['episode_id'])) {
            $epId = $_GET['episode_id'];

            // Check if the season exists
            $ep = getEpisodeId($epId);

            if (mysqli_num_rows($ep) > 0) {
                $data = mysqli_fetch_array($ep);
        ?>
             
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Episodes <?= $data['episode_number'];?> - Season </h4>
                            <div class="button-container" style="text-align: right;">
                                <a href="#" id="backButton" class="btn btn-primary float-end"><i class="fa fa-arrow-left fa-2xl" style="color: #fcfcfd;"></i> Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <!-- Add other episode fields as needed -->
                                    <div class="row">
                                        <input type="hidden" name="episode_id" value="<?= $epId?>">
                                        <input type="hidden" name="season_id" value="<?= $data['season_id']; ?>">
                                        <input type="hidden" name="series_id" value="<?= $data['series_id']; ?>">
                                        <div class="col-md-5">
                                            <label for="episode_number">Episode Number:</label> 
                                            <input type="number" class="form-control" name="episode_number" value="<?= $data['episode_number']; ?>" required  placeholder="Enter Episode Number">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="name">Episode Name:</label>
                                            <input type="text" class="form-control" name="episode_name" value="<?= $data['ep_name']; ?>" required  placeholder="Enter the Episode Name">
                                        </div>
                                        <div class="col-md-10">
                                            <label for="slug">Episode Slug:</label>
                                            <input type="text" class="form-control" name="episode_slug" value="<?= $data['ep_slug'];?>" required  placeholder="Enter the slug">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="video">Enter Video URL</label>
                                            <div class="video-preview">
                                                <video id="video-player" controls></video>
                                            </div>
                                            <input type="text"  name="ep_url" id="video" class="form-control" placeholder="Enter the trailer URL" onchange="previewVideo(this);">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="old_video" >Current Video URL</label>
                                            <input type="text" hidden name="old_ep_url" id="old-video" class="form-control" value="<?= $data['ep_url'] ?>" placeholder="Enter the trailer URL" onchange="previewTrailer(this);">
                                            <div class="video-preview">
                                                <video id="video-player" controls><source src="<?= $data['ep_url'] ?>" type="video/mp4"></video>
                                            </div>
                                        </div> 
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary" name="update_episode_btn">Update</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            } else {
                echo "Episode not found for the given ID.";
            }
        } else {
            echo "Episode ID missing from URL.";
        }
        ?>
</div>

<?php
include('includes/footer.php');
?>