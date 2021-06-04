    <footer class="page-footer text-center font-small bg-white">
      <?php
        $sql = "SELECT * FROM about";
        $result = $db->query($sql);
        while($row = mysqli_fetch_assoc($result)){
          $name = $row['name'];
          $short_desc = $row['feature_desc'];
          $salutation = $row['salutation'];
          $description = $row['about_desc'];
          $address = $row['address'];
          $mobile = $row['mobile'];
          $email = $row['email'];
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
      ?>
      <!-- Social icons -->
      <div class="pt-3 footer-social">
        <?php if($facebook != ''){ ?>
        <a href="https://www.facebook.com/<?=$facebook;?>" target="_blank">
          <i class="fab fa-facebook me-3"></i>
        </a>        
        <?php }if($instagram != ''){ ?>
        <a href="https://instagram.com/<?=$instagram;?>" target="_blank">
          <i class="fab fa-instagram me-3"></i>
        </a>
        <?php }if($youtube != ''){ ?>
        <a href="https://youtube.com/channel/<?=$youtube;?>" target="_blank">
          <i class="fab fa-youtube me-3"></i>
        </a>
        <?php }if($deviantart != ''){ ?>
        <a href="https://deviantart.com/<?=$deviantart;?>" target="_blank">
          <i class="fab fa-deviantart me-3"></i>
        </a>
        <?php }if($tumblr != ''){ ?>
        <a href="https://<?=$tumblr;?>.tumblr.com/" target="_blank">
          <i class="fab fa-tumblr me-3"></i>
        </a>
        <?php }if($pinterest != ''){ ?>
        <a href="https://in.pinterest.com/<?=$pinterest;?>" target="_blank">
          <i class="fab fa-pinterest me-2"></i>
        </a>
        <?php }if($behance != ''){ ?>
        <a href="https://behance.net/<?=$behance;?>" target="_blank">
          <i class="fab fa-behance me-3"></i>
        </a>
        <?php }?>
      </div>
      <!-- Social icons -->
      
      <!--Copyright-->
      <div class="footer-copyright pt-3 pb-2">
        <span class="font-weight-bold">© 2020 COPYRIGHT:</span>
        <a href="./" target="_blank" class="font-weight-bold"> DRAWINGSBYSUMEET </a>
      </div>
        <!--/.Copyright-->
    </footer>
	
  	<script type="text/javascript">
  		function openNav() {
  		  document.getElementById("mySidepanel").style.width = "300px";
  		}

  		function closeNav() {
  		  document.getElementById("mySidepanel").style.width = "0";
  		}
  	</script>

  	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  	<!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>