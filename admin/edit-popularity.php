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
                $pop = getId("popularity", $id);

                if(mysqli_num_rows($pop) > 0)
                {
                    $data = mysqli_fetch_array($pop);
                    ?>
                        <div class="card">
                            <div class="card-header">
                                <h4>Update Popularity Status</h4>
                                <h4>               
                                <a href="popularity.php" class="btn btn-primary float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="hidden" name="popularity_id" value="<?= $data['id'] ?>"/>
                                            <label for="">Popularity Status</label>
                                            <input type="text" required name="name" value="<?= $data['name'] ?>" placeholder="Enter the content type" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary" name="update_popularity_btn">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                else
                {
                    echo "Something is wrong I can feel it (genre not found)";
                }    
            }
            else
            {
              echo "ID missing from url";
            }         
        ?>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>