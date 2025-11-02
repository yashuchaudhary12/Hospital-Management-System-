<?php
include '../PHP/connection.php';
session_start();

// Check if logged in as doctor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'doctor') {
  echo "<script>alert('Please login first!'); window.location.href='../login.html';</script>";
  exit;
}

//get actual doctor id using user id
$user_id = $_SESSION['user_id'];
$doctor_query = "SELECT doctor_id FROM doctors WHERE id = '$user_id'";
$doctor_result = $con->query($doctor_query);

if ($doctor_result->num_rows > 0) {
  $doctor_row = $doctor_result->fetch_assoc();
  $doctor_id = $doctor_row['doctor_id'];
} else {
  echo "<script>alert('Doctor record not found!'); window.location.href='../login.html';</script>";
  exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
  $appointment_id = $_POST['appointment_id'];
  $diagnosis = $con->real_escape_string($_POST['diagnosis']);
  $prescription = $con->real_escape_string($_POST['prescription']);

  $update_query = "UPDATE appointments 
                   SET diagnosis = '$diagnosis', prescription = '$prescription', status = 'completed'
                   WHERE appointment_id = '$appointment_id' AND doctor_id = '$doctor_id'";

  if ($con->query($update_query)) {
    echo "<script>alert('Appointment updated successfully!'); window.location.href='view_appointments.php';</script>";
    exit;
  } else {
    echo "<script>alert('Error updating appointment: " . $con->error . "');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>My Appointments</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: "Segoe UI", sans-serif;
      background-color: #f4f8fc;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1000px;
      margin: 60px auto;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      padding: 30px 40px;
    }

    h3 {
      text-align: center;
      color: #0078d7;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 15px;
    }

    th,
    td {
      padding: 12px 14px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    th {
      background: #0078d7;
      color: #fff;
      font-weight: 600;
    }

    tr:hover {
      background: #f9fbff;
    }

    .btn {
      padding: 7px 12px;
      border-radius: 6px;
      font-size: 13px;
      text-decoration: none;
      cursor: pointer;
      transition: 0.2s;
    }

    .btn-primary {
      background-color: #0078d7;
      color: #fff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #005fa3;
    }

    .text-center {
      text-align: center;
    }

    .text-muted {
      color: #777;
    }

    .table-wrapper {
      overflow-x: auto;
    }
 
  footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #222;
    color: white;
    text-align: center;
    padding: 10px 0;
    font-size: 14px;
  }

  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Hospital Management System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="doctor_dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
          <li class="nav-item"><a class="nav-link text-warning" href="../PHP/logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <h3>My Appointments</h3>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Patient</th>
            <th>Date & Time</th>
            <th>Symptoms</th>
            <th>Diagnosis</th>
            <th>Prescription</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT a.*, p.full_name AS patient_name 
                  FROM appointments a
                  JOIN patients p ON a.patient_id = p.patient_id
                  WHERE a.doctor_id = '$doctor_id'
                  and a.status!='cancelled'
                  ORDER BY a.appointment_date DESC";
          $result = $con->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <form method='POST' action=''>
                        <td>{$row['patient_name']}</td>
                        <td>{$row['appointment_date']}</td>
                        <td>{$row['symptoms']}</td>
                        <td>
                          <textarea name='diagnosis' class='form-control' rows='2' placeholder='Enter diagnosis'>" . htmlspecialchars($row['diagnosis']) . "</textarea>
                        </td>
                        <td>
                          <textarea name='prescription' class='form-control' rows='2' placeholder='Enter prescription'>" . htmlspecialchars($row['prescription']) . "</textarea>
                        </td>
                        <td>
                          <input type='hidden' name='appointment_id' value='{$row['appointment_id']}'>
                          <button type='submit' name='update' class='btn btn-success'>Save</button>
                        </td>
                      </form>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='6' class='text-center text-muted'>You have no appointments yet.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <footer>&copy;Hospital-Management-System</footer>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'></script>
</body>

</html>