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
                echo "Registered successfully";
                header("Location:../login.html");
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
