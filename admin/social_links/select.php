<?php  
  include('../../includes/init.php');
  $output = '';  
  $sql = "SELECT * FROM social ORDER BY id DESC";  
  $result = mysqli_query($db, $sql);  
  $output .= '  
    <div class="table-responsive">  
      <table class="table table-bordered">  
        <tr>  
           <th style="font-size:13px;text-align:justify" width="250">Facebook</th>  
           <th style="font-size:13px;text-align:justify" width="250">Instagram</th>  
           <th style="font-size:13px;text-align:justify" width="250">Tumblr</th>  
           <th style="font-size:13px;text-align:justify" width="250">Deviantart</th>  
           <th style="font-size:13px;text-align:justify" width="250">Pinterest</th>
           <th style="font-size:13px;text-align:justify" width="250">Youtube</th>
           <th style="font-size:13px;text-align:justify" width="250">Behance</th>
        </tr>';  
  $rows = mysqli_num_rows($result);
  if($rows > 0) {
    while($row = mysqli_fetch_array($result)){  
      $output .= '  
        <tr>  
          <td style="font-size:13px;text-align:justify" class="facebook" data-id1="'.$row["id"].'" contenteditable>'.$row['facebook'].'</td>  
          <td style="font-size:13px;text-align:justify" class="instagram" data-id2="'.$row["id"].'" contenteditable>'.$row['instagram'].'</td>  
          <td style="font-size:13px;text-align:justify" class="tumblr" data-id3="'.$row["id"].'" contenteditable>'.$row['tumblr'].'</td>  
          <td style="font-size:13px;text-align:justify" class="deviantart" data-id4="'.$row["id"].'" contenteditable>'.$row["deviantart"].'</td>  
          <td style="font-size:13px;text-align:justify" class="pinterest" data-id5="'.$row["id"].'" contenteditable>'.$row["pinterest"].'</td>  
          <td style="font-size:13px;text-align:justify" class="youtube" data-id6="'.$row["id"].'" contenteditable>'.$row["youtube"].'</td>  
          <td style="font-size:13px;text-align:justify" class="behance" data-id7="'.$row["id"].'" contenteditable>'.$row["behance"].'</td>  
        </tr>  
      ';  
    }   
  } else {  
      $output .= '
				<tr>  
          <td id="facebook" contenteditable style="font-size:13px"></td>  
          <td id="instagram" contenteditable style="font-size:13px"></td>  
          <td id="tumblr" contenteditable style="font-size:13px"></td>  
          <td id="deviantart" contenteditable style="font-size:13px"></td>  
          <td id="pinterest" contenteditable style="font-size:13px"></td>  
          <td id="youtube" contenteditable style="font-size:13px"></td>  
          <td id="behance" contenteditable style="font-size:13px"></td>
					<td><button type="button" name="btn_add_social" id="btn_add_social" class="btn btn-xs btn-success btn-floating">+</button></td>  
        </tr>'
      ;  
    }  
  $output .= '</table>  
      </div>';  
  echo $output;  
?>