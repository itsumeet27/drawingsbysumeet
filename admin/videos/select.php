<?php  
include('../../includes/init.php');
$output = '';  
$sql = "SELECT * FROM videos ORDER BY id ASC";  
$result = $db->query($sql);  
$output .= '  
<div class="table-responsive">  
<table class="table table-bordered tablem-sm">  
<tr>  
<th style="font-size:13px;">title</th>  
<th style="font-size:13px;">url</th> 
</tr>';  
$rows = mysqli_num_rows($result);
if($rows > 0)  
{  
  while($row = mysqli_fetch_array($result))  
  {  
   $output .= '  
   <tr>  
   <td style="font-size:13px;" class="title" data-id1="'.$row["id"].'" contenteditable>'.$row["title"].'</td>  
   <td style="font-size:13px;" class="url" data-id2="'.$row["id"].'" contenteditable>'.$row["url"].'</td>  
   </tr>  
   ';  
 } 
 $output .= '
 <tr>  
  <td style="font-size:13px;" id="title" contenteditable></td>  
  <td style="font-size:13px;" id="url" contenteditable></td>  
  <td style="font-size:13px;"><button type="button" name="btn_add_videos" id="btn_add_videos" class="btn btn-xs btn-success btn-floating"><i class="fas fa-plus"></i></button></td>  
  </tr>
 ';  
}  
else  
{  
  $output .= '
  <tr>  
  <td style="font-size:13px;" id="title" contenteditable></td>  
  <td style="font-size:13px;" id="url" contenteditable></td>  
  <td style="font-size:13px;"><button type="button" name="btn_add_videos" id="btn_add_videos" class="btn btn-xs btn-success btn-floating"><i class="fas fa-plus"></i></button></td>  
  </tr>';  
}  
$output .= '</table>  
</div>';  
echo $output;  
?>