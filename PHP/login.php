<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = "SELECT* FROM users WHERE email = ?";
    $stmt = $con->prepare($query);

    if (!$stmt) {
        
        echo "<script>alert('Server error. Please try again later.'); window.history.back();</script>";
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Use of password_verify to check the hashed password
        if (password_verify($password, $user['password'])) {
            // Regenerate session id 
            session_regenerate_id(true);

            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email']    = $user['email'];
            $_SESSION['role']     = $user['role'];

            // Redirection to role-based dashboard
            if ($user['role'] === 'admin') {
                header("Location: ../Admin/admin_dashboard.php");
            } elseif ($user['role'] === 'doctor') {
                header("Location: ../Doctors/doctor_dashboard.php"); 
            } else {
                header("Location: ../Patients/patient_dashboard.php");
            }
            $stmt->close();
            $con->close();
            exit;
        } else {
            
            echo "<script>alert('Invalid email or password.'); window.history.back();</script>";
        }
    } else {
       
        echo "<script>alert('Invalid email or password.'); window.history.back();</script>";
    }

    $stmt->close();
    $con->close();
}
?>
