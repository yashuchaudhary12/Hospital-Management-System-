<?php
session_start();
if (!isset($_SESSION['user_id'])|| $_SESSION['role'] !== 'admin') {
  echo "<script>alert('Access denied. Please login first.'); window.location.href='../login.html';</script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Hospital Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.html">Hospital Management System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="../index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link text-warning" href="../PHP/logout.php">Logout</a></li>
        </ul>
      </div>
    </div> 
  </nav>

  <div class="container py-5">
    <h2 class="text-center mb-4 text-primary fw-bold">Admin Dashboard</h2>
    <div class="row justify-content-center g-4">
      <div class="col-md-4">
        <div class="card shadow text-center p-4">
          <h4 class="mb-2">Doctor Details</h4>
          <p class="text-muted">View and manage registered doctors.</p>
          <button class="btn btn-primary" onclick="window.location.href='Doctors/view_doctors.php'">Show Doctors</button>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow text-center p-4">
          <h4 class="mb-2">Patient Details</h4>
          <p class="text-muted">View and manage registered patients.</p>
          <button class="btn btn-success" onclick="window.location.href='Patients/view_patients.php'">Show Patients</button>
        </div>
      </div>
    </div>
  </div>

  <!-- <script>
    const loggedInUser = JSON.parse(localStorage.getItem("loggedInUser"));
    if (!loggedInUser || loggedInUser.role !== "admin") {
      alert("Access denied. Admins only.");
      window.location.href = "login.html";
    }

    document.getElementById("logoutLink").addEventListener("click", () => {
      localStorage.removeItem("loggedInUser");
      window.location.href = "index.html";
    });
  </script> -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>