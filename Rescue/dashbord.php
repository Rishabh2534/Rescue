
<?php
session_start();
if(!isset($_SESSION["unique_id"])){
  header("location:login.php");
}

include("ddb.php");
$unid=$_SESSION['unique_id'];
     if($_SERVER['REQUEST_METHOD']=="POST"){

        $postHeading=$_POST['postH'];
        $postDetail=$_POST['postD'];
        if(isset($_FILES["upload"])){
          $img_name=$_FILES["upload"]["name"];
          $img_type=$_FILES["upload"]["type"];
          $tmp_name=$_FILES["upload"]["tmp_name"];
          $img_explode=explode('.',$img_name);
         $img_ext=end($img_explode);

         $extensions=['png','jpeg','jpg'];
         if(in_array($img_ext,$extensions)==true){
          $time=time();
          $new_img_name=$time.$img_name;
                 move_uploaded_file($tmp_name,"images/".$new_img_name);

          $query2 = "insert into post (unique_id,postHe,postDe,image) values('$unid','$postHeading','$postDetail','$new_img_name')";
          mysqli_query($con, $query2);
          echo "succesfully posted";
         }
        }
      }
      else echo "either post heading or post description is empty";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>
    <div id="post">
  <div class=" dashbordContainer">
    <div class="dashboardSearchAr">
        <input type="text" placeholder="search your post" >
        <button >search</button>
    </div>
    <div class="DashbordlistOfPosts">
      <a href="#"> <img src="Screenshot 2023-10-16 200519.png" alt="" width="100px">
        <span class="text"> this is a post</span>
      </a>
      <a href="#"> <img src="Screenshot 2023-10-16 200519.png" alt="" width="100px">
        <span class="text"> this is a post</span>
      </a>
      <a href="#"> <img src="Screenshot 2023-10-16 200519.png" alt="" width="100px">
        <span class="text"> this is a post</span>
      </a>
    </div>
    
  </div>
  <div class="postingspot">
    <div class="composePost">
      <form method="POST" enctype="multipart/form-data" class="dashbordPost">
        <label >write the post heading</label>
        <textarea  name="postH" id="postheading" cols="86" rows="1"></textarea>
        <label>write the discription of post</label>
        <textarea name="postD" id="postheading" cols="86" rows="10" fixed></textarea>
        <label >Select Image</label>
            <input type="file" name="upload">
        <button >POST</button>
      </form>
    </div>
</div>
</div>
<script>
 DashbordlistOfPosts=document.querySelector(".DashbordlistOfPosts"); 
/*var data = 1;
var xh = new XMLHttpRequest();
xh.open("POST", "userun.php", true);
xh.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xh.send("data=" + data);*/
  

         let xhr=new XMLHttpRequest();


         xhr.open("GET","userun.php?data=1",true);
         xhr.onload = function() {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    
                      DashbordlistOfPosts.innerHTML = data;}
                
            }
         }
         xhr.send();
        
</script>  
</body>
</html>