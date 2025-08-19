<?php
session_start();
$recerivedEmailfromStudentHomepage = $_SESSION['studentEmailfromStudentHomepage'];


$conn =new mysqli('localhost','root','','tutorquestdatabase');
if($conn->connect_error){
    die('connection failed : '.$conn->connect_error);
}
// SQL query to retrieve student information using email as filter
$sql = "SELECT * FROM studentTable WHERE studentEmail = '$recerivedEmailfromStudentHomepage'";
$result = $conn->query($sql);

// Check if there are any rows in the result
if ($result->num_rows > 0) {
    // Loop through each row and output the data
    while ($row = $result->fetch_assoc()) {
        $studentId = $row["studentId"];
        $studentFirstName = $row["studentFirstName"];
        $studentLastName = $row["studentLastName"];
        $studentDOB = $row["studentDOB"];
        $studentGender = $row["studentGender"];
        $studentEmail = $row["studentEmail"];
        $studentPhone = $row["studentPhone"];
        $studentPermanentAddress = $row["studentPermanentAddress"];
        $studentCurrentAddress = $row["studentCurrentAddress"];
        $studentCity = $row["studentCity"];
        $studentZipCode = $row["studentZipCode"];
        $studentPassword = $row["studentPassword"];
        $studentProfilePicture = $row["studentProfilePicture"];
        $studentCountPost = $row["studentCountPost"];
        $tutorCount = $row["tutorCount"];
        $isVarifiedStudent = $row["isVarifiedStudent"];
        $studentBio = $row["studentBio"];


    }
} else {
    echo "No records found";
}

