<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <?php
    $favicon_path = './assets/images/60a0f428-3511-48da-a2a4-a9765ec009b5_logo-color.PNG';
    ?>

  <link rel="icon" type="image/x-icon" href="<?php echo $favicon_path; ?>">
    <title>Admin</title>
    <!-- alertify js -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</head>
<body>

   <style>
        .alertify-notifier .ajs-success {
            color: white;
        }
    </style>    
<?php
include('../config/config.php'); 
include('sidebar.php');
?>
    <div class="content">
        <?php 
        include('navbar.php');
        ?>
<script src="assets/js/index.js"></script>