<?php
session_start();
$studentEmail = $_SESSION['studentEmailfromStudentHomepage'];


$conn =new mysqli('localhost','root','','tutorquestdatabase');
        if($conn->connect_error){
            die('connection failed : '.$conn->connect_error);
        }

        $sql = "SELECT * FROM studentTable WHERE studentEmail = '$studentEmail'";

        // Execute the query
        $result = $conn->query($sql);

        // Check if the query was successful
        if ($result) {
            // Fetch the result row
            $row = $result->fetch_assoc();
            
            if ($row) {
                $studentId = $row['studentId'];
                
                
                
            } else {
                echo "Teacher not found";
            }
        } else {
            echo "Query failed: " . $conn->error;
        }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posted Demands</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
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
        <div class="mb-4">
            <a href="studentHomepage.php" class="btn btn-primary">Home Page</a>
        </div>
<?php
$conn =new mysqli('localhost','root','','tutorquestdatabase');
if($conn->connect_error){
    die('connection failed : '.$conn->connect_error);
}

    

    $sql = "SELECT * FROM seekTutor WHERE studentId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
        <h1 class="mb-4">My Posted Demands</h1>
        <div>
            <table class="table">
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
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data from the database
                $sql = "SELECT * FROM seekTutor WHERE studentId = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $studentId);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['tutorSubjectExpert'] . "</td>";
                    echo "<td>" . $row['studentAcademicLevel'] . "</td>";
                    echo "<td>" . $row['tutorGender'] . "</td>";
                    echo "<td>" . $row['tutorLocationZipCode'] . "</td>";
                    echo "<td>" . $row['tutorAvailableInWeek'] . "</td>";
                    echo "<td>" . $row['availableDays'] . "</td>";
                    echo "<td>" . $row['tutionMethod'] . "</td>";
                    echo "<td>" . $row['anySpecialRequirement'] . "</td>";
                    echo "<td>" . $row['sessionDurationInHours'] . "</td>";
                    echo "<td>" . $row['numberOfSessions'] . "</td>";
                    echo "<td>" . $row['tutorBudget'] . "</td>";
                    echo "<td>" . $row['postDate'] . "</td>";

                    if (is_null($row['teacherId'])) {
                        echo '<td>Not Accepted</td>';
                        echo '<td>';
                        echo '<form method="post" action="?action=delete">';
                        echo '<input type="hidden" name="seektutorid" value="' . $row['seektutorid'] . '">';
                        echo '<button class="btn btn-danger" type="submit" name="deleteButton">Delete</button>';
                        echo '</form>';
                        echo '</td>';
                    } else {
                        echo '<td>Accepted</td>';
                        echo '<td><button class="btn btn-danger" disabled>Delete</button></td>';
                    }

                    echo "</tr>";
                }


                if (isset($_POST['deleteButton']) && isset($_POST['seektutorid'])) {
                    $seektutoridToDelete = $_POST['seektutorid'];

                    // Check if teacherId is null
                    // Perform deletion only if teacherId is null
                    $deleteQuery = "DELETE FROM seekTutor WHERE seektutorid = $seektutoridToDelete AND teacherId IS NULL";
                    $deleteResult = mysqli_query($conn, $deleteQuery);

                    if ($deleteResult) {
                        // Refresh the page after deletion
                        header("Location: {$_SERVER['PHP_SELF']}");
                        exit();
                    } else {
                        echo '<div class="alert alert-danger">Failed to delete the record.</div>';
                    }
                }
                ?>
            </tbody>
        </table>


        </div>
        
    </div>
</body>
</html>
