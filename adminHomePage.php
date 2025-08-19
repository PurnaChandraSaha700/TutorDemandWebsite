<?php
session_start();
$_SESSION['studentEmailValuefromAdminHomePage'] = 0;
// $studentEmailReceivedfromLoginPage = $_SESSION['studentEmailfromLoginPage'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage - TutorQuest</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .navbar {
            background-color: #007bff;
        }
        .container {
            margin-top: 30px;
        }
        .section-header {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
            color: white;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.15);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            border: none;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            padding: 20px;
        }
        .card-text {
            color: #555;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 25px;
            padding: 12px 24px;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .logout-link {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        .logout-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body style="background-image: url('img/page2.jpg');">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">TutorQuest Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link logout-link" href="loginPage.html">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="section-header">Welcome, Admin</div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card bg-light">
                    <div class="card-header">Announcements</div>
                    <div class="card-body">
                        <p class="card-text">No announcements at the moment.</p>
                        <a href="#" class="btn btn-primary">Add Announcement</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card bg-light">
                    <div class="card-header">Varify Teachers</div>
                    <div class="card-body">
                        <p class="card-text">See techars are not !! VARIFIED !!</p>
                        <a href="adminVarifyTeacher.php" class="btn btn-success">VARIFY</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card bg-light">
                    <div class="card-header">Manage Students</div>
                    <div class="card-body">
                        <p class="card-text">View and manage student information.</p>
                        <a href="viewStudentbyAdmin.php" class="btn btn-primary">View Students</a>
                        <a href="updateStudentByAdmin.php" class="btn btn-primary">Update Students</a>
                        <a href="deleteStudentbyAdmin.php" class="btn btn-danger">Delete Students</a>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card bg-light">
                    <div class="card-header">Manage Teachers</div>
                    <div class="card-body">
                        <p class="card-text">View and manage teacher information.</p>
                        <a href="viewTeacherbyAdmin.php" class="btn btn-primary">View Teachers</a>
                        <a href="updateTeacherByAdmin.php" class="btn btn-primary">Update Teachers</a>
                        <a href="deleteTeacherbyAdmin.php" class="btn btn-danger">Delete Teacher</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
