<?php
session_start();
$teacherEmailReceivedfromLoginPage = $_SESSION['teacherEmailfromLoginPage'];

$_SESSION['teacherEmailfromTeacherHomepage'] = $teacherEmailReceivedfromLoginPage;

$conn =new mysqli('localhost','root','','tutorquestdatabase');
        if($conn->connect_error){
            die('connection failed : '.$conn->connect_error);
        }

        $sql = "SELECT * FROM teacherTable WHERE teacherEmail = '$teacherEmailReceivedfromLoginPage'";
        $result = $conn->query($sql);
        
       // Check if there are any rows in the result
        if ($result->num_rows > 0) {
            // Loop through each row and output the data
            while ($row = $result->fetch_assoc()) {
                $teacherId = $row["teacherId"];
                $teacherFirstName = $row["teacherFirstName"];
                $teacherLastName = $row["teacherLastName"];
                $teacherSubjectExpert  = $row["teacherSubjectExpert"];
                $teacherEmail  = $row["teacherEmail"];
                $teacherPhone  = $row["teacherPhone"];
                
                $teacherBio = $row["teacherBio"];


            }
        } else {
            echo "No records found";
        }

        $fullName = $teacherFirstName . " " . $teacherLastName;


        $query = "SELECT teacherProfilePicture  FROM teacherTable WHERE teacherEmail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $teacherEmailReceivedfromLoginPage);
        $stmt->execute();
        $stmt->bind_result($displayProfilePicture);
        $stmt->fetch();
        $stmt->close();

        $conn->close();   




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Homepage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #007bff;
        }

        .container-box {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }

        .profile-container {
            display: flex;
            gap: 20px;
        }

        .profile-info {
            flex: 1;
        }

        .profile-picture {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-section {
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .info-section h2 {
            margin-top: 0;
            color: #333;
        }

        .info-section p {
            color: #666;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }

        .footer p {
            margin: 0;
            color: #777;
        }
    </style>
</head>
<body style="background-image: url('img/page2.jpg');">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="">Teacher Portal</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="loginPage.html">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container container-box profile-container">
        <div class="profile-picture">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($displayProfilePicture); ?>" alt="Profile Picture" >
        </div>
        <div class="profile-info">
            <h1 class="text-primary"><?php echo $fullName; ?></h1>
            <h3 class="text-dark"><?php echo 'Bio: ' . $teacherBio; ?></h3>
            <p class="text-dark"><?php echo 'Email:: ' . $teacherEmail; ?></p>
            <p class="text-dark"><?php echo 'Phone: ' . $teacherPhone; ?></p>
            <p class="text-dark"><?php echo 'Subject Experties: ' . $teacherSubjectExpert; ?></p>
            
            <a href="teacherChangeProfilePicture.php" class="btn btn-primary">Change Profile Picture</a>
            <a href="teacherUpdateProfile.php" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>

    <div class="container container-box">
        <div class="row">
            <div class="col-md-6">
                <div class="info-section bg-light">
                    <h2 class="text-primary">Notifications</h2>
                    <p>See all notifications.</p>
                    <a href="teacherNotification.php" class="btn btn-primary">See Notifications</a> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-section bg-light">  
                    <h2 class="text-primary">Interested Students</h2>
                    <p>View the students who are interested.</p>
                    <a href="teacherFindStudentPosts.php" class="btn btn-primary">Find Student</a>
                    <a href="teacherSeeServises.php" class="btn btn-primary">All Servises</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container container-box">
            <div class="col-md-6">
                <div class="info-section bg-light">
                    <h2 class="text-primary">Search</h2>
                    <p class="text-dark">Search for students or teachers</p>
                    <a href="searchStudentbyTeacher.php" class="btn btn-primary">Search Students</a>
                    <a href="searchTeacherbyTeacher.php" class="btn btn-primary">Search Teachers</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto">
        <div class="container">
            <p class="text-dark">&copy; <?php echo date("Y"); ?> Teacher Portal</p>
        </div>
    </footer>
</body>
</html>
