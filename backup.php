  
  
  <div class="p-5 text-center bg-image">
    <div class="mask" style="background-color: rgba(0, 0, 0, 0.7);">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          <h1 class="mb-3">DRAWINGS BY SUMEET</h1>
          <h6 class="mb-3">-by Sumeet Sharma</h6>
        </div>
      </div>
    </div>
  </div>
  
  <?php
    if(isset($_GET['active'])){
      $updateActive = $db->query("UPDATE category SET status = 1 WHERE id  = '".$_GET['active']."'");
      if($updateActive){
        echo "The category is active";
      }
    }

    if(isset($_GET['inactive'])){
      $updateInActive = $db->query("UPDATE category SET status = 0 WHERE id  = '".$_GET['inactive']."'");
      if($updateInActive){
        echo "The category is inactive";
      }
    }

    if(isset($_GET['delete'])){
      $deleteCategory = $db->query("DELETE FROM category WHERE id = '".$_GET['delete']."'");
      if($deleteCategory){
        echo "The category is deleted";
      }
    }
  ?>
  
  <div class="row m-0">
    <div class="col-md-6 p-4">
      <?php
        if(isset($_POST['add_category'])){
          $category_name = $_POST['category_name'];
          $insertCategory = "INSERT INTO category (name) VALUES ('$category_name')";  
          $addCategory = $db->query($insertCategory);
          if($addCategory){
            echo "<div class='alert alert-success'>Category added</div>";
          }
        }
        
      ?>
      <h4 class="py-3">Category</h4>
      <form name="category" method="post" action="" class="mdb-form">
        <input type="text" name="category_name" value="" class="form-control mb-3" style="width: 200px">
        <button type="submit" name="add_category" class="btn btn-primary">Add Category</button>
      </form>

      <div class="category-table my-3 table-responsive">
        <table class="table table-striped table-bordered w-auto table-sm">
          <thead>
            <td><i class="fas fa-check-circle" title="Active"></i></td>
            <td><i class="fas fa-times-circle" title="Inactive"></i></td>
            <td><i class="fas fa-trash-alt" title="Delete"></i></td>
            <th>Name</th>
            <th>Status</th>
          </thead>
          <tbody>
            <?php
              $fetch_category = $db->query("SELECT * FROM category ORDER BY name ASC");
              if(mysqli_num_rows($fetch_category) > 0){
                while($category = mysqli_fetch_assoc($fetch_category)){
            ?>
                <tr>
                  <td><a href="index.php?active=<?=$category['id'];?>" class="text-success"><i class="fas fa-check-circle" title="Active"></i></a></td>
                  <td><a href="index.php?inactive=<?=$category['id'];?>" class="text-warning"><i class="fas fa-times-circle" title="Inactive"></i></a></td>
                  <td><a href="index.php?delete=<?=$category['id'];?>" class="text-danger"><i class="fas fa-trash-alt" title="Delete"></i></a></td>
                  <td><?=$category['name'];?></td>
                  <td><?=$category['status'];?></td>
                </tr>
            <?php 
                }
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-6 p-4">
      <?php
        if(isset($_FILES['imagename'])){
          // Uploading Profile
          $imagefilename = $_FILES['imagename']['name'];
          $imagepath = BASEURL.'/img';
          $imagedestination = $imagepath . '/' . $imagefilename;
          $imageextension = pathinfo($imagefilename, PATHINFO_EXTENSION);
          $imagefile = $_FILES['imagename']['tmp_name'];
          $imagesize = $_FILES['imagename']['size'];

          if (!in_array($imageextension, ['jpg','jpeg','png','gif','JPG','PNG'])) {
              echo "You file extension must be jpg, jpeg, png, gif for image";
          } elseif ($_FILES['imagename']['size'] > 10000000) { // file shouldn't be larger than 100Megabyte
              echo "Files of zip and pdf are too large!";
          } else {
            move_uploaded_file($imagefile, $imagedestination);
          }
        }

        if(isset($_POST['add_image'])){

          $category_id = $_POST['category_list'];
          $result_image = $db->query("INSERT INTO images (category_id,name) VALUES ('$category_id','$imagefilename')");
          
          if($result_image){
            echo "<div class='alert alert-success'>Image saved</div>";
          } 
        }
      ?>
      <h4 class="py-3">Image</h4>
      <form name="" method="post" action="" class="mdb-form" enctype="multipart/form-data">
        <select name="category_list" class="form-select" style="width: 300px">
          <?php
            $category_list = $db->query("SELECT * FROM category");
            if(mysqli_num_rows($category_list) > 0){
              while($list = mysqli_fetch_assoc($category_list)){
                ?>
                <option value="<?=$list['id'];?>"><?=$list['name'];?></option>
                <?php
              }
            }
          ?>
        </select><br>
        
        <input type="file" class="form-control mb-2" id="imagename" name="imagename" style="width: 300px" />
        <button type="submit" name="add_image" class="btn btn-primary">Add Image</button>
        <div class="image-table my-3 table-responsive">
          <table class="table table-striped table-bordered w-auto table-sm">
            <thead>
              <td><i class="fas fa-trash-alt" title="Delete"></i></td>
              <th>Category Name</th>
              <th>File Name</th>
            </thead>
            <tbody>
              <?php
                $fetch_images = $db->query("SELECT c.name AS category_name, i.id, i.name AS image_name FROM category c INNER JOIN images i ON c.id = i.category_id");
                if(mysqli_num_rows($fetch_images) > 0){
                  while($image_list = mysqli_fetch_assoc($fetch_images)){
                    ?>
                    <tr>
                      <td><a href="index.php?delete_image=<?=$image_list['id'];?>" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
                      <td><?=$image_list['category_name'];?>
                      <td><?=$image_list['image_name'];?>
                    </tr>
                    <?php
                  }
                }
              ?>
              <tr>
                
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div> 

  <div class="container">
    <div class="row">
      <?php
        $fetch_categories = $db->query("SELECT * FROM folders");
        if(mysqli_num_rows($fetch_categories) > 0){
          while($category = mysqli_fetch_assoc($fetch_categories)){
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 my-3">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title"><?=$category['folder_name'];?></h5>
                </div>
                <div class="card-body">
                  
                </div>
                <div class="card-footer">
                  <a href="gallery.php?category=<?=$category['id'];?>" class="btn btn-primary">View More</a>
                </div>
              </div>
            </div>
            <?php
          }
        }
      ?>
    </div>
  </div>