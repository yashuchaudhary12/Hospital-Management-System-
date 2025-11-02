# Hospital Management System
A **web-based Hospital Management System** that provides separate dashboards for **Admins, Doctors, and Patients**.  
It streamlines hospital operations like appointments, prescriptions, and user management with role-based access and secure authentication.

## Features
- Role-based User login and registration
- Secure authentication
- Session based authentication and logout system
- Admin dashboard
- Patient Dashboard
- Doctor Dashboard
- Book,Cancel or view Appointments
- Password encryption using password_hash() and password_verify()

## Stack

| Layer | Technologies |
----------------------------
| **Frontend** | HTML5, CSS3, JavaScript, Bootstrap 5 |
| **Backend** | PHP 8 |
| **Database** | MySQL |
| **Server** | Apache (via XAMPP) |
| **Version Control** | Git + GitHub |

##  Project Structure
Hospital-Management-System/
│
├── index.html
├── login.html
├── register.html
│
├── PHP/
│ ├── connection.php
│ ├── register.php
│ ├── login.php
│ ├── logout.php
│
├── admin_dashboard.html
├── doctor_dashboard.html
├── patient_dashboard.html
|
├──Appointments/
|├──add_appointment.php
|├──cancel_appointment.php
|├──view_appointments.php
|
├──Doctors/
|├──add_doctor.php
|├──delete_doctor.php
|├──view_doctors.php
|├──view_appointments.php
|
├──Patients/
|├──add_patient.php
|├──delete_patient.php
|├──view_patients.php
|

## How to Run
1. Clone the repository
2. Import the SQL database
3. Run on localhost via XAMPP
