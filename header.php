<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php
    // Set the path to your custom favicon (replace 'favicon.ico' with your file name and path)
    $favicon_path = './images/60a0f428-3511-48da-a2a4-a9765ec009b5_logo-color.PNG';
    ?>

  <link rel="icon" type="image/x-icon" href="<?php echo $favicon_path; ?>">
  <title>NutFLix</title>
  <link rel="stylesheet" href="./user_assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- i will provide this in description  -->
  <link rel="stylesheet" href="./user_assets/css/slick.css" />
  <link rel="stylesheet" href="./user_assets/css/slick-theme.css" />
  <link rel="stylesheet" href="./user_assets/css/owl.carousel.min.css" />
  <link rel="stylesheet" href="./user_assets/css/animate.min.css" />
  <link rel="stylesheet" href="./user_assets/css/magnific-popup.css" />
  <link rel="stylesheet" href="./user_assets/css/select2.min.css" />
  <link rel="stylesheet" href="./user_assets/css/select2-bootstrap4.min.css" />
  <link rel="stylesheet" href="./user_assets/css/slick-animation.css" />
  <link rel="stylesheet" href="./user_assets/style.css" />
  <link rel="stylesheet" href="./user_assets/custom.css" />
  <!-- alertify js -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<?php

include('./config/config.php');
?>
<body>
  <header id="main-header">
    <div class="main-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
              <a href="#" class="navbar-toggler c-toggler" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <div class="navbar-toggler-icon" data-toggle="collapse">
                  <span class="navbar-menu-icon navbar-menu-icon--top"></span>
                  <span class="navbar-menu-icon navbar-menu-icon--middle"></span>
                  <span class="navbar-menu-icon navbar-menu-icon--bottom"></span>
                </div>
              </a>
              <a href="<?=BASE_URL?>/index.php" class="navbar-brand">
                <img src="images/logo-no-background.png" class="img-fluid logo" alt="" />
              </a>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="menu-main-menu-container">
                  <ul id="top-menu" class="navbar-nav ml-auto">
                    <li class="menu-item"><a href="<?=BASE_URL?>/index.php">Home</a></li>
                    <li class="menu-item"><a href="<?=BASE_URL?>/genre_include/genre.php">Movies</a></li>
                    <li class="menu-item"><a href="<?=BASE_URL?>/genre_include/serie.php">TV Series</a></li>
                    <li class="menu-item"><a href="<?=BASE_URL?>/genre_include/content_details.php">Detail<span class="arrow_carrot-down"></span></a>
                    </li>
                  </ul>
                </div>
              </div>
             
              <div class="navbar-right menu-right">
                <ul class="d-flex align-items-center list-inline m-0">
                  <li class="nav-item nav-icon">
                    <a href="#" class="search-toggle device-search">
                      <i class="fa fa-search"></i>
                    </a>
                    <div class="search-box iq-search-bar d-search">
                      <form action="#" class="searchbox">
                        <div class="form-group position-relative">
                          <input type="text" class="text search-input font-size-12"
                            placeholder="type here to search..." />
                          <i class="search-link fa fa-search"></i>
                        </div>
                      </form>
                    </div>
                  </li>
                <?php
                  if(isset($_SESSION['auth']))
                {
                 ?>
                  <li class="nav-item nav-icon">
                    <a href="#" class="search-toggle" data-toggle="search-toggle">
                      <i class="fa fa-bell"></i>
                      <span class="bg-danger dots"></span>
                    </a>
                    <div class="iq-sub-dropdown">
                      <div class="iq-card shadow-none m-0">
                        <div class="iq-card-body">
                          <a href="#" class="iq-sub-card">
                            <div class="media align-items-center">
                              <img src="images/notify/thumb-1.jpg" alt="" class="img-fluid mr-3" />
                              <div class="media-body">
                                <h6 class="mb-0">Captain Marvel</h6>
                                <small class="font-size-12">just now</small>
                              </div>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item nav-icon">
                    <a href="./genre_include/login.php" class="iq-user-dropdown search-toggle d-flex align-items-center p-0">
                      <img src="images/user/user.png" class="img-fluid user-m rounded-circle" alt="" />
                    </a>
                    <div class="iq-sub-dropdown iq-user-dropdown">
                      <div class="iq-card shadow-none m-0">
                        <div class="iq-card-body p-0 pl-3 pr-3">
                          <a href="#" class="iq-sub-card setting-dropdown">
                            <div class="media align-items-center">
                              <div class="right-icon">
                                <i class="fa fa-user text-primary"></i>
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="mb-0">Manage Profile</h6>
                              </div>
                            </div>
                          </a>
                          <a href="#" class="iq-sub-card setting-dropdown">
                            <div class="media align-items-center">
                              <div class="right-icon">
                                <i class="fa fa-cog text-primary"></i>
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="mb-0">Settings</h6>
                              </div>
                            </div>
                          </a>
                          <a href="#" class="iq-sub-card setting-dropdown">
                            <div class="media align-items-center">
                              <div class="right-icon">
                                <i class="fa fa-inr text-primary"></i>
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="mb-0">Pricing Plan</h6>
                              </div>
                            </div>
                          </a>
                          <a href="logout.php" class="iq-sub-card setting-dropdown">
                            <div class="media align-items-center">
                              <div class="right-icon">
                                <i class="fa fa-sign-out text-primary"></i>
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="mb-0">Logout</h6>
                              </div>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </li>
                  <?php
                }
                  else
                  { 
                    ?>
                    <div class="containerbutton">
                      <div>
                        <a href="<?=BASE_URL?>/genre_include/login.php">
                          <button class="log">Log In</button>
                        </a>
                        <a href="<?=BASE_URL?>/genre_include/signup.php">
                        <button class="log">Sign Up</button>
                        </a>
                      </div>
                    </div>
                    <?php
                  } 
                  ?>
                </ul>
              </div>
            </nav>
            <div class="nav-overlay"></div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main id="main-site">