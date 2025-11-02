<?php
session_start();
include '../../PHP/connection.php';

// Check if admin is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Unauthorized access");
}

$sql = "SELECT p.patient_id, p.full_name, p.gender, p.date_of_birth, p.phone, p.email, p.blood_group, p.created_at
        FROM patients p 
        INNER JOIN users u ON p.id = u.id 
        WHERE u.role = 'patient'";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Patients</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fb;
      margin: 0;
      padding: 0;
    }

    h2 {
      text-align: center;
      margin: 20px 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background: #007bff;
      color: white;
      text-transform: uppercase;
      font-size: 14px;
    }

    th, td {
      padding: 14px 16px;
      text-align: center;
      border-bottom: 1px solid #e0e0e0;
    }

    tbody tr:hover {
      background: #f1f7ff;
      transition: 0.3s;
    }

    td {
      color: #161616;
    }

    .btn-danger {
      background-color: #dc3545;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
    }

    .btn-danger:hover {
      background-color: #c82333;
    }
  </style>
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="../admin_dashboard.php">Hospital Admin</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="../admin_dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="">Patients</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Doctors/view_doctors.php">Doctors</a>
          </li>
          <li class="nav-item">
            <span class="nav-link text-white">Welcome, <?php echo $_SESSION['username']; ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link text-warning fw-bold" href="../../PHP/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <h2>Patients</h2>
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-primary text-center">
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Blood Group</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "
              <tr>
                <td>{$row['patient_id']}</td>
                <td>{$row['full_name']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['date_of_birth']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['email']}</td>
                <td>{$row['blood_group']}</td>
                <td>{$row['created_at']}</td>
                <td>
                  <a href='delete_patients.php?id={$row['patient_id']}' 
                     class='btn btn-danger btn-sm'
                     onclick='return confirm(\"Are you sure you want to delete this patient?\");'>
                     Delete
                  </a>
                </td>
              </tr>";
          }
        } else {
          echo "<tr><td colspan='9' class='text-center text-muted'>No patients found.</td></tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
<footer>&copy;Hospital-Management-System</footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
