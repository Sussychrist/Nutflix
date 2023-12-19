<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    $favicon_path = '../admin/assets/images/60a0f428-3511-48da-a2a4-a9765ec009b5_logo-color.PNG';
    ?>

  <link rel="icon" type="image/x-icon" href="<?php echo $favicon_path; ?>">
    <title>Nutflix</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="sass/style.css" type="text/css">
</head>
<?php
session_start();
include('../config/config.php');
?>
<body>
    <style>
        .alertify-notifier .ajs-success {
            color: white;
        }
    </style>   
    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="<?=BASE_URL?>/index.php">
                            <img src="img/logo-no-background.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li><a href="<?=BASE_URL?>/index.php">HOME</a></li>
                                <li><a href="<?=BASE_URL?>/genre_include/genre.php">MOVIE <span class="arrow_carrot-down"></span></a>
                                </li>
                                <li><a href="<?=BASE_URL?>/genre_include/serie.php">TV SERIES<span></span></a>
                                <li><a href="<?=BASE_URL?>/index.php"><span>DETAILS</span></a>
                            </ul>
                        </nav>
                    </div>
                </div>
                <?php
                  if(isset($_SESSION['auth']))
                {
                 ?>
                    <div class="col-lg-2">
                        <div class="header__right">
                            <a href="<?=BASE_URL?>/logout.php"><i class="fa fa-sign-out font-size-12"></i></a>
                            <a href=""><span class="icon_profile"></span></a>
                        </div>
                    </div> 
                <?php
                }
                else
                    { 
                        ?>
                        <div class="col-lg-2">
                            <div class="header__right">
                                <a href="<?=BASE_URL?>/genre_include/login.php">Login</a></span></a>
                                <a href="<?=BASE_URL?>/genre_include/signup.php">Sign Up</a></span></a>
                            </div>
                        </div>
                    <?php
                    }
                ?>    
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
<body>
<!-- Header End -->
<!-- Js Plugins -->

<main id="main-site">

