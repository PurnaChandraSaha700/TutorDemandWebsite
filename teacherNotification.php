
<?php
session_start();
$teacherEmail = $_SESSION['teacherEmailfromTeacherHomepage'];



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


                    $sql = "SELECT * FROM teacherTable WHERE teacherEmail = '$teacherEmail'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {

                                $teacherId = $row["teacherId"];

                            }
                        } else {
                            echo "No records found";
                        }

                    // Fetch notifications for the student
                    $selectQuery = "SELECT * FROM notificationTable WHERE teacherId = ?";
                    $stmt = $conn->prepare($selectQuery);
                    $stmt->bind_param("i", $teacherId);
                    $stmt->execute();
                    $result = $stmt->get_result();


                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['notificationDateAndTime'] . '</td>';
                        echo '<td>' . $row['teacherNotification'] . '</td>';
                        if ($row['acceptedByTeacher'] == 1 && $row['acceptedByStudent'] == 1) {
                            echo '<td>Accepted</td>';
                        } elseif ($row['acceptedByTeacher'] == 0 && $row['acceptedByStudent'] == 0) {
                            echo '<td>Rejected</td>';
                        } else {
                            echo '<td>Pending</td>';
                        }
                        echo '<td><form method="post"><button class="btn btn-danger" name="rejectButton" value="' . $row['notificationId'] . '">Reject</button></form></td>';
                        echo '</tr>';
                    }
                    $stmt->close();
                    

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
        <a href="teacherHomePage.php" class="btn btn-primary">Go to Home Page</a>
    </div>
</body>
</html>
