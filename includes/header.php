<!DOCTYPE html>
<?php 
  include('includes/init.php');
  $sql = "SELECT * FROM about";
  $result = $db->query($sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $id = $row['id'];
      $name = $row['name'];
      $short_desc = $row['feature_desc'];
      $salutation = $row['salutation'];
      $description = $row['about_desc'];
      $address = $row['address'];
      $mobile = $row['mobile'];
      $email = $row['email'];
      $image = $row['image'];
    }

    $sql_social = "SELECT * FROM social";
    $result_social = $db->query($sql_social);
    while($social = mysqli_fetch_assoc($result_social)){
      $facebook = $social['facebook'];
      $instagram = $social['instagram'];
      $deviantart = $social['deviantart'];
      $tumblr = $social['tumblr'];
      $pinterest = $social['pinterest'];
      $youtube = $social['youtube'];
      $behance = $social['behance'];
    }
  }
?>
<?php 
  function getIp() {
    //Get IP Address
      $ip = $_SERVER['REMOTE_ADDR'];   
      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }  
      return $ip;
  }

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Drawings By Sumeet</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/Piccolo.jpg" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Original+Surfer&family=Poppins:wght@200;300&family=Roboto:wght@300;400;500;700&display=swap"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />

    <link rel="stylesheet" href="css/style.css" />
    
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top top-navigation">
        <div class="container">
          <a class="navbar-brand font-weight-bold p-2" href="./">DRAWINGSBYSUMEET</a>
          <!-- Toggle button -->
          <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarLeftAlignExample" aria-controls="navbarLeftAlignExample" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item p-1">
                <a class="nav-link font-weight-bold" href="./">Home</a>
              </li>
              <li class="nav-item p-1">
                <a class="nav-link font-weight-bold" href="./#about">About</a>
              </li>
              <!-- Navbar dropdown -->
              <li class="nav-item p-1 dropdown">
                <a class="nav-link font-weight-bold dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false"
                >Gallery</a>
                <!-- Dropdown menu -->
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php 
                    $fetch_category = $db->query("SELECT * FROM folders WHERE filecount <> 0 ORDER BY folder_name ASC");
                    if(mysqli_num_rows($fetch_category) > 0){
                      while($category = mysqli_fetch_assoc($fetch_category)){
                        ?>
                        <li><a class="dropdown-item" href="gallery.php?category=<?=$category['id'];?>"><?=$category['folder_name'];?></a></li>
                        <?php
                      }
                    }
                  ?>
                </ul>
              </li>
              <li class="nav-item p-1">
                <a class="nav-link font-weight-bold" href="./videos.php">Videos</a>
              </li>
            </ul>
            <ul class="navbar-nav d-flex flex-row me-1 social-links">
              <!-- Icons -->
              <?php if($facebook != ''){ ?>
              <li class="nav-item me-2">
                <a class="nav-link" href="https://facebook.com/<?=$facebook;?>" target="_blank">
                  <i class="fab fa-facebook me-1"></i>
                </a>
              </li>
              <?php } ?>              
              <?php if($instagram != ''){ ?>
              <li class="nav-item me-2">
                <a class="nav-link" href="https://instagram.com/<?=$instagram;?>" target="_blank">
                  <i class="fab fa-instagram me-1"></i>
                </a>
              </li>
              <?php } ?>
              <?php if($youtube != ''){ ?>
              <li class="nav-item me-2">
                <a class="nav-link" href="https://youtube.com/channel/<?=$youtube;?>" target="_blank">
                  <i class="fab fa-youtube me-1"></i>
                </a>
              </li>
              <?php } ?>
              <?php if($deviantart != ''){ ?>
              <li class="nav-item me-2">
                <a class="nav-link" href="https://deviantart.com/<?=$deviantart;?>" target="_blank">
                  <i class="fab fa-deviantart me-1"></i>
                </a>
              </li>
              <?php } ?>
              <?php if($tumblr != ''){ ?>
              <li class="nav-item me-2">
                <a class="nav-link" href="https://<?=$tumblr;?>.tumblr.com/" target="_blank">
                  <i class="fab fa-tumblr me-1"></i>
                </a>
              </li>
              <?php } ?>
              <?php if($pinterest != ''){ ?>
              <li class="nav-item me-2">
                <a class="nav-link" href="https://in.pinterest.com/<?=$pinterest;?>" target="_blank">
                  <i class="fab fa-pinterest me-1"></i>
                </a>
              </li>
              <?php } ?>
              <?php if($behance != ''){ ?>
              <li class="nav-item me-2">
                <a class="nav-link" href="https://behance.net/<?=$behance;?>" target="_blank">
                  <i class="fab fa-behance me-1"></i>
                </a>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
    </header>