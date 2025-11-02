<?php
include "../PHP/connection.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $patient_id=$_POST['patient_id'];
    $doctor_id=$_POST['doctor_id'];
    $appointment_date=$_POST['appointment_date'];
    $appointment_time=$_POST['appointment_time'];
    $symptoms=$_POST['symptoms'];

    $datetime=$appointment_date.' '.$appointment_time;

    $check="select* from appointments where doctor_id='$doctor_id' and appointment_date='$datetime' and status='Scheduled'";

    $result=$con->query($check);

    if($result->num_rows>0){
        echo "<script>alert('Doctor alresdy has an appointment at this time.');</script>";
    }
    else{
        $sql="insert into appointments (doctor_id,patient_id,appointment_date,symptoms)values('$doctor_id','$patient_id','$datetime','$symptoms')";

        if($con->query($sql)==true){
            echo "<script>alert('Appointment booked successfully!');</script>";
        }
        else{
            echo"Error:".$con->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Hospital-Management-System | Book Appointment</title>
    <style>
        body{
            font-family:Arial, Helvetica, sans-serif;
            margin:0;
            padding:0;
        }
        header{
            background-color: #007bff;
            color:white;
            padding:15px 20px;
            text-align: center;
            font-size: 24px;
            letter-spacing: 0.5px;
        }

        .container{
            width:90%;
            max-width:550px;
            margin:50px auto;
            padding:30px 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }

        h2{
            text-align:center;
            color:#007bff;
            margin-bottom:20px;
        }

        label{
            font-weight: 400;
            display: block;
            margin-bottom:5px;
            color:black;
        }

        input[type="text"],input[type="date"],input[type="time"],textarea{
            width:100%;
            padding:10px;
            margin-bottom:12px;
            border: 1px solid #ccccccff;
            border-radius: 5px;
            font-size:15px;
            box-sizing:border-box;
        }

        textarea{
            resize:none;
        }

        input[type="submit"]{
            width:100%;
            padding:12px;
            background-color: #007bff;
            border:none;
            color:white;
            font-size:18px;
            border-radius: 8px;
            cursor:pointer;
            transition:background-color 0.3s;
        }
        input[type="submit"]:hover{
            background-color:green;
        }
    </style>
    </head>
    <body>
        <header>Hospital Management System</header>
        <div class="container">
            <h2>Book Appointment</h2>
            <form method="POST" action="">
                <label for="">Patient Id:</label>
                <input type="text" name="patient_id" id="" required><br><br>

                <label for="">Doctor_id:</label>
                <input type="text" name="doctor_id" id="" required><br><br>

                <label for="">Appointment Date:</label>
                <input type="date" name="appointment_date" id="" required><br><br>

                <label for="">Appointment Time:</label>
                <input type="time" name="appointment_time" id="" required><br><br>

                <label for="">Symptoms:</label>
                <textarea name="symptoms" rows="3" cols="40" id="" required></textarea><br><br>

                <input type="submit" value="Book Appointment">
            </form>
        </div>
    </body>
</html>