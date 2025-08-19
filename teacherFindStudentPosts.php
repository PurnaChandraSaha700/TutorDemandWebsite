<?php
session_start();
$teacherEmail = $_SESSION['teacherEmailfromTeacherHomepage'];




        

        // $selectQuery = "
        // SELECT seekTutor.*, TeacherTable.teacherFirstName, TeacherTable.teacherLastName, TeacherTable.teacherEmail
        // FROM seekTutor
        // LEFT JOIN TeacherTable ON seekTutor.teacherId = TeacherTable.teacherId
        // WHERE seekTutor.teacherId IS NOT NULL
        // AND seekTutor.studentId = ?
        // ORDER BY postDate DESC";

        
?>

<!DOCTYPE html>
<html lang="en">
<head>

        <div class="mb-4">
            <a href="teacherHomepage.php" class="btn btn-primary">Home Page</a>
        </div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Requirements</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width:100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* margin: 0 auto; Center the container horizontally */
            /* max-width: 1000px; Limit the container width */
        }
        .table {
            width: 100%;
            margin-top: 20px;
        }
        .table th, .table td {
            /* padding: 12px 15px; */
            border-top: 1px solid #dee2e6;
            color: #333;
            vertical-align: middle; /* Align content vertically in cells */
        }
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #555;
        }
        .table tbody tr:hover {
            background-color: #f0f8ff;
            cursor: pointer;
        }
        .badge-success {
            background-color: #28a745;
        }
        .badge-danger {
            background-color: #dc3545;
        }
    </style>
</head>
<body style="background-image: url('img/page2.jpg');">
    <div class="container">
        <h1 class="text-center">Accepted Tutor Posts</h1>
        <div class="table-responsive">
            <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student Email</th>
                    <th>Student Phone</th>
                    <th>Subjects</th>
                    <th>Academic Level</th>
                    <th>Preferred Gender</th>
                    <th>Location</th>
                    <th>Tutor Availability</th>
                    <th>Available Days</th>
                    <th>Tution Method</th>
                    <th>Special Requirement</th>
                    <th>Duretion in Hours</th>
                    <th>Number of Sessions</th>
                    <th>Tutor Fee</th>
                    <th>Date</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php

            $conn =new mysqli('localhost','root','','tutorquestdatabase');
            if($conn->connect_error){
                die('connection failed : '.$conn->connect_error);
            }




                $sql = "SELECT * FROM teacherTable WHERE teacherEmail = '$teacherEmail'";

                // Execute the query
                $result = $conn->query($sql);

                // Check if the query was successful
                if ($result) {
                    // Fetch the result row
                    $row = $result->fetch_assoc();
                    
                    if ($row) {
                        $teacherId = $row['teacherId'];
                        $teacherFirstName = $row['teacherFirstName'];
                        $teacherLastName = $row['teacherLastName'];
                        $teacherGender = $row['teacherGender'];
                        $teacherCity = $row['teacherCity'];
                        $teacherZipcode = $row['teacherZipcode'];
                        $teacherSubjectExpert = $row['teacherSubjectExpert'];
                        $teacherPreferedAccademicLevel = $row['teacherPreferedAccademicLevel'];
                        $teacherAvailableinWeek = $row['teacherAvailableinWeek'];
                        $teacherAvailableDays = $row['teacherAvailableDays'];
   
                        // echo $teacherId;
                        
                        
                    } else {
                        echo "Teacher not found";
                    }
                } else {
                    echo "Query failed: " . $conn->error;
                }

                $selectQuery = "SELECT seekTutor.*, studentTable.studentFirstName,studentTable.studentLastName, studentTable.studentEmail,studentTable.studentPhone
                FROM seekTutor
                INNER JOIN studentTable ON seekTutor.studentId = studentTable.studentId
                WHERE (seekTutor.tutorGender = '$teacherGender'
                OR seekTutor.tutorLocationZipCode = '$teacherZipcode'
                OR seekTutor.tutorSubjectExpert LIKE '%$teacherSubjectExpert%'
                OR seekTutor.studentAcademicLevel = '$teacherPreferedAccademicLevel'
                OR seekTutor.tutorAvailableInWeek = $teacherAvailableinWeek
                OR seekTutor.availableDays = '$teacherAvailableDays')
                AND seekTutor.teacherId IS NULL";

                $result = mysqli_query($conn, $selectQuery);



                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    // Output the required data in corresponding columns

                    echo '<td>' . $row['studentFirstName'] . ' ' . $row['studentLastName'] . '</td>';
                    echo '<td>' . $row['studentEmail'] . '</td>';
                    echo '<td>' . $row['studentPhone'] . '</td>';

                    echo '<td>' . $row['tutorSubjectExpert'] . '</td>';
                    echo '<td>' . $row['studentAcademicLevel'] . '</td>';
                    echo '<td>' . $row['tutorGender'] . '</td>';
                    echo '<td>' . $row['tutorLocationZipCode'] . '</td>';
                    echo '<td>' . $row['tutorAvailableInWeek'] . '</td>';
                    echo '<td>' . $row['availableDays'] . '</td>';
                    echo '<td>' . $row['tutionMethod'] . '</td>';
                    echo '<td>' . $row['anySpecialRequirement'] . '</td>';
                    echo '<td>' . $row['sessionDurationInHours'] . '</td>';
                    echo '<td>' . $row['numberOfSessions'] . '</td>';
                    echo '<td>' . $row['tutorBudget'] . '</td>';
                    echo '<td>' . $row['postDate'] . '</td>';
                    
                    echo '<td>';
                    echo '<form method="post" action="?action=delete">';
                    echo '<input type="hidden" name="studentId" value="' . $row['studentId'] . '">';
                    echo '<button class="btn btn-danger" type="submit" name="applyButton">Apply</button>';
                    echo '</form>';
                    echo '</td>';

                    echo '</tr>';

                    if (isset($_POST['applyButton']) && isset($_POST['studentId'])) {
                        $studetIdfromButton = $_POST['studentId'];
    
                        // Check if teacherId is null
                        // Perform deletion only if teacherId is null
                        $sql = "SELECT * FROM studentTable WHERE studentId = '$studetIdfromButton'";

                        // Execute the query
                        $result = $conn->query($sql);
                
                        // Check if the query was successful
                        if ($result) {
                            // Fetch the result row
                            $row = $result->fetch_assoc();
                            
                            if ($row) {
                                $studentEmail = $row['studentEmail'];

                            } else {
                                echo "Teacher not found";
                            }
                        } else {
                            echo "Query failed: " . $conn->error;
                        }

                        
                        

                        // Create the notification message
                        $teacherNotification = "You responded to " . $studentEmail . "'s tutor post";
                        $studentNotification = $teacherEmail . " responded to your tutor post";
                        $notificationDateAndTime = date("Y-m-d H:i:s");
                        $acceptedByTeacher =1;

                        
                        $insertQuery = "INSERT INTO notificationTable (studentId, teacherId, acceptedByTeacher, teacherNotification, studentNotification, notificationDateAndTime)
                                        VALUES (?, ?, ?, ?, ?, ?)";

                        $stmt = $conn->prepare($insertQuery);
                        $stmt->bind_param("iiisss", $studetIdfromButton, $teacherId, $acceptedByTeacher, $teacherNotification, $studentNotification, $notificationDateAndTime);

                        if ($stmt->execute()) {
                            echo "Notification inserted successfully.";
                        } else {
                            echo "Error: " . $stmt->error;
                        }
                        $stmt->close();



                    }
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>
