<?php
session_start();
$recerivedEmailfromTeacherHomepage = $_SESSION['teacherEmailfromTeacherHomepage'];
// sending email to pdf file 
$_SESSION['teacherEmailFromTeacherUpdateProfile']=$recerivedEmailfromTeacherHomepage;


$conn =new mysqli('localhost','root','','tutorquestdatabase');
if($conn->connect_error){
    die('connection failed : '.$conn->connect_error);
}
// SQL query to retrieve student information using email as filter
$sql = "SELECT * FROM teacherTable WHERE teacherEmail = '$recerivedEmailfromTeacherHomepage'";
$result = $conn->query($sql);

// Check if there are any rows in the result
if ($result->num_rows > 0) {
    // Loop through each row and output the data
    while ($row = $result->fetch_assoc()) {
        $teacherId = $row["teacherId"];
        $teacherFirstName = $row["teacherFirstName"];
        $teacherLastName  = $row["teacherLastName"];
        $teacherDOB  = $row["teacherDOB"];
        $teacherGender  = $row["teacherGender"];
        $teacherEmail  = $row["teacherEmail"];
        $teacherPhone = $row["teacherPhone"];
        $teacherCurrentAddress = $row["teacherCurrentAddress"];
        $teacherParmanentAddress  = $row["teacherParmanentAddress"];
        $teacherCity  = $row["teacherCity"];
        $teacherZipcode  = $row["teacherZipcode"];
        $teacherPassword  = $row["teacherPassword"];

        $teacherSubjectExpert  = $row["teacherSubjectExpert"];
        $teacherPreferedAccademicLevel  = $row["teacherPreferedAccademicLevel"];
        $teacherCollege   = $row["teacherCollege"];
        $teacherVarsity   = $row["teacherVarsity"];
        $teacherAvailableinWeek   = $row["teacherAvailableinWeek"];
        $teacherAvailableDays  = $row["teacherAvailableDays"];
        $teacherFee  = $row["teacherFee"];
        $isTeacherVerified  = $row["isTeacherVerified"];
        $countTeacherTuition  = $row["countTeacherTuition"];


        //$teacherProfilePicture  = $row["teacherProfilePicture"];
        $teacherBio  = $row["teacherBio"];
        

    }
} else {
    echo "No records found";
}

if($isTeacherVerified ==1 ){
    $verifiedText ="YES";
}else{
    $verifiedText ="NO";

}

// getting college certificate 
// $selectQuery = "SELECT teacherCollegeCertificate FROM teacherTable WHERE teacherEmail = ?";
// $stmt = $conn->prepare($selectQuery);
// $stmt->bind_param("s", $recerivedEmailfromTeacherHomepage);
// $stmt->execute();
// $stmt->bind_result($collegeCertificatepdfData);
// $stmt->fetch();
// $stmt->close();

// getting varsity certificate
$selectQuery = "SELECT teacherVarsityCertificate FROM teacherTable WHERE teacherEmail = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("s", $recerivedEmailfromTeacherHomepage);
$stmt->execute();
$stmt->bind_result($varsityCertificatepdfData);
$stmt->fetch();
$stmt->close();

