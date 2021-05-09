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
      $linkedin = $social['linkedin'];
      $twitter = $social['twitter'];
      $pinterest = $social['pinterest'];
      $github = $social['github'];
      $behance = $social['behance'];
    }
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
                <a class="nav-link font-weight-bold" href="/">Home</a>
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
                <a class="nav-link font-weight-bold" href="./#contact">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>