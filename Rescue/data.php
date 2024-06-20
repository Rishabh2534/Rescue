<?php
$selecto=$selector;
if($selecto===0){               /*0 for the search and the userrun flie*/
  while($row = mysqli_fetch_assoc($sql)){
    $output .='<a href="chatarea.php?user_id='.$row['unique_id'].'">
                <div class="content">
                  <img src="images/'. $row['image'] .'" alt="">
                <div class="details">
                     <span>'. $row['fname'] . " " . $row['lname'] .'</span>
                     <p>this is text message</p>
               </div>
               </div>
              <div class="status-dot"><i class="fas fa-circle"></i></div>
               </a>';
}}
else if($selecto===1){
  while(($row=mysqli_fetch_assoc($sqlD))&&($_SESSION["unique_id"]===$row['unique_id'])){
    $output .='<a href="#"> <img src="images/'. $row['image'].'" alt="image" width="100px">
    <span class="text">'. $row['postDe'] .'</span>
  </a> ';
  }
}
?>