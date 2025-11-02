<?php
include '../PHP/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $con->query("UPDATE appointments SET status='Cancelled' WHERE appointment_id='$id'");
    echo "<script>alert('Appointment cancelled successfully!'); window.location='view_appointments.php';</script>";
}
?>
