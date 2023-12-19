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
                $genre = getId("genre", $id);

                if(mysqli_num_rows($genre) > 0)
                {
                    $data = mysqli_fetch_array($genre);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Genre
                            <a href="genre.php" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-5">
                                    <input type="hidden" name="genre_id" value="<?= $data['id'] ?>"/>
                                        <label for="name">Name</label>
                                        <input type="text" required name="name" value="<?= $data['name'] ?>" placeholder="Enter Category name" class="form-control">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="slug">Slug</label>
                                        <input type="text" required name="slug" value="<?= $data['slug'] ?>" placeholder="Enter slug" class="form-control">
                                    </div>
                                    <div class="col-md-10">
                                        <label for="description">Description</label>
                                        <textarea rows="5" required name="description" placeholder="Enter description" class="form-control"><?= $data['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="image">Upload Image</label>
                                        <div class="image-upload">
                                            <input type="file" required name="image" value="<?= $data['img'] ?>" class="form-control" accept="image/*" onchange="previewImage(this);">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                    <label for="image">Current Image</label>
                                            <input type="hidden" name="old_image" value="<?= $data['img'] ?>" class="form-control" />
                                            <div class="square-image-container">
                                                <img src="../uploads/genre/<?= $data['img'] ?>" />
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="update_genre_btn">Update</button>
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