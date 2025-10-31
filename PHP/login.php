<?php
    session_start();
    include 'connection.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $email=$_POST['email'];
        $password=$_POST['password'];

        $query="select* from users where email=?";
        $stmt=$con->prepare($query);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result=$stmt->get_result();

        if($result->num_rows==1){
            $user=$result->fetch_assoc();

            if($password==$user['password']){
                $_SESSION['user_id']=$user['user_id'];
                $_SESSION['role']=$user['role'];
                $_SESSION['username']=$user['username'];

                if($user['role']=='admin'){
                    header("Location: ../admin_dashboard.php");
                }
                elseif($user['role']=='doctor'){
                    header("Location: ../doctor_dasboard.php");
                }
                else{
                    header("Location: ../patient_dashboard.php");
                }
                exit();
            }
            else{
                echo"Invalid password";
            }
        }
        else{
            echo"No user found with this email";
        }
    }

?>