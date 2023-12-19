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
                    <h4>Add Genre
                    <a href="genre.php" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-5">
                                <label for="name">Name</label>
                                <input type="text" required name="name" id="name" placeholder="Enter Category name" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="slug">Slug</label>
                                <input type="text" required name="slug" id="slug" placeholder="Enter slug" class="form-control">
                            </div>
                            <div class="col-md-10">
                                <label for="description">Description</label>
                                <textarea rows="5" required name="description" id="description" placeholder="Enter description" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="image">Upload Image</label>
                                <div class="image-upload">
                                    <input type="file" required name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this);">
                                    <i class="fa fa-picture-o"></i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_genre_btn">Save</button>
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