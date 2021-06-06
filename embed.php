<?php

  function make_query($db){
    $query = "SELECT * FROM videos ORDER BY id ASC";
    $result = $db->query($query);
    return $result;
  }

  function make_slide_indicators($db) {
    $output = ''; 
    $count = 0;
    $result = make_query($db);
    while($row = mysqli_fetch_array($result)) {
      if($count == 0) {
        $output .= '
        <button
          type="button"
          data-mdb-target="#carouselVideos"
          data-mdb-slide-to="'.$count.'"
          class="active"
          aria-current="true"
        ></button>
        ';
      } else {
        $output .= '
        <button
          type="button"
          data-mdb-target="#carouselVideos"
          data-mdb-slide-to="'.$count.'"
        ></button>
        ';
      }
      $count = $count + 1;
    }
    return $output;
  }


  function make_slides($db) {
    $output = '';
    $count = 0;
    $result = make_query($db);
    while($row = mysqli_fetch_array($result)) {
      if($count == 0) {
        $output .= '<div class="carousel-item active">';
      } else {
        $output .= '<div class="carousel-item">';
      }
      $output .= '
        <iframe src="'.$row["url"].'" title="'.$row["title"].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%;height:100vh"></iframe>
        </div>
        ';
      $count = $count + 1;
    }
    return $output;
  }
?>

<div
id="carouselVideos"
class="carousel slide carousel-fade"
data-mdb-ride="carousel"
>
  <div class="carousel-indicators">
    <?php echo make_slide_indicators($db); ?>
  </div>
  <div class="carousel-inner">
    <?php echo make_slides($db); ?>
  </div>
  <button
  class="carousel-control-prev"
  type="button"
  data-mdb-target="#carouselVideos"
  data-mdb-slide="prev"
  >
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button
  class="carousel-control-next"
  type="button"
  data-mdb-target="#carouselVideos"
  data-mdb-slide="next"
  >
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>