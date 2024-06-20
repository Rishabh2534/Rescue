<?php
include_once "ddb.php";
$searchTerm = mysqli_real_escape_string($con , $_POST['searchTerm']);
$output="";
$selector=0;
$sql =mysqli_query($con,"SELECT * FROM login WHERE fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%'");
if(mysqli_num_rows($sql)>0){
 include "data.php";
}else{
  $output .="no user found related";
}
echo $output;

?>