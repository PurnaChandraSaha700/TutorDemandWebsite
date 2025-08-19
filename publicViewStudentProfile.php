<?php
session_start();

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'tutorquestdatabase');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch student data based on studentId from the session or URL parameter
if (isset($_GET['studentId'])) {
    $studentId = $_GET['studentId'];
} else if (isset($_SESSION['studentId'])) {
    $studentId = $_SESSION['studentId'];
} else {
    echo "Student ID not provided.";
    exit;
}

$sql = "SELECT * FROM studentTable WHERE studentId = '$studentId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $studentFirstName = $row["studentFirstName"];
    $studentLastName = $row["studentLastName"];
    $studentDOB = $row["studentDOB"];
    $studentGender = $row["studentGender"];
    $studentEmail = $row["studentEmail"];
    $studentPhone = $row["studentPhone"];
    $studentCurrentAddress = $row["studentCurrentAddress"];
    $studentCity = $row["studentCity"];
    $studentZipCode = $row["studentZipCode"];
    $studentCountPost = $row["studentCountPost"];
    $tutorCount = $row["tutorCount"];
    $isVerifiedStudent = $row["isVarifiedStudent"];
    $studentBio = $row["studentBio"];
    $studentProfilePicture = $row["studentProfilePicture"];
} else {
    echo "No records found";
}
$studentName = $studentFirstName . " " . $studentLastName;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Add your custom CSS styles here */
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
    <div class="profile-card">
        <div class="text-center">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($studentProfilePicture); ?>"
                 alt="Profile Picture" style="max-width: 180px; max-height 100px">
            <h2 class="mb-0"><?php echo $studentName; ?></h2>
            <p class="text-muted">Student</p>
        </div>
        <hr>
        <p><strong>Date of Birth:</strong> <?php echo $studentDOB; ?></p>
        <p><strong>Gender:</strong> <?php echo $studentGender; ?></p>
        <p><strong>Email:</strong> <?php echo $studentEmail; ?></p>
        <p><strong>Phone:</strong> <?php echo $studentPhone; ?></p>
        <p><strong>Address:</strong> <?php echo $studentCurrentAddress; ?></p>
        <p><strong>City:</strong> <?php echo $studentCity; ?></p>
        <p><strong>Zipcode:</strong> <?php echo $studentZipCode; ?></p>
        <p><strong>Total Posts:</strong> <?php echo $studentCountPost; ?></p>
        <p><strong>Total Tutors:</strong> <?php echo $tutorCount; ?></p>
        <p><strong>Verified Status:</strong> <?php echo ($isVerifiedStudent ? 'Verified' : 'Not Verified'); ?></p>
        <p><strong>Bio:</strong> <?php echo $studentBio; ?></p>

    </div>
</div>
</body>
</html>
