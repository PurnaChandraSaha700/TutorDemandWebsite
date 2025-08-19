<?php

session_start();


$teacherId =0;
$teacherFirstName = "";
$teacherLastName  = "";
$teacherDOB  = "";
$teacherGender  ="";
$teacherEmail  = "";
$teacherPhone = "";
$teacherCurrentAddress = "";
$teacherParmanentAddress  = "";
$teacherCity  = "";
$teacherZipcode  = "";
$teacherPassword  = "";

$teacherSubjectExpert  = "";
$teacherPreferedAccademicLevel  = "";
$teacherCollege   = "";
$teacherCollegeCertificate   = "";
$teacherVarsity   = "";
$teacherVarsityCertificate   = "";
$teacherExperience   = "";
$teacherAvailableinWeek   = 0;
$teacherAvailableDays  = "";
$teacherFee  = 0;
$countTeacherTuition  = 0;
$isTeacherVerified  = 0;
$teacherBio  = "";
$teacherProfilePicture  = "";


        $fullName = $teacherFirstName . " " . $teacherLastName;
        $teacherProfilePicture="";
        $verifiedText ="";





        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['searchBtn'])){

                $searchEmail = $_POST["searchEmail"];
                $_SESSION['searchEmailinUpdateTeacherByAdmin'] = $searchEmail;
                $_SESSION['teacherEmailFromTeacherUpdateProfile']=$searchEmail;
        
                $conn =new mysqli('localhost','root','','tutorquestdatabase');
                if($conn->connect_error){
                    die('connection failed : '.$conn->connect_error);
                }
                // SQL query to retrieve student information using email as filter
                $sql = "SELECT * FROM teacherTable WHERE teacherEmail = '$searchEmail'";
                $result = $conn->query($sql);
        
                // Check if there are any rows in the result
                if ($result->num_rows > 0) {
                    // Loop through each row and output the data
                    while ($row = $result->fetch_assoc()) {



                        $teacherId =$row["teacherId"];
                        $teacherFirstName = $row["teacherFirstName"];
                        $teacherLastName  =$row["teacherLastName"];
                        $teacherDOB  = $row["teacherDOB"];
                        $teacherGender  =$row["teacherGender"];
                        $teacherEmail  = $row["teacherEmail"];
                        $teacherPhone = $row["teacherPhone"];
                        $teacherCurrentAddress =$row["teacherCurrentAddress"];
                        $teacherParmanentAddress  =$row["teacherParmanentAddress"];
                        $teacherCity  = $row["teacherCity"];
                        $teacherZipcode  = $row["teacherZipcode"];
                        $teacherPassword  = $row["teacherPassword"];
                        
                        $teacherSubjectExpert  = $row["teacherSubjectExpert"];
                        $teacherPreferedAccademicLevel  = $row["teacherPreferedAccademicLevel"];
                        $teacherCollege   = $row["teacherCollege"];
                        $teacherCollegeCertificate   = $row["teacherCollegeCertificate"];
                        $teacherVarsity   = $row["teacherVarsity"];
                        $teacherVarsityCertificate   =$row["teacherVarsityCertificate"];
                        $teacherExperience   = $row["teacherExperience"];
                        $teacherAvailableinWeek   =$row["teacherAvailableinWeek"];
                        $teacherAvailableDays  = $row["teacherAvailableDays"];
                        $teacherFee  = $row["teacherFee"];
                        $countTeacherTuition  =$row["countTeacherTuition"];
                        $isTeacherVerified  = $row["isTeacherVerified"];
                        $teacherBio  = $row["teacherBio"];
                        $teacherProfilePicture  = $row["teacherProfilePicture"];


        
                    }

                    if($isTeacherVerified ==1 ){
                        $verifiedText ="YES";
                    }else{
                        $verifiedText ="NO";
            
                    }


            }else {
                echo "No records found";
                echo $searchEmail;
            }
            
   
        }


        elseif (isset($_POST['submit'])){


            $updateEmail = $_SESSION['searchEmailinUpdateTeacherByAdmin'];
            $conn =new mysqli('localhost','root','','tutorquestdatabase');
            if($conn->connect_error){
                die('connection failed : '.$conn->connect_error);
            }
            
            // Assuming you have retrieved all the form values here
            // $teacherId =$_POST['teacherId'];
            $teacherFirstName = $_POST['teacherFirstName'];
            $teacherLastName  = $_POST['teacherFirstName'];
            $teacherDOB  = $_POST['teacherDOB'];
            $teacherGender  =$_POST['teacherGender'];
            $teacherEmail  = $_POST['teacherEmail'];
            $teacherPhone = $_POST['teacherPhone'];
            $teacherCurrentAddress = $_POST['teacherCurrentAddress'];
            $teacherParmanentAddress  = $_POST['teacherParmanentAddress'];
            $teacherCity  = $_POST['teacherCity'];
            $teacherZipcode  = $_POST['teacherZipcode'];
            $teacherPassword  = $_POST['teacherPassword'];

            $teacherSubjectExpert  = $_POST['teacherSubjectExpert'];
            $teacherPreferedAccademicLevel  = $_POST['teacherPreferedAccademicLevel'];
            $teacherCollege   = $_POST['teacherCollege'];
            // $teacherCollegeCertificate   = $_POST['teacherCollegeCertificate'];
            $teacherVarsity   = $_POST['teacherVarsity'];
            // $teacherVarsityCertificate   = $_POST['teacherVarsityCertificate'];
            // $teacherExperience   = $_POST['teacherExperience'];
            $teacherAvailableinWeek   =$_POST['teacherAvailableinWeek'];
            $teacherAvailableDays  = $_POST['teacherAvailableDays'];
            $teacherFee  = $_POST['teacherFee'];
            $countTeacherTuition  =$_POST['countTeacherTuition'];
            $isTeacherVerified  = $_POST['isTeacherVerified'];
            $teacherBio  = $_POST['teacherBio'];
            // $teacherProfilePicture  = $_POST['teacherProfilePicture'];








            $sql = "UPDATE teacherTable SET 
            teacherFirstName='$teacherFirstName', 
            teacherLastName='$teacherLastName', 
            teacherDOB='$teacherDOB', 
            teacherGender='$teacherGender', 
            teacherPhone='$teacherPhone', 
            teacherEmail ='$teacherEmail',
            teacherCurrentAddress='$teacherCurrentAddress',
            teacherParmanentAddress='$teacherParmanentAddress', 
            teacherCity='$teacherCity', 
            teacherZipcode='$teacherZipcode', 
            teacherPassword='$teacherPassword', 
            teacherSubjectExpert='$teacherSubjectExpert', 
            teacherPreferedAccademicLevel='$teacherPreferedAccademicLevel', 
            teacherCollege='$teacherCollege', 
            teacherVarsity='$teacherVarsity', 
            teacherAvailableinWeek='$teacherAvailableinWeek', 
            teacherAvailableDays='$teacherAvailableDays', 
            teacherFee='$teacherFee', 
            countTeacherTuition='$countTeacherTuition', 
            isTeacherVerified='$isTeacherVerified', 
            teacherBio='$teacherBio'
            WHERE teacherEmail='$updateEmail'";

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully.";
            } else {
                echo "Error updating record: " . $conn->error;
            }

            // Close the statement and connection
            // $stmt->close();
            $conn->close();

        }
    }




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
       body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .profile-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .search-container {
            max-width: 1000px;
            max-height: 200px;
            padding: 10px;
            margin: 0 auto;
            padding: 5px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .search-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-header h2 {
            color: #007bff;
        }
        .search-form {
            display: flex;
            flex-direction: column;
        }
        .search-input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .search-button {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            padding: 10px;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #0056b3;
        }



        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto;
            display: block;
            padding-bottom: 200px;
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


    <div class="search-container">
        <div class="search-header">
            <h2>Email Search</h2>
        </div>
        <form method="post">
            <div class="mb-3">
                <input type="text" class="search-input form-control" name="searchEmail" placeholder="Enter email...">
            </div>
            <div class="d-grid">
                <button type="submit" class="search-button btn btn-primary" name ="searchBtn">Search</button>
            </div>
        </form>
    </div>




    <div class="profile-header">
    <h1><?php echo $fullName; ?></h1>
    </div>
    <div class="profile-container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="profile-picture">
                    <?php if ($teacherProfilePicture): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($teacherProfilePicture); ?>" alt="Profile Picture" style="max-width: 180px; max-height 100px">
                    <?php else: ?>
                        <img src="img/defaultDP.jpg" alt="Default Profile Picture" style="max-width: 180px; max-height 100px">
                    <?php endif; ?>
                </div>

                <div style="position: absolute; top: 10px; left: 10px;">
                <a href="adminHomePage.php" class="btn btn-danger">Back</a>
                </div>


                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <!-- Personal Information Section -->
                    <div class="personal-section">

                    <div class="col-md-6">
                        <label for="teacherId" class="form-label">Teacher ID:</label>
                        <input type="text" class="form-control" id="teacherId" name="teacherId" value="<?php echo $teacherId; ?>" required>
                    </div>

                        <div class="row mb-3">
                            

                            <div class="col-md-6">
                                <label for="teacherFirstName" class="form-label">First Name:</label>
                                
                                <input type="text" class="form-control" id="teacherFirstName" name="teacherFirstName" value="<?php echo $teacherFirstName; ?>" >
                            </div>

                            <div class="col-md-6">
                                <label for="teacherLastName" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="teacherLastName" name="teacherLastName" value="<?php echo $teacherLastName; ?>">
                            </div>


                        </div>
                        <div class="row mb-3">
                            
                            <div class="col-md-6">
                                <label for="teacherDOB" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="teacherDOB" name="teacherDOB" value="<?php echo $teacherDOB; ?>" required>
                            </div>

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

                        </div>


                            
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="teacherPhone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="teacherPhone" name="teacherPhone" value="<?php echo $teacherPhone; ?>">
                            </div>

                            <!-- ************************ E M A I L ************************ -->
                            <div class="col-md-6">
                                <label for="teacherEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="teacherEmail" name="teacherEmail" value="<?php echo $teacherEmail; ?>">
                            </div>
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


                        <!-- subject experties -->
                        <div class="mb-3">
                            <label for="teacherSubjectExpert" class="form-label">Subject Expersites:</label>
                            <input type="text" class="form-control" id="teacherSubjectExpert" name="teacherSubjectExpert" value="<?php echo $teacherSubjectExpert; ?>">
                        </div>


                         <!-- prefered accademic level for teacher  -->
                        <div class="mb-3">
                            <label for="teacherPreferedAccademicLevel" class="form-label">Is Verified Student?</label>
                            <select class="form-select" id="teacherPreferedAccademicLevel" name="teacherPreferedAccademicLevel">
                                <option value="High School"<?php if ($teacherPreferedAccademicLevel == "High School") echo ' selected'; ?>>High School</option>
                                <option value="Undergraduate"<?php if ($teacherPreferedAccademicLevel == "Undergraduate") echo ' selected'; ?>>Undergraduate</option>
                                <option value="Graduate"<?php if ($teacherPreferedAccademicLevel == "Graduate") echo ' selected'; ?>>Graduate</option>
                            </select>
                        </div>



                       

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="teacherCollege" class="form-label">College:</label>
                                <input type="text" class="form-control" id="teacherCollege" name="teacherCollege" value="<?php echo $teacherCollege; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="teacherVarsity" class="form-label">Varsity Name:</label>
                                <input type="text" class="form-control" id="teacherVarsity" name="teacherVarsity"  value="<?php echo $teacherVarsity; ?>">
                            </div>
                        </div>

                        

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="teacherCollegeCertificate" class="form-label">College Certificate:</label>
                                    <!-- <a href="displayCollegeCertificate.php?id=' . $pdfCollegeCertificate . '" target="_blank" class="btn">View College Certificate</a> -->
                                    <?php
                                    $pdftype = 'college'; // Replace with the actual PDF ID
                                    echo '<a href="displayPDF.php?id=' . $pdftype . '" target="_blank">Click here to view PDF</a>';
                                    ?>
                            </div>
                            <div class="col-md-6">
                                <label for="teacherCollegeCertificate" class="form-label">Varsity Certificate:</label>
                                <?php
                                $pdftype = 'varsity'; // Replace with the actual PDF ID
                                echo '<a href="displayPDF.php?id=' . $pdftype . '" target="_blank">Click here to view PDF</a>';
                                ?>
                            </div>
                        </div>


<!-- teacher experience -->
                        <div class="mb-3">
                            <label for="teacherCollegeCertificate" class="form-label">Teacher Experience:</label>
                            <?php
                            $pdftype = 'experience'; // Replace with the actual PDF ID
                            echo '<a href="displayPDF.php?id=' . $pdftype . '" target="_blank">Click here to view PDF</a>';
                            ?>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="teacherAvailableinWeek" class="form-label">Available in week:</label>
                                <input type="text" class="form-control" id="teacherAvailableinWeek" name="teacherAvailableinWeek" value="<?php echo $teacherAvailableinWeek; ?>" >
                            </div>
                            <div class="col-md-6">
                                <label for="teacherAvailableDays" class="form-label">Available Days:</label>
                                <input type="text" class="form-control" id="teacherAvailableDays" name="teacherAvailableDays"  value="<?php echo $teacherAvailableDays; ?>">
                            </div>
                        </div>




                        


                        <!-- *********************************************************************************************** -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="teacherFee" class="form-label">Fee:</label>
                                <input type="text" class="form-control" id="teacherFee" name="teacherFee" value="<?php echo $teacherFee; ?>" >
                            </div>
                            <div class="col-md-6">
                                <label for="countTeacherTuition" class="form-label">Service Count:</label>
                                <input type="text" class="form-control" id="countTeacherTuition" name="countTeacherTuition" value="<?php echo $countTeacherTuition; ?>">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="teacherPassword" class="form-label">Password:</label>
                                <input type="text" class="form-control" id="teacherPassword" name="teacherPassword" value="<?php echo $teacherPassword; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="isTeacherVerified" class="form-label">Is Verified Student?</label>
                                <select class="form-select" id="isTeacherVerified" name="isTeacherVerified">
                                    <option value="1"<?php if ($isTeacherVerified == 1) echo ' selected'; ?>>Yes</option>
                                    <option value="0"<?php if ($isTeacherVerified == 0) echo ' selected'; ?>>No</option>
                                </select>
                            </div>
                        </div>
                        
                        

<!-- ****************************************************************** -->

                        <div class="mb-3">
                            <label for="teacherBio" class="form-label">Bio</label>
                            <textarea class="form-control" id="teacherBio" name="teacherBio" rows="5" ><?php echo $teacherBio; ?></textarea>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name= "submit" class="btn btn-primary btn-block">Save Changes</button>
                    </div>
                </form>


                
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
