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
  ?>
  <div class="category-head py-2 mb-4" id="contact">
	  <h1 class="font-weight-bold text-center py-4 about-head">Contact</h1>
	  <div class="container p-0 contact-section">
	    <div class="contact">
        <div class="row m-0">
          <div class="contact-form col-md-6 px-4">
              <h4 class="py-3 font-weight-bold">SEND ME YOUR QUERY</h4>
              <?php
                if(isset($_POST['submit'])){
                    
                    $username = $_POST['name'];
                    $useremail = $_POST['email'];
                    $subject = $_POST['subject'];
                    $message = $_POST['message'];

                    $sql = "INSERT INTO contact (name,email,subject,message) VALUES ('$username','$useremail','$subject','$message')";
                    $insert = $db->query($sql);$username = $_POST['name'];
                    $useremail = $_POST['email'];
                    $usermessage = $_POST['message'];
                    $usersubject = $_POST['subject'];	
                            
                    $to = $email;
                    $subject = "Contact Message from $username";
                    
                    $message = "<p style='font-size: 17px'>Greetings for the day,</p>";
                    $message .= "<p>You have a message from $username as follows:</i></p>";
                    $message .= "<p><b>Subject: </b><i><u>$usersubject</u></i></p>";
                    $message .= "<p><b>Message: </b>$usermessage</p>";
                    
                    $header = "From:$useremail \r\n";
                    $header .= "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html\r\n";
                    
                    $retval = mail ($to,$subject,$message,$header);
                    
                    if( $retval == true ) {
                        echo "<div class='alert alert-success'>Thank you for contacting!</div>";
                    }else {
                        echo "<div class='alert alert-danger'>Message could not be sent</div>";
                    }
                }
              ?>
              <form name="contact-form" method="post" enctype="multipart/form-data" id="contact-form">
                  <!-- Name input -->
                  <div class="form-outline mb-4">
                      <input type="text" id="name" name="name" class="form-control" required />
                      <label class="form-label" for="name">Name</label>
                  </div>

                  <!-- Email input -->
                  <div class="form-outline mb-4">
                      <input type="email" id="email" name="email" class="form-control" required />
                      <label class="form-label" for="email">Email address</label>
                  </div>

                  <!-- Subject input -->
                  <div class="form-outline mb-4">
                      <input type="text" id="subject" name="subject" class="form-control" required />
                      <label class="form-label" for="name">Subject</label>
                  </div>

                  <!-- Message input -->
                  <div class="form-outline mb-4">
                      <textarea class="form-control" name="message" id="message" rows="4"></textarea>
                      <label class="form-label" for="message">Message</label>
                  </div>

                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-portfolio btn-lg">Send &nbsp;<i class="fas fa-paper-plane"></i></button>
                  <div class="status"></div>
              </form>
          </div>
          <div class="contact-details col-md-6 px-4">
            <h4 class="py-3 font-weight-bold">REACH OUT TODAY</h4>
            <p class="py-2">&nbsp;<i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;&nbsp;<?=$address;?></p>
            <p class="py-2">&nbsp;<i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;&nbsp;<a href="tel:<?=$mobile;?>"><?=$mobile;?></a></p>
            <p class="py-2"><i class="fas fa-envelope"></i>&nbsp;&nbsp;&nbsp;<a href="mailto:<?=$email;?>"><?=$email;?></a></p>
	          <div class="py-2">
	          	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1883.0897740917926!2d72.86277540804426!3d19.27455664674358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b05a0dd5123b%3A0xf9e5543510f58f4f!2sSector%209%2C%20Shanti%20Nagar%2C%20Mira%20Road%2C%20Mira%20Bhayandar%2C%20Maharashtra%20401107!5e0!3m2!1sen!2sin!4v1620653244591!5m2!1sen!2sin" height="300" style="border:0;width:100%" allowfullscreen="" loading="lazy"></iframe>
	          </div>
          </div>
        </div>
	    </div>
	  </div>
  </div>