/// getting teacher experience 
$selectQuery = "SELECT teacherExperience FROM teacherTable WHERE teacherEmail = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("s", $recerivedEmailfromTeacherHomepage);
$stmt->execute();
$stmt->bind_result($teacherExperiencepdfData);
$stmt->fetch();
$stmt->close();


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
                                <label for="teacherFirstName" class="form-label">First Name</label>
                                
                                <input type="text" class="form-control" id="teacherFirstName" name="teacherFirstName" value="<?php echo $teacherFirstName; ?>" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="teacherLastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="teacherLastName" name="teacherLastName" value="<?php echo $teacherLastName; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="teacherDOB" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="teacherDOB" name="teacherDOB" value="<?php echo $teacherDOB; ?>" required>
                            </div>

                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="teacherGender" id="teacherGenderMale"
                                        value="male" <?php if ($teacherGender === 'male') echo 'checked'; ?> required>
                                    <label class="form-check-label" for="teacherGenderMale">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="teacherGender" id="teacherGenderFemale"
                                        value="female" <?php if ($teacherGender === 'female') echo 'checked'; ?>>
                                    <label class="form-check-label" for="teacherGenderFemale">Female</label>
                                </div>
                            </div>

                            <!-- ************************ E M A I L ************************ -->
                            <div class="col-md-6">
                                <label for="teacherEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="teacherEmail" name="teacherEmail" value="<?php echo $teacherEmail; ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="teacherPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="teacherPhone" name="teacherPhone" value="<?php echo $teacherPhone; ?>">
                        </div>
                    </div>
                    <!-- Location Information Section -->
                    <div class="location-section">
                        <h4>Location Information</h4>
                        <div class="mb-3">
                            <label for="teacherParmanentAddress" class="form-label">Permanent Address</label>
                            <textarea class="form-control" id="teacherParmanentAddress" name="teacherParmanentAddress" rows="3"
                            require><?php echo $teacherParmanentAddress; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="teacherCurrentAddress" class="form-label">Current Address</label>
                            <textarea class="form-control" id="teacherCurrentAddress" name="teacherCurrentAddress" rows="3"
                            require><?php echo $teacherCurrentAddress; ?></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="teacherCity" class="form-label">City</label>
                                <input type="text" class="form-control" id="teacherCity" name="teacherCity" value="<?php echo $teacherCity; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="teacherZipcode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="teacherZipcode" name="teacherZipcode" value="<?php echo $teacherZipcode; ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Additional Student Information Section -->
                    <div class="additional-section">
                        <h4>Additional Information</h4>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="Password" name="Password" value="<?php echo $teacherPassword; ?>">
                        </div>
                        

<!-- subject experties -->
                        <div class="mb-3">
                            <label for="teacherSubjectExpert" class="form-label">Subject Experties: </label>
                            <input type="text" class="form-control" id="teacherSubjectExpert" name="teacherSubjectExpert" value="<?php echo $teacherSubjectExpert; ?>" >
                        </div>
<!-- teacher Prefered accademic level -->

                        <div class="mb-3">
                            <label for="teacherPreferedAccademicLevel" class="form-label">Prefered Accademic Level:</label>
                            <input type="text" class="form-control" id="teacherPreferedAccademicLevel" name="teacherPreferedAccademicLevel" value="<?php echo $teacherPreferedAccademicLevel; ?>" >
                        </div>

<!--college name -->
                        <div class="mb-3">
                            <label for="teacherCollege" class="form-label">College Name:</label>
                            <input type="text" class="form-control" id="teacherCollege" name="teacherCollege" value="<?php echo $teacherCollege; ?>" >
                        </div>

                        
<!--college certificate -->

                        <div class="mb-3">
                            <label for="teacherCollegeCertificate" class="form-label">College Certificate:</label>
                            <!-- <a href="displayCollegeCertificate.php?id=' . $pdfCollegeCertificate . '" target="_blank" class="btn">View College Certificate</a> -->
                            <?php
                            $pdftype = 'college'; // Replace with the actual PDF ID
                            echo '<a href="displayPDF.php?id=' . $pdftype . '" target="_blank">Click here to view PDF</a>';
                            ?>
                        </div>

<!--varsity name -->
                        <div class="mb-3">
                            <label for="teacherVarsity" class="form-label">Varsity Name:</label>
                            <input type="text" class="form-control" id="teacherVarsity" name="teacherVarsity"  value="<?php echo $teacherVarsity; ?>">
                        </div>

                        <!--varsity certificate -->
                        <div class="mb-3">
                            <label for="teacherCollegeCertificate" class="form-label">Varsity Certificate:</label>
                            <?php
                            $pdftype = 'varsity'; // Replace with the actual PDF ID
                            echo '<a href="displayPDF.php?id=' . $pdftype . '" target="_blank">Click here to view PDF</a>';
                            ?>
                        </div>
<!-- teacher experience -->
                        <div class="mb-3">
                            <label for="teacherCollegeCertificate" class="form-label">Teacher Experience:</label>
                            <?php
                            $pdftype = 'experience'; // Replace with the actual PDF ID
                            echo '<a href="displayPDF.php?id=' . $pdftype . '" target="_blank">Click here to view PDF</a>';
                            ?>
                        </div>


