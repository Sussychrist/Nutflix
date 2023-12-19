<?php
include('../middleware/adminMiddleware.php');

if (isset($_GET['season_id'])) {
    $seasonEpId = $_GET['season_id'];
    $seasonEp = getSeasonId("season", $seasonEpId);

    if (mysqli_num_rows($seasonEp) > 0) {
        $data = mysqli_fetch_array($seasonEp);

        $episodeLimit = $data['season_eps'];
        $currentEpisodes = countCurrentEpisodes($seasonEpId);

        // Check if the user has already added episodes in the current session
        if (isset($_SESSION['addedEpisodes'])) {
            $currentEpisodes += (int)$_SESSION['addedEpisodes'];
        }

        $remainingCapacity = $episodeLimit - $currentEpisodes;

        if ($remainingCapacity <= 0) {
            $_SESSION['message'] = "The episode limit for this season has been reached. You cannot add more episodes. ";
            header("Location: episode.php?season_id=$seasonEpId");
            exit();
        }
    }
}
include('includes/header.php');
?>
<head>
    <link id="pagestyle" href="assets/css/material-dashboard.min.css" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<div class="container">
    <div class="row">
        <?php
        if (isset($_GET['season_id'])) {
            $seasonId = $_GET['season_id'];
            // Check if the season exists
            $season = getSeasonId("season", $seasonId);

            if (mysqli_num_rows($season) > 0) {
                $data = mysqli_fetch_array($season);
                $ep_total = $data['season_eps'];
                $serie_id=$data['series_id'];
                
        ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Episodes - Season <?= $data['season_number']; ?></h4>w
                            <div class="button-container" style="text-align: right;">
                                <a href="#" id="backButton" class="btn btn-primary float-end"><i class="fa fa-arrow-left fa-2xl" style="color: #fcfcfd;"></i> Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data" id="episodeForm">
                                <input type="hidden" name="season_id" value="<?= $seasonId; ?>">
                                <input type="hidden" name="series_id" value="<?= $serie_id; ?>">
                                <!-- Add other episode fields as needed -->
                                <div class="episode-container"  id="episodeContainer">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="episode_number[]">Episode Number:</label>
                                            <input type="number" class="form-control" name="episode_number[]" value="1" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="name[]">Episode Name:</label>
                                            <input type="text" class="form-control" name="name[]" value="Episode 1" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="slug[]">Episode Slug:</label>
                                            <input type="text" class="form-control" name="slug[]" value="<?= $data['series_id'];?>-<?= $data['season_number'];?>-episode-1" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="video">Enter Video URL</label>
                                            <input type="text" required name="video_url[]" id="video" class="form-control" placeholder="Enter the trailer URL" onchange="previewVideo(this);">
                                            <div class="trailer-preview">
                                                <video id="video-player" controls></video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div id="uploadBtnContainer" class="align-items-center">
                                            <button type="submit" class="btn btn-primary" name="add_episode_btn" id="uploadBtn"> <i class="fa-solid fa-upload fa-2xl" ></i> Upload</button>
                                            <button type="button" class="btn btn-success rounded" style="margin-top: 20px; margin-left:30px;" id="addEpisodeBtn"><i class="fa-solid fa-square-plus fa-2xl"></i> Add Another</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
                <style>
                    #uploadBtn{
                        width: 140px; 
                        height: 45px;
                        font-size: 13px; 
                    }
                    #addEpisodeBtn{
                        width: 170px; 
                        height: 45px; 
                        font-size: 13px; 

                    }
                    #uploadBtnContainer {
                        position: fixed;
                        border-radius: 5px;
                        width: 420px;
                        bottom: 0;
                        left: 1;
                        right: 1;
                        z-index: 9999;
                        margin-left: 120px;
                        margin-bottom: 20px;
                        padding: 10px;
                        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
                        background-color: #fff;
                        text-align: center;
                    }
                </style>
                <script>
                   document.addEventListener('DOMContentLoaded', function () {
                        const addEpisodeBtn = document.getElementById('addEpisodeBtn');
                        const episodeContainer = document.getElementById('episodeContainer');
                        const remainingCapacity = <?= $remainingCapacity; ?>; 

                        let addedEpisodes = 1;

                        addEpisodeBtn.addEventListener('click', function () {
                            if (addedEpisodes < remainingCapacity) {

                                const clone = episodeContainer.cloneNode(true);
                                episodeContainer.parentNode.appendChild(clone);

                                const lastRow = document.querySelectorAll('.episode-container')[addedEpisodes];
                                const episodeNumberInput = lastRow.querySelector('[name="episode_number[]"]');
                                const episodeNameInput = lastRow.querySelector('[name="name[]"]');
                                const episodeSlugInput = lastRow.querySelector('[name="slug[]"]');

                                const seriesId = <?= $data['series_id']; ?>;
                                const seasonNumber = <?= $data['season_number']; ?>;
                                episodeNumberInput.value = addedEpisodes + 1;
                                episodeNameInput.value = 'Episode ' + (addedEpisodes + 1);
                                episodeSlugInput.value = `${seriesId}-${seasonNumber}-${episodeNameInput.value.toLowerCase().replace(/\s+/g, '-')}`;
                                // Update the season_id and series_id hidden inputs
                                document.querySelector('[name="season_id"]').value = <?= $seasonId; ?>;
                                document.querySelector('[name="series_id"]').value = seriesId;

                                addedEpisodes++;
                            } else {
                                swal("Welp!","Maximum number of episodes reached","warning");
                            }
                        });
                        const uploadBtn = document.getElementById('uploadBtn');
                        uploadBtn.addEventListener('click', function () {
                            episodeForm.submit();
                        });
                    });
                </script>
        <?php
            } else {
                echo "Season not found for the given ID.";
            }
        } else {
            echo "Season ID missing from URL.";
        }
        ?>
    </div>
</div>

<?php
include('includes/footer.php');
?>