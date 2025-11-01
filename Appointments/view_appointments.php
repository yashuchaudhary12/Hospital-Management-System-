<?php
include '../PHP/connection.php';
session_start();

if (!isset($_SESSION['patient_id'])) {
  echo "<script>alert('Please login first!'); window.location.href='../login.html';</script>";
  exit;
}

$patient_id = $_SESSION['patient_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Appointments</title>
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
    th, td {
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
    .badge {
      display: inline-block;
      padding: 5px 10px;
      border-radius: 8px;
      font-size: 13px;
      text-align: center;
    }
    .badge.scheduled { background: #fff3cd; color: #856404; }
    .badge.completed { background: #d4edda; color: #155724; }
    .badge.cancelled { background: #f8d7da; color: #721c24; }

    .btn {
      padding: 7px 12px;
      border-radius: 6px;
      font-size: 13px;
      text-decoration: none;
      cursor: pointer;
      transition: 0.2s;
    }
    .btn-danger {
      color: #fff;
      background: #d9534f;
      border: none;
    }
    .btn-danger:hover {
      background: #c9302c;
    }
    .btn-primary {
      background-color: #0078d7;
      color: #fff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #005fa3;
    }
    .text-center { text-align: center; }
    .text-muted { color: #777; }
    .mt-3 { margin-top: 25px; }

    .table-wrapper {
      overflow-x: auto;
    }
  </style>
</head>
<body>
  <div class="container">
    <h3>My Appointments</h3>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Doctor</th>
            <th>Date & Time</th>
            <th>Symptoms</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT a.*, d.full_name AS doctor_name 
                  FROM appointments a
                  JOIN doctors d ON a.doctor_id = d.doctor_id
                  WHERE a.patient_id = '$patient_id'
                  ORDER BY a.appointment_date DESC";
          $result = $con->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $statusClass = strtolower($row['status']);
              echo "<tr>
                      <td>{$row['appointment_id']}</td>
                      <td>{$row['doctor_name']}</td>
                      <td>{$row['appointment_date']}</td>
                      <td>{$row['symptoms']}</td>
                      <td><span class='badge {$statusClass}'>{$row['status']}</span></td>
                      <td>
                        <a href='cancel_appointment.php?id={$row['appointment_id']}' class='btn btn-danger'>Cancel</a>
                      </td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='6' class='text-center text-muted'>You have no appointments yet.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="text-center mt-3">
      <a href="book_appointment.php" class="btn btn-primary">+ Book New Appointment</a>
    </div>
  </div>
</body>
</html>
