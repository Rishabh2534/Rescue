<?php
session_start();
include_once "ddb.php";

if(isset($_GET['userlist'])){
$sql= mysqli_query($con,"SELECT * FROM login");
$output = "";
if(mysqli_num_rows($sql)  ==  1){
 $output .= "No user are available to chat";
}
elseif(mysqli_num_rows($sql) > 0){
    $selector=0;
include "data.php";
echo $output;
die();
}}
else if(isset($_GET['data'])){

$sqlD=mysqli_query($con,"SELECT * FROM post");
$output="";
if(mysqli_num_rows($sqlD)>0){
    $selector=1;
    include "data.php";
    echo $output;
    die();
}}

?>