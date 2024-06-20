<?php
session_start();
include("ddb.php");
     if($_SERVER['REQUEST_METHOD']=="POST"){
      
        $gmail=$_POST['mail'];
        $password=$_POST['pass'];

            if(!empty($gmail)  &&  !empty($password)  &&  !is_numeric($gmail)){
            $query= "SELECT * FROM login WHERE email= '{$gmail}' AND password='{$password}'";
            $result = mysqli_query($con,$query);
            if($result){
                if($result && mysqli_num_rows($result)>0){
                    $user_data=mysqli_fetch_assoc($result);
                    $_SESSION['unique_id']=$user_data['unique_id'];
                    if($user_data['password']==$password){
                        header("location: user.php");
                        die;
                    }
                }
            }
        
        echo "<script type='text/javascript'>alert('wrong username or password')</script>";
        }
        else{
            echo "<script type='text/javascript'>alert('wrong username or passward')</script>";
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
    <div class="login">
        <h1>login</h1>
        
        <form method="POST" >
            <label >Email</label>
            <input type="email" name="mail"required>
            <label >Password</label>
            <input type="password" name="pass"required>
            
            <input type="submit" name=""value="Submit">

        </form>
        
         <p class="pp">don't have an account?<a href="signup.php">Sign up here</a></p> <a href=""></a>
    </div>
    
</body>
</html>