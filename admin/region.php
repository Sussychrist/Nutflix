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
            <h4>Region</h4>
            <div class="button-container" style="text-align: right;">
                <a href="add-country.php" class="btn btn-success" style="margin-right: 10px;"><i class="fa fa-solid fa-plus" style="color: #ffffff;"></i> Add New</a>
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="card-body" id="region_table">
            <table class="table table-group-divider table-hover">
                <thead>
                <tr>
                    <th>Flag</th>
                    <th>Name</th>
                    <th>Post</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $region = getOrderAll($con, "countries", "name ASC"); 
                if (mysqli_num_rows($region) > 0) {
                    foreach ($region as $item) {
                        ?>
                        <tr>
                            <td><img src="../uploads/flags/<?= $item['flag']; ?>" width="50px" alt="<?= $item['flag']; ?>"></td>
                            <td><?= $item['name']; ?></td>
                            <td>
                                <!-- You can add the number of posts here -->
                            </td>
                            <td style="width:60px">
                                <button type="button" class="btn btn-danger delete_region_btn"
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