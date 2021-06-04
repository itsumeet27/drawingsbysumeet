<?php  
 include('../../includes/init.php');
 $output = '';  
 $sql = "SELECT * FROM about ORDER BY id DESC";  
 $result = mysqli_query($db, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th style="font-size:13px;text-align:justify" width="250">Name</th>  
                     <th style="font-size:13px;text-align:justify" width="250">Feature</th>  
                     <th style="font-size:13px;text-align:justify" width="250">Description</th>  
                     <th style="font-size:13px;text-align:justify" width="250">Salutation</th>  
                     <th style="font-size:13px;text-align:justify" width="250">Address</th>
                     <th style="font-size:13px;text-align:justify" width="250">Mobile</th>
                     <th style="font-size:13px;text-align:justify" width="250">Email</th>
                </tr>';  
 $rows = mysqli_num_rows($result);
 if($rows > 0) {  	  
  while($row = mysqli_fetch_array($result))  
  {  
       $output .= '  
            <tr>  
                 <td style="font-size:13px;text-align:justify" class="name" data-id1="'.$row["id"].'" contenteditable>'.$row['name'].'</td>  
                 <td style="font-size:13px;text-align:justify" class="feature_desc" data-id2="'.$row["id"].'" contenteditable>'.$row['feature_desc'].'</td>  
                 <td style="font-size:13px;text-align:justify" class="about_desc" data-id3="'.$row["id"].'" contenteditable>'.$row['about_desc'].'</td>  
                 <td style="font-size:13px;text-align:justify" class="salutation" data-id4="'.$row["id"].'" contenteditable>'.$row["salutation"].'</td>  
                 <td style="font-size:13px;text-align:justify" class="address" data-id5="'.$row["id"].'" contenteditable>'.$row["address"].'</td>  
                 <td style="font-size:13px;text-align:justify" class="mobile" data-id6="'.$row["id"].'" contenteditable>'.$row["mobile"].'</td>  
                 <td style="font-size:13px;text-align:justify" class="email" data-id7="'.$row["id"].'" contenteditable>'.$row["email"].'</td>  
            </tr>  
       ';  
  }   
 }  
 else  
 {  
      $output .= '
				<tr>  
          <td id="name" contenteditable style="font-size:13px"></td>  
          <td id="feature_desc" contenteditable style="font-size:13px"></td>  
          <td id="about_desc" contenteditable style="font-size:13px"></td>  
          <td id="salutation" contenteditable style="font-size:13px"></td>  
          <td id="address" contenteditable style="font-size:13px"></td>  
          <td id="mobile" contenteditable style="font-size:13px"></td>  
          <td id="email" contenteditable style="font-size:13px"></td>
					<td><button type="button" name="btn_add_profile" id="btn_add_profile" class="btn btn-xs btn-success btn-floating">+</button></td>  
			   </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>