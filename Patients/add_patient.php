<?php
    include "PHP/connection.php";
    if($_SESSION['REQUEST_METHOD']!=='admin'){
        die("Unauthorized access");
    }
    if($_SERVER['REQUEST_METHOD']=='$_POST'){
        $user_id=$_POST['user_id'];
        $full_name=$_POST['full_name'];
        $email=$_POST['email'];
        $gender=$_POST['gender'];
        $phone=$_POST['phone'];
        $dob=$_POST['date_of_birth'];
        $address=$_POST['address'];
        $blood_group=$_POST['blood_group'];

        $sql="INSERT INTO patients(`id`,`full_name`,`gender`,`date_of_birth`,`phone`,`email`,`address`,`blood_group`)values($user_id,$full_name,$gender,$dob,$phone,$email,$address,$blood_group);";

        if($con->query($sql)){
            echo"Patient added successfully";
        }
        else{
            echo"ERROR:".$con->error;
        }
    }
?>