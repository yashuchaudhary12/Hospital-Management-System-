<?php
    include"PHP/connection.php";
    if($_SESSION['role']!=='admin'){
        die("Unauthorized access");
    }

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql="delete from users where id=$id";

        if($con->query($sql)){
            echo"Patient deleted successfully";
        }
        else{
            echo"Error:".$conn->error;
        }
    }
?>