<!--available in week -->
                        <div class="mb-3">
                            <label for="teacherAvailableinWeek" class="form-label">Available in week:</label>
                            <input type="text" class="form-control" id="teacherAvailableinWeek" name="teacherAvailableinWeek" value="<?php echo $teacherAvailableinWeek; ?>" >
                        </div>

                        <!--teacher available days -->
                        <div class="mb-3">
                            <label for="teacherAvailableDays" class="form-label">Available Days:</label>
                            <input type="text" class="form-control" id="teacherAvailableDays" name="teacherAvailableDays"  value="<?php echo $teacherAvailableDays; ?>">
                        </div>

                        <!--teacher fees -->
                        <div class="mb-3">
                            <label for="teacherFee" class="form-label">Fee:</label>
                            <input type="text" class="form-control" id="teacherFee" name="teacherFee" value="<?php echo $teacherFee; ?>" >
                        </div>

                        
                        <!-- tution count -->
                        <div class="mb-3">
                            <label for="countTution">Service Count: <?php echo $countTeacherTuition; ?></label>
                           
                        </div>
<!-- ****************************************************************** -->
                        <div class="form-group">
                            <label for="isVerifiedLabel">Verified Teacher: <?php echo $verifiedText; ?></label>
                        </div>


                        <div class="mb-3">
                            <label for="teacherBio" class="form-label">Bio</label>
                            <textarea class="form-control" id="teacherBio" name="teacherBio" rows="5" ><?php echo $teacherBio; ?></textarea>
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
                        

                        $teacherFirstName = $_POST["teacherFirstName"];
                        $teacherLastName  = $_POST["teacherLastName"];
                        $teacherDOB  = $_POST["teacherDOB"];
                        $teacherGender  = $_POST["teacherGender"];
                        $teacherEmail  = $_POST["teacherEmail"];
                        $teacherPhone = $_POST["teacherPhone"];
                        $teacherCurrentAddress = $_POST["teacherCurrentAddress"];
                        $teacherParmanentAddress  = $_POST["teacherParmanentAddress"];
                        $teacherCity  = $_POST["teacherCity"];
                        $teacherZipcode  = $_POST["teacherZipcode"];
                        $teacherPassword  = $_POST["Password"];

                        $teacherSubjectExpert  = $_POST["teacherSubjectExpert"];
                        $teacherPreferedAccademicLevel  = $_POST["teacherPreferedAccademicLevel"];
                        $teacherCollege   = $_POST["teacherCollege"];
                        $teacherVarsity   = $_POST["teacherVarsity"];
                        $teacherAvailableinWeek   = $_POST["teacherAvailableinWeek"];
                        $teacherAvailableDays  = $_POST["teacherAvailableDays"];
                        $teacherFee  = $_POST["teacherFee"];
                        $teacherBio  = $_POST["teacherBio"];



                        // Prepare the SQL statement
                        $sql = "UPDATE teacherTable SET teacherFirstName=?, teacherLastName=?, teacherDOB=?, teacherGender=?, teacherEmail=?, teacherPhone=?, teacherCurrentAddress=?, teacherParmanentAddress=?, teacherCity=?, teacherZipcode=?, teacherPassword=?, teacherBio=?,teacherSubjectExpert=?, teacherPreferedAccademicLevel=?,teacherCollege=?, teacherVarsity =?, teacherAvailableinWeek=?, teacherAvailableDays =?, teacherFee =?   WHERE teacherEmail = ?";

                        // Prepare and bind the statement
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssssssssssssssssisds", $teacherFirstName, $teacherLastName, $teacherDOB, $teacherGender, $teacherEmail, $teacherPhone, $teacherCurrentAddress,$teacherParmanentAddress, $teacherCity, $teacherZipcode, $teacherPassword, $teacherBio, $teacherSubjectExpert, $teacherPreferedAccademicLevel, $teacherCollege, $teacherVarsity, $teacherAvailableinWeek, $teacherAvailableDays, $teacherFee, $recerivedEmailfromTeacherHomepage);

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
                    <a href="teacherHomepage.php" class="btn btn-secondary">Homepage</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
