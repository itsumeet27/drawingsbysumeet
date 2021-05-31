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
            $linkedin = $social['linkedin'];
            $twitter = $social['twitter'];
            $pinterest = $social['pinterest'];
            $github = $social['github'];
            $behance = $social['behance'];
          }
        ?>
        <!-- Social icons -->
        <div class="pt-3 footer-social">
          <?php if($facebook != ''){ ?>
          <a href="https://www.facebook.com/<?=$facebook;?>" target="_blank">
            <i class="fab fa-facebook me-3"></i>
          </a>
          <?php }if($linkedin != ''){ ?>
          <a href="https://linkedin.com/in/<?=$linkedin;?>" target="_blank">
            <i class="fab fa-linkedin me-3"></i>
          </a>
          <?php }if($twitter != ''){ ?>
          <a href="https://twitter.com/<?=$twitter;?>" target="_blank">
            <i class="fab fa-twitter me-3"></i>
          </a>
          <?php }if($instagram != ''){ ?>
          <a href="https://instagram.com/<?=$instagram;?>" target="_blank">
            <i class="fab fa-instagram me-3"></i>
          </a>
          <?php }if($github != ''){ ?>
          <a href="https://github.com/<?=$github;?>" target="_blank">
            <i class="fab fa-github me-3"></i>
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