<?php
session_start();
$teacherEmailFromPrevious = $_SESSION['teacherEmailSignUp'];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn =new mysqli('localhost','root','','tutorquestdatabase');


    // Get values from the form

    
    $selectedSubjects = $_POST['subjects']; // Array of selected subjects
    $selectedSubjectsString = implode(', ', $selectedSubjects);
 



    $selectedAcademicLevel = $_POST['academicLevel'];
    $college = $_POST['college'];

    $varsity = $_POST['varsity'];

    $fee = $_POST['fee'];
    $selectedDays = $_POST['availableinWeek'];
    $selectedDaysString = implode(', ', $selectedDays); 
    $numberOfSelectedDays = count($selectedDays);
   
    

    /// uploading college certificate pdf ************************************************************************************
    $pdfFileCollegeCertificate = $_FILES['collegeCertificate'];

    $tmpPathCollegeCertificate = $pdfFileCollegeCertificate['tmp_name'];

    $pdfDataCollegeCertificate = file_get_contents($tmpPathCollegeCertificate);

    $updateQueryCollegeCertificate = "UPDATE TeacherTable SET teacherCollegeCertificate  = ? WHERE teacherEmail  = ?";

    $stmt = $conn->prepare($updateQueryCollegeCertificate);
    $stmt->bind_param("ss", $pdfDataCollegeCertificate, $teacherEmailFromPrevious);
    $stmt->execute();
    $stmt->close();

    /// uploading  varsity pdf *************************************************************************************************
    $pdfFileVarsityCertificate = $_FILES['varsityCertificate'];

    $tmpPathVarsityCertificate = $pdfFileVarsityCertificate['tmp_name'];

    $pdfDataVarsityCertificate = file_get_contents($tmpPathVarsityCertificate);

    $updateQueryVarsityCertificate = "UPDATE TeacherTable SET teacherVarsityCertificate  = ? WHERE teacherEmail  = ?";

    $stmt = $conn->prepare($updateQueryVarsityCertificate);
    $stmt->bind_param("ss", $pdfDataVarsityCertificate, $teacherEmailFromPrevious);
    $stmt->execute();
    $stmt->close();


    /// uploading college experience pdf **************************************************************************************
    $pdfFileExperiencePdf = $_FILES['experiencePdf'];

    $tmpPathExperiencePdf = $pdfFileExperiencePdf['tmp_name'];

    $pdfDataExperiencePdf = file_get_contents($tmpPathExperiencePdf);

    $updateQueryExperiencePdf = "UPDATE TeacherTable SET teacherExperience   = ? WHERE teacherEmail  = ?";

    $stmt = $conn->prepare($updateQueryExperiencePdf);
    $stmt->bind_param("ss", $pdfDataExperiencePdf, $teacherEmailFromPrevious);
    $stmt->execute();
    $stmt->close();

// connecting to database and updating the values

        if($conn->connect_error){
            die('connection failed : '.$conn->connect_error);
        }


        $sql = "UPDATE TeacherTable
        SET teacherSubjectExpert = '$selectedSubjectsString',
            teacherPreferedAccademicLevel = '$selectedAcademicLevel',
            teacherCollege = '$college',
            teacherVarsity = '$varsity',
            teacherAvailableinWeek ='$numberOfSelectedDays',
            teacherAvailableDays ='$selectedDaysString',
            teacherFee ='$fee',
            isTeacherVerified = 0,
            countTeacherTuition =0
        WHERE teacherEmail = '$teacherEmailFromPrevious'";

        // Execute the query
if ($conn->query($sql) === TRUE) {
    header('Location: signUpSuccessful.html');
} else {
    echo "Error updating record: " . $conn->error;
}