if($isVarifiedStudent ==1 ){
    $verifiedText ="YES";
}else{
    $verifiedText ="NO";

}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutorQuest - Student Sign Up</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
       body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .signup-container {
            /* max-width: 600px; */
            margin: 0 auto;
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .signup-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .signup-header h2 {
            color: #007bff;
            font-size: 36px;
            margin-bottom: 5px;
        }

        .signup-header p {
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

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 25px;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 1px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-check-label {
            color: #444;
        }

        .signup-link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-link:hover {
            text-decoration: underline;
        }

        /* Colors for form sections */
        .personal-section {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #333;
        }

        .location-section {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #333;
        }

        .role-section {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
            color: #333;
        }
    </style>
</head>

<body style="background-image: url('img/page2.jpg');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 signup-container">
                <div class="signup-header">
                    <h2>TutorQuest - Student Sign Up</h2>
                    <p>Please enter your personal and location information below.</p>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <!-- Personal Information Section -->
                    <div class="personal-section">
                        <div class="row mb-3">
                            
                            <div class="col-md-6">
                                <label for="studentFirstName" class="form-label">First Name</label>
                                
                                <input type="text" class="form-control" id="studentFirstName" name="studentFirstName" value="<?php echo $studentFirstName; ?>" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentLastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="studentLastName" name="studentLastName" value="<?php echo $studentLastName; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="studentDOB" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="studentDOB" name="studentDOB" value="<?php echo $studentDOB; ?>" required>
                            </div>

                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="studentGender" id="studentGenderMale"
                                        value="male" <?php if ($studentGender === 'male') echo 'checked'; ?> required>
                                    <label class="form-check-label" for="studentGenderMale">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="studentGender" id="studentGenderFemale"
                                        value="female" <?php if ($studentGender === 'female') echo 'checked'; ?>>
                                    <label class="form-check-label" for="studentGenderFemale">Female</label>
                                </div>
                            </div>

                            <!-- ************************ E M A I L ************************ -->
                            <div class="col-md-6">
                                <label for="studentEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="studentEmail" name="studentEmail" value="<?php echo $studentEmail; ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="studentPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="studentPhone" name="studentPhone" value="<?php echo $studentPhone; ?>">
                        </div>
                    </div>
                    <!-- Location Information Section -->
                    <div class="location-section">
                        <h4>Location Information</h4>
                        <div class="mb-3">
                            <label for="studentPermanentAddress" class="form-label">Permanent Address</label>
                            <textarea class="form-control" id="studentPermanentAddress" name="studentPermanentAddress" rows="3"
                            require><?php echo $studentPermanentAddress; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="studentCurrentAddress" class="form-label">Current Address</label>
                            <textarea class="form-control" id="studentCurrentAddress" name="studentCurrentAddress" rows="3"
                            require><?php echo $studentCurrentAddress; ?></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentCity" class="form-label">City</label>
                                <input type="text" class="form-control" id="studentCity" name="studentCity" value="<?php echo $studentCity; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="studentZipCode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="studentZipCode" name="studentZipCode" value="<?php echo $studentZipCode; ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Additional Student Information Section -->
                    <div class="additional-section">
                        <h4>Additional Information</h4>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="Password" name="Password" value="<?php echo $studentPassword; ?>">
                        </div>
                        
                        
                        <div class="mb-3">
                            <label for="isVerifiedLabel">Number of Posts: <?php echo $studentCountPost; ?></label>
                            
                        </div>
                        <div class="mb-3">
                            <label for="isVerifiedLabel">Tutor Count: <?php echo $tutorCount; ?></label>
                           
                        </div>
<!-- ****************************************************************** -->
                        <div class="form-group">
                            <label for="isVerifiedLabel">Verified Student: <?php echo $verifiedText; ?></label>
                        </div>


                        <div class="mb-3">
                            <label for="studentBio" class="form-label">Bio</label>
                            <textarea class="form-control" id="studentBio" name="studentBio" rows="5" ><?php echo $studentBio; ?></textarea>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name= "submit" class="btn btn-primary btn-block">Save Changes</button>
                    </div>
                </form>



                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $conn =new mysqli('localhost','root','','tutorquestdatabase');
                        if($conn->connect_error){
                            die('connection failed : '.$conn->connect_error);
                        }
                        

                        // Assuming you have retrieved all the form values here
                        $studentEmail = $_POST['studentEmail'];
                        $studentFirstName = $_POST['studentFirstName'];
                        $studentLastName = $_POST['studentLastName'];
                        $studentDOB = $_POST['studentDOB'];
                        $studentGender = $_POST['studentGender'];
                        $studentPhone = $_POST['studentPhone'];
                        $studentPermanentAddress = $_POST['studentPermanentAddress'];
                        $studentCurrentAddress = $_POST['studentCurrentAddress'];
                        $studentCity = $_POST['studentCity'];
                        $studentZipCode = $_POST['studentZipCode'];
                        $studentPassword = $_POST['Password'];
                        // $studentProfilePicture = $_POST['studentProfilePicture']; // Update this based on your file handling logic
                        
                        $studentBio = $_POST['studentBio'];



                        // Prepare the SQL statement
                        $sql = "UPDATE studenttable SET studentFirstName=?, studentLastName=?, studentDOB=?, studentGender=?, studentPhone=?, studentPermanentAddress=?, studentCurrentAddress=?, studentCity=?, studentZipCode=?, studentPassword=?, studentBio=? WHERE studentEmail = ?";

                        // Prepare and bind the statement
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssssssssssss", $studentFirstName, $studentLastName, $studentDOB, $studentGender, $studentPhone, $studentPermanentAddress, $studentCurrentAddress, $studentCity, $studentZipCode, $studentPassword, $studentBio, $recerivedEmailfromStudentHomepage);

                        // Execute the statement
                        if ($stmt->execute()) {
                            // header("Location: signUpSuccessful.html");
                            // exit;
                            echo "update successful: ";
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }

                        // Close the statement and connection
                        $stmt->close();
                        $conn->close();



                        //header('Location: studentUpdateSuccessful.html');




                    }
                ?>



                <div class="mt-3 text-center">
                    <a href="studenthomePage.php" class="btn btn-secondary">Homepage</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
