<?php
$inputData = "";

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
            background-color: #b3b9c4;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* margin: 0 auto; Center the container horizontally */
            /* max-width: 1000px; Limit the container width */
        }

        .filter-container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #333;
        }
        .filter-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .filter-header h2 {
            color: #007bff;
            font-size: 36px;
            margin-bottom: 5px;
        }
        .filter-header p {
            color: #666;
            font-size: 18px;
            margin-bottom: 0;
        }
        .form-label {
            font-weight: bold;
            color: #444;
        }
        .form-control {
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
            color: #444;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .verify-button {
            background-color: green;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
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
<a href="adminHomePage.php" class="btn btn-secondary back-button">Back</a>
</div>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 filter-container">
                <div class="filter-header">
                    <h3>Search by Name or Email</h3>
                    
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="inputData" class="form-label">Input:</label>
                        <input type="text" class="form-control" id="inputData" name="inputData">
                    </div>
                    <!-- Add more filter options here -->

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="container">
        <h1 class="text-center">UNVARIFIED TEACHERS</h1>
        
        <div class="table-responsive">
            <table class="table table-bordered">

            <thead>
                <tr>
                <th>Teacher ID</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Permanent Address</th>
                    <th>Current Address</th>
                    <th>City</th>
                    <th>Zip Code</th>
                    <th>Subject Experties</th>
                    <th>Prefered Accademic Level</th>
                    <th>College</th>
                    <th>College Certificate</th>
                    <th>Varsity</th>
                    <th>Varsity Certificate</th>
                    <th>Experience</th>
                    <th>Available In Week</th>
                    <th>Available Days</th>
                    <th>Fee</th>
                    <th>Password</th>
                    <th>Tution Count</th>
                    <th>Varified Teacher</th>
                    <th>Teacher Bio</th>
                    <th>Profile Picture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php


                    $conn =new mysqli('localhost','root','','tutorquestdatabase');
                    if($conn->connect_error){
                        die('connection failed : '.$conn->connect_error);
                    }

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $inputData = $_POST['inputData'];

                    }


                    $sql = "SELECT * FROM teacherTable where isTeacherVerified =0";
                    
                    if (is_null($inputData)) {
                        $sql = "SELECT * FROM teacherTable";
                    } else {
                        $sql = "SELECT * FROM teacherTable WHERE (CONCAT(teacherFirstName, ' ', teacherLastName) LIKE '%$inputData%' or teacherEmail like '%$inputData%' ) and isTeacherVerified=0";
                    }


                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["teacherId"] . "</td>";
                        echo "<td>" . $row["teacherFirstName"] . " " . $row["teacherLastName"] . "</td>";
                        echo "<td>" . $row["teacherDOB"] . "</td>";
                        echo "<td>" . $row["teacherGender"] . "</td>";
                        echo "<td>" . $row["teacherEmail"] . "</td>";
                        echo "<td>" . $row["teacherPhone"] . "</td>";
                        echo "<td>" . $row["teacherParmanentAddress"] . "</td>";
                        echo "<td>" . $row["teacherCurrentAddress"] . "</td>";
                        echo "<td>" . $row["teacherCity"] . "</td>";
                        echo "<td>" . $row["teacherZipcode"] . "</td>";
                        echo "<td>" . $row["teacherSubjectExpert"] . "</td>";
                        echo "<td>" . $row["teacherPreferedAccademicLevel"] . "</td>";
                        echo "<td>" . $row["teacherCollege"] . "</td>";
                        echo "<td><a href='viewCertifate.php?type=College&id=" . $row["teacherId"] . "'>View</a></td>";
                        echo "<td>" . $row["teacherVarsity"] . "</td>";
                        echo "<td><a href='viewCertifate.php?type=Varsity&id=" . $row["teacherId"] . "'>View</a></td>";
                        echo "<td><a href='viewExperience.php?id=" . $row["teacherId"] . "'>View</a></td>";
                        echo "<td>" . $row["teacherAvailableinWeek"] . "</td>";
                        echo "<td>" . $row["teacherAvailableDays"] . "</td>";
                        echo "<td>" . $row["teacherFee"] . "</td>";
                        echo "<td>" . $row["teacherPassword"] . "</td>";
                        echo "<td>" . $row["countTeacherTuition"] . "</td>";
                        echo "<td>" . $row["isTeacherVerified"] . "</td>";
                        echo "<td>" . $row["teacherBio"] . "</td>";
                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row["teacherProfilePicture"]) . "' alt='Profile Image' style='width: 50px; height: 50px; object-fit: cover; border-radius: 50%;'></td>";
                        // Add more columns here as needed
                        echo '<td><form method="post"><button class="verify-button" name="verifyButton" value="' . $row['teacherId'] . '">Verify</button></form></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='26'>No records found.</td></tr>";
                }


                if (isset($_POST['verifyButton'])) {
                    $teacherId = $_POST['verifyButton'];

                    // Update teacher as verified
                    $updateQuery = "UPDATE TeacherTable SET isTeacherVerified = 1 WHERE teacherId = $teacherId";
                    if ($conn->query($updateQuery)) {
                        // Update successful
                        
                    } else {
                        // Update failed
                        
                    }
                }


                ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>
