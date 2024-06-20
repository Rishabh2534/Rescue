<?php
session_start();
if(!isset($_SESSION["unique_id"])){
    header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <section class="user">

           <header>
            <?php include_once "ddb.php";
            $sql=mysqli_query($con,"SELECT * FROM login WHERE unique_id={$_SESSION["unique_id"]}");
            if(mysqli_num_rows($sql)>0){
                $row=mysqli_fetch_assoc($sql);
            }

            ?>
            <div class="content">
              <img src="images/<?php echo $row['image']?>" alt="">
              <div class="details">
                <span><?php echo $row['fname'] . " " . $row['lname']?></span>
                <p><?php echo $row['status']?></p>
              </div>
            </div>
            <a href="#" class="logout">logout</a>

           </header>

           <div class="search">
            <span class="text">Selact an user to start chat</span>
            <input type="text"placeholder="enter the name to search...">
            <button><i class="fas fa-search"></i></button>
           </div>
            <div class="user-list">
                <a href="#">
                    <div class="content">
                        <img src="Screenshot 2023-10-16 200519.png" alt="">
                        <div class="details">
                            <span>Coding r</span>
                            <p>this is text message</p>
                          </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>
                

            </div>
        </section>
    </div>
    <script>
        const searchbar=document.querySelector(".user .search input");
        user_list=document.querySelector(".user .user-list");

        searchbar.onkeyup =()=>{
            let searchTerm = searchbar.value;


            if(searchTerm !=""){
                searchbar.classList.add("active");
            }
            else{ searchbar.classList.remove("active");}
            let xhr=new XMLHttpRequest();
            xhr.open("POST","search.php?userlist=2",true);
            xhr.onload = function() {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    user_list.innerHTML = data;
                }
            }
         }
         xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
         xhr.send("searchTerm="+searchTerm);
        }




        setInterval(()=>{
         let xhr=new XMLHttpRequest();
         xhr.open("GET","userun.php?userlist=2",true);
         xhr.onload = function() {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    if(!searchbar.classList.contains("active")){
                        user_list.innerHTML = data;}
                }
            }
         }
         xhr.send();
        }, 500);
    </script>
</body>
</html>