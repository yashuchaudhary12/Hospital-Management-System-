<?php
    include "../PHP/connection.php";
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
        $specialization=$_POST['specialization'];
        $qualification=$_POST['qualification'];
        $yoe=$_POST['years_of_experience'];
        $consultation_fee=$_POST['consultation_fee'];
        $available_days=$_POST['available_days'];

        $sql="INSERT INTO doctors(`id`,`full_name`,`gender`,`date_of_birth`,`phone`,`email`,`specialization`,`qualification`,`years_of_experience`,`consultation_fee`,'available_days`)values($user_id,$full_name,$gender,$dob,$phone,$email,$specialization,$qualification,$yoe,$consultation_fee,$available_days);";

        if($con->query($sql)){
            echo"DOCTOR added successfully";
        }
        else{
            echo"ERROR:".$con->error;
        }
    }
?>