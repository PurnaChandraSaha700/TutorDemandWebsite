<?php
session_start();
$studentEmail = $_SESSION['studentEmailfromStudentHomepage'];



?>



<!DOCTYPE html>
<html>
<head>
    <title>Student Notifications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h1 {
            color: #333333;
        }
        table {
            margin-top: 20px;
        }
        th {
            background-color: #f8f9fa;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #1f8439;
            border-color: #1f8439;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
    </style>
</head>
<body style="background-image: url('img/page2.jpg');">
    <div class="container">
        <h1 class="mb-4">Your Notifications</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Notification</th>
                    <th>Status</th> <!-- New column -->
                    <th>View Profile</th>
                    <th>Accept</th>
                    <th>Reject</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Your database connection code here
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
                                
                                // echo $studentId;

                            }
                        } else {
                            echo "No records found";
                        }



                    // Fetch notifications for the student
                    $selectQuery = "SELECT * FROM notificationTable WHERE studentId = ?";
                    $stmt = $conn->prepare($selectQuery);
                    $stmt->bind_param("i", $studentId);
                    $stmt->execute();
                    $result = $stmt->get_result();


                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['notificationDateAndTime'] . '</td>';
                        echo '<td>' . $row['studentNotification'] . '</td>';
                        if ($row['acceptedByTeacher'] == 1 && $row['acceptedByStudent'] == 1) {
                            echo '<td>Accepted</td>';
                        } elseif ($row['acceptedByTeacher'] == 0 && $row['acceptedByStudent'] == 0) {
                            echo '<td>Rejected</td>';
                        } else {
                            echo '<td>Pending</td>';
                        }
                        echo '<td><a class="btn btn-primary" href="publicViewTeacherProfile.php?teacherId=' . $row['teacherId'] . '" target="_blank">View Profile</a></td>';
                        echo '<td><form method="post"><button class="btn btn-success" name="acceptButton" value="' . $row['notificationId'] . '">Accept</button></form></td>';
                        echo '<td><form method="post"><button class="btn btn-danger" name="rejectButton" value="' . $row['notificationId'] . '">Reject</button></form></td>';
                        echo '</tr>';
                    }
                    $stmt->close();
                    

                    if (isset($_POST['acceptButton'])) {
                        $notificationId = $_POST['acceptButton'];
                        $updateQuery = "UPDATE notificationTable
                        SET acceptedByStudent = 1
                        WHERE notificationId = $notificationId";
    
                        if ($conn->query($updateQuery)) {
                            
                        } else {
                            
                            echo "Error: " . $conn->error;
                        }


                        $sql = "SELECT * FROM notificationTable WHERE notificationId = '$notificationId'";
                        $result = $conn->query($sql);
            
                        // Check if there are any rows in the result
                        if ($result->num_rows > 0) {
                            // Loop through each row and output the data
                            while ($row = $result->fetch_assoc()) {

                                $studentId = $row["studentId"];
                                $teacherId = $row["teacherId"];
                                // echo $studentId;

                            }
                        } else {
                            echo "No records found";
                        }

// update the seek tutor 
                        $updateQuery = "UPDATE seekTutor
                        SET teacherId  = $teacherId
                        WHERE studentId = $studentId";
                        $result = $conn->query($updateQuery);
                        if ($conn->query($updateQuery)) {
                            header("Location: ".$_SERVER['PHP_SELF']);
                        } else {
                            
                            echo "Error: " . $conn->error;
                        }


                    }
                    
                    if (isset($_POST['rejectButton'])) {
                        $notificationId = $_POST['rejectButton'];
                        $updateQuery = "UPDATE notificationTable
                        SET acceptedByTeacher = 0, acceptedByStudent = 0
                        WHERE notificationId = $notificationId";
    
                        if ($conn->query($updateQuery)) {
                            header("Location: ".$_SERVER['PHP_SELF']);
                        } else {
                            
                            echo "Error: " . $conn->error;
                        }
                    }

                    $conn->close();

                ?>
            </tbody>
        </table>
        <a href="studentHomePage.php" class="btn btn-primary">Go to Home Page</a>
    </div>
</body>
</html>