// Close the connection
$conn->close();
}



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutorQuest - Teacher Sign Up</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .signup-container {
            max-width: 800px;
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
        .available-section,
        .TeacherFee-section,
        .personal-section,
        .subject-section,
        .qualification-section {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>

<body style="background-image: url('img/page2.jpg');">
<?php



?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 signup-container">
                <div class="signup-header">
                    <h2>TutorQuest - Teacher Sign Up</h2>
                    <p>Please enter your details and expertise below.</p>
                </div>
                <form method="post" enctype="multipart/form-data">
                    

                    <!-- Subject Expertise Section -->
                    <div class="subject-section">
                        <h4>Subject Expertise</h4>
                        <div class="mb-3">
                            <label for="subjects" class="form-label">Subjects You Can Teach</label>
                            <select class="form-select" id="subjects" name="subjects[]" multiple required>
                                <option value="math">Mathematics</option>
                                <option value="english">English</option>
                                <option value="science">Science</option>
                                <option value="history">History</option>
                                <option value="chemistry">Chemistry</option>
                                <option value="physics">Physics</option>
                                <option value="biology">Biology</option>
                                <option value="geography">Geography</option>
                                <option value="computer-science">Computer Science</option>
                                <option value="literature">Literature</option>
                                <option value="art">Art</option>
                                <option value="music">Music</option>
                                <option value="economics">Economics</option>
                                <option value="psychology">Psychology</option>
                                <option value="foreign-language">Foreign Language</option>
                                <option value="philosophy">Philosophy</option>
                                <option value="physical-education">Physical Education</option>
                                <option value="engineering">Engineering</option>
                                <option value="political-science">Political Science</option>
                                <option value="environmental-science">Environmental Science</option>
                                <!-- Add more subjects here -->
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="academicLevel" class="form-label">Academic Level</label>
                            <select class="form-select" id="academicLevel" name="academicLevel" required>
                                <option value="highSchool">High School</option>
                                <option value="undergraduate">Undergraduate</option>
                                <option value="graduate">Graduate</option>
                            </select>
                        </div>
                        
                    </div>

                    <!-- Educational Qualifications Section -->
                    <div class="qualification-section">
                        <h4>Educational Qualifications</h4>

                        <!-- cor college information  -->
                        <div class="mb-3">
                            <label for="college" class="form-label">College:</label>
                            <input type="text" class="form-control" id="college" name="college" required>
                        </div>

                        <div class="mb-3">
                            <label for="collegeCertificate" class="form-label">College Certificate (PDF)</label>
                            <input type="file" class="form-control" id="collegeCertificate" name="collegeCertificate" accept=".pdf">
                        </div>

                        <!-- for varsity information -->

                        <div class="mb-3">
                            <label for="varsity" class="form-label">Varsity:</label>
                            <input type="text" class="form-control" id="varsity" name="varsity" >
                        </div>

                        <div class="mb-3">
                            <label for="varsityCertificate" class="form-label">Varsity Certificate (PDF) [if any]</label>
                            <input type="file" class="form-control" id="varsityCertificate" name="varsityCertificate" accept=".pdf">
                        </div>

                        <!-- teacher Experience section  -->

                        <div class="mb-3">
                            <label for="experiencePdf" class="form-label">Experience (PDF) [if any]</label>
                            <input type="file" class="form-control" id="experiencePdf" name="experiencePdf" accept=".pdf">
                        </div>
                        
                        
                    </div>
                    <div class="available-section">

                        <h4>Available for:</h4>
                        <div class="mb-3">
                            <label for="available" class="form-label">Available in week</label>
                            <select class="form-select" id="available" name="availableinWeek[]" multiple required>
                                <option value="Saturnday">Saturnday</option>
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                        </div>


                    </div>

                    <div class="TeacherFee-section">

                        <div class="mb-3">
                            <label for="fee" class="form-label">Fee per Hour:</label>
                            <input type="text" class="form-control" id="fee" name="fee" >
                        </div>

                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    <a href="homePage.html" class="btn btn-secondary">Exit</a>
                </div>
            </div>
        </div>
    </div>








</body>

</html>
