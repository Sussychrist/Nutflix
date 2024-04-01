<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>
<head>
<link id="pagestyle" href="assets/css/material-dashboard.min.css" rel="stylesheet" />
<link id="pagestyle" href="assets/css/list.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<div class="container">
<?php 
    if(isset($_GET['season_id'])) {       
        $seasonId = $_GET['season_id'];

        // Get season details
        $season = getSeasonId("season", $seasonId);
        
        if(mysqli_num_rows($season) > 0) {
            $data = mysqli_fetch_array($season);  
            $serieId = $data['series_id'];           
            ?>
            <div class="card">
                <div class="card-header">
                    <h4>Episodes - Season <?= $data['season_number']; ?></h4>
                    <div class="button-container" style="text-align: right;">
                        <?php
                        $seasonId = $data['season_id'];
                        $maxEpisodes = $data['season_eps'];

                        $episodes = getEpisodesForSeason($seasonId);
                        $currentEpisodes = ($episodes !== false) ? mysqli_num_rows($episodes) : 0;
                        if ($currentEpisodes < $maxEpisodes) {
                            echo '<a href="add-episode.php?season_id=' . $seasonId . '" class="btn btn-success" style="margin-right: 10px;"><i class="fa fa-solid fa-plus" style="color: #ffffff;"></i> Add New</a>';
                        } else {
                            echo '<button class="btn btn-success" disabled>Maximum Episodes Reached</button>';
                        }
                        ?>
                        <a href="seasons.php?id=<?=$serieId?>" class="btn btn-primary float-end" style="margin-left: 10px;"><i class="fa fa-arrow-left fa-2xl" style="color: #fcfcfd;"></i> Back</a>
                    </div>
                </div>
                <div class="card-body" id="episode_table">
                    <table class="table table-bordered table-group-divider table-hover">
                        <thead>
                        <tr>
                            <th>Episode Number</th>
                            <th>Video</th>
                            <th>Name</th>
                            <th>Video URL</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Get episodes for the current season
                        $episodes = getEpisodesForSeason($seasonId);

                        if ($episodes !== false && mysqli_num_rows($episodes) > 0) {
                            while ($episode = mysqli_fetch_assoc($episodes)) {
                                ?>
                                <tr>
                                    <td style="width: 60px;"><?= $episode['episode_number']; ?></td>
                                    <td><video controls width="180px" style="border-radius:5px" poster="">
                                        <source src="<?= $episode['ep_url'];?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video></td>
                                    <td><?= $episode['ep_name']; ?></td>
                                    <td><?= strlen($episode['ep_url']) > 30 ? substr($episode['ep_url'], 0, 30) . '...' : $episode['ep_url']; ?></td>
                                    <td style="width: 60px;">
                                        <a href="edit-episode.php?episode_id=<?= $episode['episode_id']; ?>" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td style="width: 60px;">
                                        <button type="button" class="btn btn-danger delete_episode_btn" value="<?= $episode['episode_id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "No episodes found for the given season ID.";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        } else {
            echo "Season not found for the given ID.";
        }
    } else {
        echo "Season ID missing from URL.";
    }
?>
</div>
<?php
include('includes/footer.php');
?>
