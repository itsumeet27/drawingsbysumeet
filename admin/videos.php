<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
		include('includes/header.php');
?>

	<h3 class="h3-responsive text-center p-3 title">VIDEOS</h3>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

	<div class="container-fluid" style="margin: 2em 0;">
    <h5 class="text-justify py-2">Videos Details&nbsp;&nbsp;<i class="fas fa-info-circle" title="Edit videos Details"></i> <hr style="width: 75px;border:2px solid #666;border-radius:50%"></h5>
    <span id="result_videos"></span>
    <div id="live_data_videos"></div>
  </div>

  <script type="text/javascript">
    $(document).ready(function(){  
        function fetch_videos_data()  
        {  
            $.ajax({  
                url:"videos/select.php",  
                method:"POST",  
                success:function(data){  
                    $('#live_data_videos').html(data);  
                }  
            });  
        }  
        fetch_videos_data();  
        $(document).on('click', '#btn_add_videos', function(){  
            var title = $('#title').text();  
            var url = $('#url').text();

            if(title == '')  
            {  
                alert("Enter title");  
                return false;  
            }  
            if(url == '')  
            {  
                alert("Enter url");  
                return false;  
            } 
             
            $.ajax({  
                url:"videos/insert.php",  
                method:"POST",  
                data:{title:title, url:url},  
                dataType:"text",  
                success:function(data)  
                {  
                    $('#result_videos').html("<div class='alert alert-success'>"+data+"</div>");
                    fetch_videos_data();  
                    setTimeout(location.reload.bind(location), 500);
                }  
            })  
        });  
        
      function edit_videos_data(id, text, column_name)  
        {  
            $.ajax({  
                url:"videos/edit.php",  
                method:"POST",  
                data:{id:id,text:text,column_name:column_name},  
                dataType:"text",  
                success:function(data){  
                    //alert(data);
                    $('#result_videos').html("<div class='alert alert-success'>"+data+"</div>");
                    setTimeout(location.reload.bind(location), 500);
                }  
            });  
        }  
        $(document).on('blur', '.title', function(){  
            var id = $(this).data("id1");  
            var title = $(this).text();  
            edit_videos_data(id, title, "title");  
        });  
        $(document).on('blur', '.url', function(){  
            var id = $(this).data("id2");  
            var url = $(this).text();  
            edit_videos_data(id,url, "url");  
        });  
    }); 
  </script>

<?php include('includes/footer.php'); } ?>