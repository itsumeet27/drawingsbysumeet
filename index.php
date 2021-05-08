<?php 
  include('includes/header.php');
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
?>
    
  <div class="background p-5" style="background: linear-gradient(0deg, rgba(255,255,255,1) 35%, rgba(0,100,255,1) 100%, rgba(93,93,93,1) 100%);">
    <div class="container bg-white" style="box-shadow: 0px 4px 10px 0px rgba(0,0,0,0.5)">
      <div class="row m-0 p-2">
        <div class="col-md-5 m-0 p-0 text-center">
          <img src="img/Piccolo.jpg" class="img-fluid img-responsive p-3" style="width: 90%;border-radius: 50%">
        </div>
        <div class="col-md-7">
          <div class="p-5">
            <h6 class="text-justify h6-responsive" style="font-family: 'Poppins';letter-spacing: 0.25em;font-weight: 600"><?=$salutation;?></h6>
            <h1 class="text-justify h1-responsive" style="font-family: 'Original Surfer';text-transform: uppercase;"><?=$name;?></h1>
            <p class="text-justify lead" style="font-weight:400"><?=$short_desc;?></p>
            <p style="text-align:justify;"><?=nl2br($description);?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  

<?php } include('includes/footer.php');?>