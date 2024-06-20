<?php
session_start();
if(isset($_SESSION["unique_id"])){
    include_once "ddb.php";
    $outgoing_id =mysqli_real_escape_string($con,$_POST['outgoing_id']);
    $incoming_id =mysqli_real_escape_string($con,$_POST['incoming_id']);
    $output = "";

    $sql= "SELECT * FROM messages WHERE (outgoing_msg_id={$outgoing_id} AND incoming_msg_id ={$incoming_id})
    OR  (outgoing_msg_id={$incoming_id} AND incoming_msg_id ={$outgoing_id}) ORDER BY msg_id DESC";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query)>0){
        while($row= mysqli_fetch_assoc($query)){
            if($row['outgoing_msg_id']===$outgoing_id){
                $output .='<div class="chat outgoing">
                <div class="details">
                    <p>'. $row['msg'].' 
                    </p>
                </div>
            </div>';
            }
            else{
                $output .= '  <div class="chat incoming"> 
                <img src="Screenshot 2023-10-16 200519.png" alt="img">
                <div class="details">
                <p>'. $row['msg'].' 
                </p>
                   
                </div>
            </div>';
            }
        }
        echo $output;
    }
}
else{
    header("location:login.php");
    
}
?>