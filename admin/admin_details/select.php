<?php  
include('../../includes/init.php');
$output = '';  
$sql = "SELECT * FROM admin ORDER BY admin_id ASC";  
$result = $db->query($sql);  
$output .= '  
<div class="table-responsive">  
<table class="table table-bordered tablem-sm">  
<tr>  
<th style="font-size:13px;">Username</th>  
<th style="font-size:13px;">Password</th> 
</tr>';  
$rows = mysqli_num_rows($result);
if($rows > 0)  
{  
  while($row = mysqli_fetch_array($result))  
  {  
   $output .= '  
   <tr>  
   <td style="font-size:13px;" class="username" data-id1="'.$row["admin_id"].'" contenteditable>'.$row["username"].'</td>  
   <td style="font-size:13px;" class="password" data-id2="'.$row["admin_id"].'" contenteditable>'.$row["password"].'</td>  
   </tr>  
   ';  
 }   
}  
else  
{  
  $output .= '
  <tr>  
  <td style="font-size:13px;" id="username" contenteditable></td>  
  <td style="font-size:13px;" id="password" contenteditable></td>  
  <td style="font-size:13px;"><button type="button" name="btn_add_admin" id="btn_add_admin" class="btn btn-xs btn-success btn-floating"><i class="fas fa-plus"></i></button></td>  
  </tr>';  
}  
$output .= '</table>  
</div>';  
echo $output;  
?>