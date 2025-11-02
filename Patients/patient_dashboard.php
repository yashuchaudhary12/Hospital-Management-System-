<?php
session_start();
if (!isset($_SESSION['user_id'])|| $_SESSION['role'] !== 'patient') {
  echo "<script>alert('Access denied. Please login first.'); window.location.href='login.html';</script>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.html">← Home</a>
      <span class="navbar-text text-white">Patient Dashboard</span>
    </div>
  </nav>

  <div class="container mt-4">
    <h3 class="text-center mb-4">Welcome Patient</h3>
    <div class="row text-center">
      <div class="col-md-4 mb-3">
        <div class="card p-3 shadow-sm">
          <h5>View Appointment</h5>
          <p>Access your Appointment reports</p>
          <button class = "btn btn-success" onclick="window.location.href='view_appointments.php'">View Appointments</button>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card p-3 shadow-sm">
          <h5>Book Appointment</h5>
          <p>Book appointment with available doctors</p>
          <button class = "btn btn-success" onclick="window.location.href='add_appointment.php'">Book Appointment</button>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card p-3 shadow-sm">
          <h5>Profile</h5>
          <p>View and edit your personal information</p>
          <button class = "btn btn-success">Show Profile</button>
        </div>
      </div>
    </div>
  </div>
  <footer>&copy;Hospital-Management-System</footer>
</body>
</html>