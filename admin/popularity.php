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
    <div class="card">
        <div class="card-header">
            <h4>Popularity Status</h4>
            <div class="button-container" style="text-align: right;">
                <a href="add-popularity.php" class="btn btn-success" style="margin-right: 10px;"><i class="fa fa-solid fa-plus" style="color: #ffffff;"></i> Add New</a>
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="card-body" id="content_type_table">
            <table class="table table-bordered table-group-divider table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>ID</th>
                    <th>Created at</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $pop = getOrderAll($con, "popularity", "name ASC"); 
                if (mysqli_num_rows($pop) > 0) {
                    foreach ($pop as $item) {
                        ?>
                        <tr>
                            <td><?= $item['name']; ?></td>
                            <td>
                                <?= $item['id']; ?> 
                            </td>
                            <td>
                                <?= $item['created_at']; ?> 
                            </td>
                            <td style="width:60px">
                                <a href="edit-popularity.php?id=<?= $item['id']; ?>" class="btn btn-primary">Edit</a>
                            </td>
                            <td style="width:60px">
                                <button type="button" class="btn btn-danger delete_popularity_btn"
                                        value="<?= $item['id']; ?>">Delete
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "No records found!";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>