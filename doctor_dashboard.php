<?php
session_start();
if (!isset($_SESSION['user_id'])|| $_SESSION['role'] !== 'doctor') {
  echo "<script>alert('Access denied. Please login first.'); window.location.href='login.html';</script>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">← Home</a>
      <span class="navbar-text text-white">Doctor Dashboard</span>
    </div>
  </nav>

  <div class="container mt-4">
    <h3 class="text-center mb-4">Welcome Doctor</h3>
    <div class="row text-center">
      <div class="col-md-4 mb-3">
        <div class="card p-3 shadow-sm">
          <h5>View Appointments</h5>
          <p>Check upcoming patient appointments</p>
          <button class = "btn btn-success" onclick="window.location.href='./Doctors/view_appointments.php'">View Appointment</button>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card p-3 shadow-sm">
          <h5>Upload Reports</h5>
          <p>Upload patient diagnosis or reports</p>
          <button class = "btn btn-success">Upload Report</button>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card p-3 shadow-sm">
          <h5>Manage Patients</h5>
          <p>View and update patient details</p>
          <button class = "btn btn-success">Manage Patients</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>