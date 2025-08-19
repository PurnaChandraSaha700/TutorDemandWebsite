<?php
session_start();
$studentEmail = $_SESSION['studentEmailfromStudentHomepage'];

                    


?>

<!DOCTYPE html>
<html lang="en">
<head>
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
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }

    </style>
</head>
<body style="background-image: url('img/page2.jpg');">
<div class="back-button">
<a href="studentHomePage.php" class="btn btn-secondary back-button">Back</a>
</div>
    <div class="container">
        <h1 class="text-center">Accepted Tutor Posts</h1>
        <div class="table-responsive">
            <table class="table table-bordered">

            <thead>
                <tr>
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
                    <th>Teacher Name</th>
                    <th>Teacher Email</th>
                </tr>
            </thead>
            <tbody>
                <?php


                    $conn =new mysqli('localhost','root','','tutorquestdatabase');
                    if($conn->connect_error){
                        die('connection failed : '.$conn->connect_error);
                    }


                    $sql = "SELECT * FROM studentTable WHERE studentEmail = '$studentEmail'";
                        $result = $conn->query($sql);
            
                        // Check if there are any rows in the result
                        if ($result->num_rows > 0) {
                            // Loop through each row and output the data
                            while ($row = $result->fetch_assoc()) {

                                $studentId = $row["studentId"];

                            }
                        } else {
                            echo "No records found";
                        }
                        

                    $selectQuery = "
                    SELECT seekTutor.*, TeacherTable.teacherFirstName, TeacherTable.teacherLastName, TeacherTable.teacherEmail
                    FROM seekTutor
                    LEFT JOIN TeacherTable ON seekTutor.teacherId = TeacherTable.teacherId
                    WHERE seekTutor.teacherId IS NOT NULL
                    AND seekTutor.studentId = ?
                    ORDER BY postDate DESC";
                
                // Prepare the statement
                $stmt = mysqli_prepare($conn, $selectQuery);
                
                // Bind the parameter
                mysqli_stmt_bind_param($stmt, "i", $studentId);
                
                // Execute the statement
                mysqli_stmt_execute($stmt);
                
                // Get the result
                $result = mysqli_stmt_get_result($stmt);;


                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    // Output the required data in corresponding columns
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
                    echo '<td>' . $row['teacherFirstName'] . ' ' . $row['teacherLastName'] . '</td>';
                    echo '<td>' . $row['teacherEmail'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>
