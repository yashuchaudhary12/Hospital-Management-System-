<?php
session_start();
include '../PHP/connection.php';

// if (!isset($_SESSION['role'])) {
//     $_SESSION['role'] = 'admin';
//     $_SESSION['username'] = 'TestAdmin';
// }

if ($_SESSION['role'] !== 'admin') {
    die("Unauthorized access");
}

$sql = "
SELECT d.doctor_id, d.full_name, d.gender, d.date_of_birth, d.phone, d.email,
       d.specialization, d.qualification, d.years_of_experience,
       d.consultation_fee, d.available_days, d.created_at
FROM doctors d
INNER JOIN users u ON d.id = u.id
WHERE u.role = 'doctor'
";

$result = $con->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>View Doctors</title>
<style>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f8f9fb;
  margin: 0;
  padding: 0;
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
  color: #161616ff;
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
<body>
  <div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Specialization</th>
                <th>Qualification</th>
                <th>Years of Experience</th>
                <th>Consultation Fee</th>
                <th>Available Days</th>
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
                    <td>{$row['doctor_id']}</td>
                    <td>{$row['full_name']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['date_of_birth']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['specialization']}</td>
                    <td>{$row['qualification']}</td>
                    <td>{$row['years_of_experience']}</td>
                    <td>{$row['consultation_fee']}</td>
                    <td>{$row['available_days']}</td>
                    <td>{$row['created_at']}</td>
                    <td>
                        <a href='delete_doctor.php?id={$row['doctor_id']}' 
                           class='btn-danger'
                           onclick='return confirm(\"Are you sure you want to delete this doctor?\");'>
                           Delete
                        </a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='13' class='text-center'>No doctors found.</td></tr>";
        }
        ?>
        </tbody>
    </table>
  </div>
</body>
</html>
