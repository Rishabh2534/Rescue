
<?php
session_start();
include("ddb.php");
     if($_SERVER['REQUEST_METHOD']=="POST"){

        $firstname=$_POST['fname'];
        $lastname=$_POST['lname'];
        $gender=$_POST['gender'];
        $num=$_POST['number'];
        $address=$_POST['add'];
        $gmail=$_POST['mail'];
        $password=$_POST['pass'];
      
        if(!empty($gmail)  &&  !empty($password)  &&  !is_numeric($gmail)){
            if(filter_var($gmail,FILTER_VALIDATE_EMAIL)){
               $sql=mysqli_query($con,"SELECT email FROM login WHERE email= '{$gmail}'");
               if(mysqli_num_rows($sql)>0){
                echo"already exist";
               }
               else{
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
                if( move_uploaded_file($tmp_name,"images/".$new_img_name)){
                   $status="Active now";
                   $random_id=rand(time(),100000000);
                

                   $query="insert into login (unique_id,fname,lname,gender,cnum,address,email,image,password,status) values('$random_id','$firstname','$lastname','$gender','$num','$address','$gmail','$new_img_name','$password','$status')";
                   if( mysqli_query($con, $query)){
                    $sql3=mysqli_query($con,"SELECT * FROM login WHERE email='{$gmail}'");
                    if(mysqli_num_rows($sql3)>0){
                        $row=mysqli_fetch_assoc($sql3);
                        $_SESSION['unique_id']=$row['unique_id'];
                        echo "<script type='text/javascript'>alert('Successfully registered')</script>";
                    }
                   }
                   else{echo "something went wrong";}

                  }
                }
                else{
                    echo"please insert a jpg file";
                }
                }
                else{
                    echo "please insert an  image";
                }
               
            }}
            else{
                echo"email is not valid";
            }
           
        }
         else{
                echo"<script type='text/javascript'>alert(' please enter valid info')</script>"; 
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup">
        <h1>sign up</h1>
        <h4>it's free and only takes a minute</h4>
        <form method="POST" enctype="multipart/form-data">
            <div class="error-txt">this is error message</div>
            <label >First Name</label>
            <input type="text" name="fname"required>
            <label >Last Name</label>
            <input type="text" name="lname"required>
            <label >Gender</label>
            <input type="text" name="gender"required>
            <label >Contact no</label>
            <input type="tel" name="number"required>
            <label >Address</label>
            <input type="text" name="add"required>
            <label >Email</label>
            <input type="email" name="mail"required>
            <label >Password</label>
            <input type="password" name="pass"required>
            <label >Select Image</label>
            <input type="file" name="upload">
            
            <input type="submit" name="sub"value="Submit">

        </form>
        <p class="pp">By clicking sign up button you agree to our <br>
        <a href="">terms and condition</a> and <a href="#">privacy policy</a>
         </p>
         <p class="pp">Already have an account?<a href="login.php">Login here</a></p>
    </div>
    
</body>
</html>