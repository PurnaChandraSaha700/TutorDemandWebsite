<?php
session_start();
$studentEmailReceivedfromLoginPage = $_SESSION['studentEmailfromLoginPage'];

$_SESSION['studentEmailfromStudentHomepage'] = $studentEmailReceivedfromLoginPage;


        $conn =new mysqli('localhost','root','','tutorquestdatabase');
        if($conn->connect_error){
            die('connection failed : '.$conn->connect_error);
        }

        $sql = "SELECT * FROM studentTable WHERE studentEmail = '$studentEmailReceivedfromLoginPage'";
        $result = $conn->query($sql);
        
       // Check if there are any rows in the result
        if ($result->num_rows > 0) {
            // Loop through each row and output the data
            while ($row = $result->fetch_assoc()) {
                $studentId = $row["studentId"];
                $studentFirstName = $row["studentFirstName"];
                $studentLastName = $row["studentLastName"];
                $studentPhone = $row["studentPhone"];
                $studentEmail = $row["studentEmail"];
                
                $studentBio = $row["studentBio"];


            }
        } else {
            echo "No records found";
        }

        $fullName = $studentFirstName . " " . $studentLastName;


        $query = "SELECT studentProfilePicture  FROM studentTable WHERE studentEmail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $studentEmailReceivedfromLoginPage);
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
            <a class="navbar-brand" href="">Student Portal</a>
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
            <h3 class="text-dark"><?php echo 'Bio: ' . $studentBio; ?></h3>
            <p class="text-dark"><?php echo 'Email:: ' . $studentEmail; ?></p>
            <p class="text-dark"><?php echo 'Phone: ' . $studentPhone; ?></p>
            
            <a href="StudentChangeProfilePicture.php" class="btn btn-primary">Change Profile Picture</a>
            <a href="studentUpdateProfile.php" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>

    <div class="container container-box">
        <div class="row">
            <div class="col-md-6">
                <div class="info-section bg-light">
                    <h2 class="text-primary">Notifications</h2>
                    <p>See all notifications.</p>
                    <a href="studentNotification.php" class="btn btn-primary">See Notifications</a> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-section bg-light">
                    <h2 class="text-primary">Find a Tutor</h2>
                    <p>Looking for a tutor ?</p>
                    <a href="studentSeekTuror.php" class="btn btn-primary">Apply</a> 
                </div>
            </div>
        </div>
    </div>

    <div class="container container-box">
        <div class="row">
            <div class="col-md-6">
                <div class="info-section bg-light">
                    <h2 class="text-primary">Applied Tutors</h2>
                    <p>so far you have applied ... </p>
                        <a href="studentSeePosts.php" class="btn btn-primary">View Posts</a> 
                        <a href="studentSeeAcceptedPosts.php" class="btn btn-primary">View Accepted Posts</a> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-section bg-light">
                    <h2 class="text-primary">Search</h2>
                    <p class="text-dark">Search for students or teachers</p>
                    <a href="searchStudentbyStudent.php" class="btn btn-primary">Search Students</a>
                    <a href="searchTeacherbyStudent.php" class="btn btn-primary">Search Teachers</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto">
        <div class="container">
            <p class="text-dark">&copy; <?php echo date("Y"); ?> Student Portal</p>
        </div>
    </footer>
</body>
</html>
