<?php
session_start();
include '../PHP/connection.php';

// if (!isset($_SESSION['role'])) {
//     $_SESSION['role'] = 'admin';
//     $_SESSION['username'] = 'TestAdmin';
// }

if($_SESSION['role']!=='admin'){
    die("Unauthorized access");
}
$sql="select p.patient_id,p.full_name,p.gender,p.phone,p.email,p.blood_group,p.created_at
from patients p 
inner join users u on p.id=u.id 
where u.role='patient'";

$result=$con->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>View Patients</title>
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

</style>
</head>
<body>
  <div>
    <table border=1>
        <thead >
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
                        <a href='delete_patients.php?id={$row['doctor_id']}' 
                           class='btn-danger'
                           onclick='return confirm(\"Are you sure you want to delete this patient?\");'>
                           Delete
                        </a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='9' class='text-center'>No patients found.</td></tr>";
        }
        ?>
        </tbody>
    </table>
  </div>
</body>
</html>