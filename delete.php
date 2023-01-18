<?php
$server="localhost";
$username="root";
$password="";
$database="create";

// connect a connection
$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
    //echo "success!";
//}
//else{
    die("error!".mysqli_connect_error());

}
if(isset($_GET['id'])){
    $empId=$_GET['id'];

    $sql="DELETE FROM `employee` WHERE `id` = '$empId'"; 
    $result=mysqli_query($conn,$sql);
 
    

}
?>