<?php
session_start();




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-card {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
        .profile-picture {
            max-width: 180px;
            border-radius: 50%;
            margin: 0 auto;
            display: block;
            margin-bottom: 20px;
        }
        .btn-action {
            width: 120px;
            margin-right: 10px;
        }
    </style>
</head>
<body style="background-image: url('img/page2.jpg');">
    <div class="container">
        <?php


            // Retrieve the teacherId parameter from the URL
            if (isset($_GET['teacherId'])) {
                $teacherId = $_GET['teacherId'];
                

                // Now you have the teacherId, you can use it to fetch the teacher's profile information from the database
                // Your database connection and query code here
                // ...

                // Once you have the teacher's profile data, you can display it on the page
                // ...
            } else {
                // Handle the case where teacherId is not provided in the URL
                echo "Teacher ID not provided.";
            }


            $conn =new mysqli('localhost','root','','tutorquestdatabase');
            if($conn->connect_error){
                die('connection failed : '.$conn->connect_error);
            }

            $sql = "SELECT * FROM teacherTable WHERE teacherId = '$teacherId'";
            $result = $conn->query($sql);
            
        // Check if there are any rows in the result
            if ($result->num_rows > 0) {
                // Loop through each row and output the data
                while ($row = $result->fetch_assoc()) {
                    // $teacherId = $row["teacherId"];
                    $teacherFirstName = $row["teacherFirstName"];
                    $teacherLastName = $row["teacherLastName"];
                    $teacherDOB = $row["teacherDOB"];
                    $teacherGender = $row["teacherGender"];
                    $teacherEmail = $row["teacherEmail"];
                    $teacherPhone = $row["teacherPhone"];
                    $teacherCurrentAddress = $row["teacherCurrentAddress"];
                    $teacherCity = $row["teacherCity"];
                    $teacherZipcode = $row["teacherZipcode"];
                    $teacherSubjectExpert =$row["teacherSubjectExpert"];
                    $teacherPreferedAccademicLevel = $row["teacherPreferedAccademicLevel"];
                    $teacherCollege = $row["teacherCollege"];
                    $teacherVarsity = $row["teacherVarsity"];
                    $teacherExperience = $row["teacherExperience"];
                    $teacherAvailableDays = $row["teacherAvailableDays"];
                    $teacherFee = $row["teacherFee"];
                    $teacherBio = $row["teacherBio"];
                    $teacherProfilePicture = $row["teacherProfilePicture"];


                }
            } else {
                echo "No records found";
            }
            $teacherName = $teacherFirstName." ".$teacherLastName;

            $_SESSION['teacherEmailFromTeacherUpdateProfile']=$teacherEmail;


            $selectQuery = "SELECT teacherExperience FROM teacherTable WHERE teacherId = ?";
            $stmt = $conn->prepare($selectQuery);
            $stmt->bind_param("i", $teacherId);
            $stmt->execute();
            $stmt->bind_result($teacherExperiencepdfData);
            $stmt->fetch();
            $stmt->close();


            
        ?>

        <div class="profile-card">
            <div class="text-center">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($teacherProfilePicture); ?>" alt="Profile Picture" style="max-width: 180px; max-height 100px">
                <h2 class="mb-0"><?php echo $teacherName; ?></h2>
                <p class="text-muted"><?php echo $teacherSubjectExpert; ?></p>
            </div>
            <hr>
            <p><strong>Date of Birth:</strong> <?php echo $teacherDOB; ?></p>
            <p><strong>Gender:</strong> <?php echo $teacherGender; ?></p>
            <p><strong>Email:</strong> <?php echo $teacherEmail; ?></p>
            <p><strong>Phone:</strong> <?php echo $teacherPhone; ?></p>
            <p><strong>Address:</strong> <?php echo $teacherCurrentAddress; ?></p>
            <p><strong>City:</strong> <?php echo $teacherCity; ?></p>
            <p><strong>Zipcode:</strong> <?php echo $teacherZipcode; ?></p>
            <p><strong>Preferred Academic Level:</strong> <?php echo $teacherPreferedAccademicLevel; ?></p>
            <p><strong>College:</strong> <?php echo $teacherCollege; ?></p>
            <p><strong>Versity:</strong> <?php echo $teacherVarsity; ?></p>
            <label for="teacherCollegeCertificate" class="form-label">Teacher Experience:</label>
            <?php
            $pdftype = 'experience'; // Replace with the actual PDF ID
            echo '<a href="displayPDF.php?id=' . $pdftype . '" target="_blank">Click here to view PDF</a>';
            ?>
            <p><strong>Available Days in a Week:</strong> <?php echo $teacherAvailableDays; ?></p>
            <p><strong>Fee:</strong> <?php echo $teacherFee; ?></p>
            <p><strong>Bio:</strong> <?php echo $teacherBio; ?></p>
            
        </div>
    </div>
</body>
</html>
