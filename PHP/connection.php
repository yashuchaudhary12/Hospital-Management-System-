<?php
$server="localhost";
$username="root";
$password="";
$database="hospital_db";
$con=mysqli_connect($server,$username,$password,$database);
if(!$con){
    die("Connection Failed:".mysqli_connect_error());
}
else{
    //echo"Connection successful";
}
//$con->close();
?>