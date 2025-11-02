<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $check_sql = "select* from users where email=?";
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        echo "This email address is already registered. Please use another email.";
        $check_stmt->close();
    } else {
        $check_stmt->close();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "insert into `users`(`username`,`email`,`password`,`role`)values(?,?,?,?);";

        $stmt = $con->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);
            if ($stmt->execute()) {
                $user_id=$stmt->insert_id;
            if($role==="patient"){
                $patient_sql="insert into patients(id,full_name,email)values(?,?,?)";
                $patient_stmt=$con->prepare($patient_sql);
                $patient_stmt->bind_param("iss",$user_id,$username,$email);
                $patient_stmt->execute();
                $patient_stmt->close();
            }

            if($role==="doctor"){
                $doctor_sql="insert into doctors(id,full_name,email)values(?,?,?)";
                $doctor_stmt=$con->prepare($doctor_sql);
                $doctor_stmt->bind_param("iss",$user_id,$username,$email);
                $doctor_stmt->execute();
                $doctor_stmt->close();
            }

                echo "<script>alert('Registered successfully! Redirecting to login page...'); window.location.href='../login.html';</script>";
                exit;
            } else {
                echo "Error:" . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "error:";
        }
    }
    $con->close();
}
