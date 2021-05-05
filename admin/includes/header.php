<?php 
  include('../includes/init.php');
  include '../includes/functions.php'; 
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Drawings By Sumeet</title>
    <!-- Custom styles for this template -->
    <link href="../css/simple-sidebar.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mdb.min.css">
    <!-- MDB icon -->
    <link rel="icon" href="../img/Piccolo.jpg" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />

    <link rel="stylesheet" href="css/style.css" />
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  </head>

  <body>
    <div class="d-flex toggled" id="wrapper">

      <!-- Sidebar -->
      <div class="border-right" id="sidebar-wrapper" style="width: 250px;">
        <div class="sidebar-heading">
          <div class="logo text-center pt-0 mt-0">
            <a href="index.php"><img class="img img-responsive img-fluid" src="../img/Piccolo.jpg" style="max-width: 75%;border-radius:50%"></a>
          </div>
        </div>
        <div class="list-group list-group-flush mt-5">
          <ul class="nav nav-pills flex-column mt-5">
            <li class="nav-item">
              <ul class="submenu nav nav-pills">                
                <li class="nav-item" style="width: 100%;"><a class="nav-link" href="banner-images.php" style="width: 100%;font-size: 14px;font-weight: 500;color: #fff;background:rgba(0,0,140);">Banner Images</a></li>
                <li class="nav-item" style="width: 100%;"><a class="nav-link mt-0" href="categories.php" style="width: 100%;font-size: 14px;font-weight: 500;color: #fff;background:rgba(0,0,140);">Categories</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background:rgba(0,0,140);">
          <i class="fas fa-bars" id="menu-toggle" style="color: #555;cursor: pointer;font-size: 18px;background: #fff;border-radius: 50%; padding: 0.7em;margin-left: 0.5em"></i>
          <a href="index.php"><span class="text-white" style="margin-left: 1em">Admin | Drawings By Sumeet</span></a>
            
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto nav-flex-icons">
              <?php 
                if(!isset($_SESSION['username'])){
                  echo "<li class='nav-item'><a href='login.php' class='nav-link white-text' style='border-radius: 0.25em;'>Login</a></li>";
                }
                else{
                  echo "
                    <li class='nav-item'>
                      <a class='nav-link text-white text-right'>Welcome: ".$_SESSION['username']."</a>
                    </li>
                    <li class='nav-item'>
                      <a href='logout.php' class='nav-link text-white text-right' title='Logout'>
                        <i class='fas fa-power-off'></i>
                      </a>
                    </li>";
                }
              ?>
            </ul>
          </div>
        </nav>
        <div class="content">