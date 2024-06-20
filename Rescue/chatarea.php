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
        <section class="chat-area">

           <header>
           <?php include_once "ddb.php";
            $user_id=mysqli_real_escape_string($con, $_GET['user_id']);
            $sqlo=mysqli_query($con,"SELECT * FROM login WHERE unique_id = {$user_id}");
            if(mysqli_num_rows($sqlo) > 0){
                $row=mysqli_fetch_assoc($sqlo);
            }
             
            ?>
            <a href="user.php"class="back-icon"><i class="fas fa-angle-left">back</i></a>
              <img src="images/<?php echo $row['image']?>" alt="img">
              <div class="details">
                <span><?php echo $row['fname'] . " " . $row['lname']?></span>
                <p><?php echo $row['status']?></p>
              </div>
           </header>
           <div class="chat-box">
            <div class="chat outgoing">
                <div class="details">
                    <p>Lorem ipsum dolor sit amet consectetur 
                     Lorem ipsum dolor sit amet consectetur 
                     adipisicing elit. Temporibus at molestias reprehenderit voluptate alias
                     aspernatur, labore quis perspiciatis voluptatem corrupti modi quasi iure
                     voluptas ab magnam ratione odit enim accusamus vel minus! Blanditiis facere
                     aut nihil totam numquam sit pariatur dolorum repellendus, id ab aspernatur 
                     placeat iste animi nostrum possimus fugit vitae accusamus modi. Nostrum velit
                     maiores natus iste delectus tempora praesentium quia cum, assumenda perferendis
                     aliquid? Commodi debitis fugit quaerat quis quas tenetur ad dolores dolor error
                     tempore sunt, officiis velit magni cupiditate perferendis rerum ut iure necessitatibus
                     , sit consectetur quibusdam totam corrupti? Est repellat dolores nobis odit debitis.
                    </p>
                </div>
            </div>
            <div class="chat incoming"> 
                <img src="Screenshot 2023-10-16 200519.png" alt="img">
                <div class="details">
                    
                    <p>Lorem ipsum dolor sit amet consectetur
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores facilis cupiditate
                         corporis doloribus voluptate laborum animi inventore, magni modi maxime! Cupiditate, 
                         odit? Expedita maxime placeat pariatur possimus corrupti, repellat eligendi.</p>
                </div>
            </div>
           </div>
         <form action="#" class="typing-area">
            <input type="text" name="outgoing_id"value="<?php echo $_SESSION['unique_id'];?>">
            <input type="text" name="incoming_id"value="<?php echo $user_id;?>">

            <input type="text" name="message" class="input-field"placeholder="type a message.....">
            <button><i class="fab fa-telegram-plane"></i></button>
         </form>
        </section>
    </div>
    <script>
  const form =  document.querySelector(".typing-area"),
  inputField = form.querySelector(".input-field"),
  sendBtn  = form.querySelector("button");
  chatbox = document.querySelector(".chat-box");
  form.onsubmit = (e)=>{
    e.preventDefault();
  }
     sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","insert-chat.php",true);
    xhr.onload=()=>{
        if(xhr.readyState ===XMLHttpRequest.DONE){
          if(xhr.status===200){
          inputField.value = "";
          }
        }


    }
    let formData=new FormData(form);
    xhr.send(formData);
}
setInterval(()=>{
         let xhr=new XMLHttpRequest();
         xhr.open("POST","get-chat.php",true);
         xhr.onload = function() {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    chatbox.innerHTML = data;
                        
                }
            }
         }
         let formData =new FormData(form);
         xhr.send(formData);
        }, 500);

</script>
</body>

</html>