<?php
session_start();
/// receiving data from student Home page.
$teacherEmailReceivedfromTeacherHomePage = $_SESSION['teacherEmailfromTeacherHomepage'];

//$_SESSION['teacherEmailfromTeacherHomepage'] = $teacherEmailReceivedfromStudentHomePage;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Picture</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .change-profile-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .change-profile-container {
            max-width: 500px;
            margin: 0 auto;
            margin-top: 20px;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 8px;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto;
            display: block;
        }
        .custom-file-label::after {
            content: "Browse";
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>
<body style="background-image: url('img/page2.jpg');">




<div class="back-button">
<a href="adminHomePage.php" class="btn btn-secondary back-button">Back</a>
</div>

    <div class="change-profile-header">
        <h1>Change Profile Picture</h1>
    </div>
    <div class="change-profile-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="ProfilePictureInput" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="ProfilePictureInput" name="ProfilePictureInput" accept="image/*">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Upload and Update</button>
            </div>
        </form>
    </div>
</body>
</html>


<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn =new mysqli('localhost','root','','tutorquestdatabase');
        if($conn->connect_error){
            die('connection failed : '.$conn->connect_error);
        }
        



        $imageFile = $_FILES['ProfilePictureInput'];
        $tmpPath = $imageFile['tmp_name'];
        
        $imageData = file_get_contents($tmpPath);

        $insertQuery = "UPDATE teacherTable set teacherProfilePicture =? WHERE teacherEmail = ?";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ss",$imageData, $teacherEmailReceivedfromTeacherHomePage);
        if ($stmt->execute()) {
            header('Location: teacherUpdateSuccessful.html');
        } else {
            echo "Error updating image: " . $stmt->error;
        }


        $stmt->close();


       
        $conn->close();







    }
                ?>