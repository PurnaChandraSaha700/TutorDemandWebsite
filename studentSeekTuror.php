<?php
session_start();
$studentEmailReceivedfromLoginPage = $_SESSION['studentEmailfromStudentHomepage'];

// $firstName =$_POST['firstName'];

$conn =new mysqli('localhost','root','','tutorquestdatabase');
        if($conn->connect_error){
            die('connection failed : '.$conn->connect_error);
        }
        $query = "SELECT studentId FROM StudentTable WHERE studentEmail = '$studentEmailReceivedfromLoginPage'";
        $result = $conn->query($query);
        
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $studentId = $row['studentId'];
                
               
            } else {
                echo "Student not found.";
            }
            $result->close();
        } else {
            echo "Query error: " . $mysqli->error;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            if (isset($_POST['submit'])){

                
                $tutorGender = $_POST['tutorGender'];
                $tutorLocationZipCode = $_POST['tutorLocationZipCode'];
                
                $studentAcademicLevel = $_POST['studentAcademicLevel'];
                // $tutorAvailableInWeek = $_POST['firstName'];
                $tutionMethod  = $_POST['tutionMethod'];
                $anySpecialRequirement = $_POST['anySpecialRequirement'];
                $sessionDurationInHours = $_POST['sessionDurationInHours'];
                $numberOfSessions = $_POST['numberOfSessions'];
                $tutorBudget = $_POST['tutorBudget'];
                $postDate = date("Y-m-d");


                $selectedSubjects = $_POST['tutorSubjectExpert']; // Array of selected subjects
                $selectedSubjectsString = implode(', ', $selectedSubjects);



                $selectedDays = $_POST['tutorAvailableInWeek'];
                $selectedDaysString = implode(', ', $selectedDays); 
                $numberOfSelectedDays = count($selectedDays);


                $sql = "INSERT INTO seekTutor (studentId, tutorGender, tutorLocationZipCode, tutorSubjectExpert, studentAcademicLevel, tutorAvailableInWeek, tutionMethod, anySpecialRequirement, sessionDurationInHours, numberOfSessions, tutorBudget, postDate, availableDays) 
                VALUES ('$studentId', '$tutorGender', '$tutorLocationZipCode', '$selectedSubjectsString', '$studentAcademicLevel', '$numberOfSelectedDays', '$tutionMethod', '$anySpecialRequirement', '$sessionDurationInHours', '$numberOfSessions', '$tutorBudget', '$postDate', '$selectedDaysString')";

                // Execute the query
                if ($conn->query($sql) === TRUE) {
                    echo "Data inserted successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }


            }


            
        }


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seek Tutor Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .form-group label {
            font-weight: bold;
        }
        .submit-button {
            margin-top: 20px;
            text-align: center;
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
        <h2 class="text-center mb-4">Seek Tutor</h2>
        <form method="post">
            

            <div class="form-group mb-3">

                <label for="tutorSubjectExpert" class="form-label">Subjects Requrement:</label>
                <select class="form-select" id="tutorSubjectExpert" name="tutorSubjectExpert[]" multiple required>
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
            <div class="form-group mb-3">
                <label for="studentAcademicLevel" class="form-label">Academic Level</label>
                <select class="form-select" id="studentAcademicLevel" name="studentAcademicLevel" required>
                <option value="highSchool">High School</option>
                <option value="undergraduate">Undergraduate</option>
                <option value="graduate">Graduate</option>
                </select>

            </div>


            <div class="form-group mb-3">
                <label for="tutorGender">Preferred Tutor Gender:</label>
                <select class="form-control" id="tutorGender" name="tutorGender">
                    <option value="any">Any</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="tutorLocationZipCode">Tutor Location Zip Code:</label>
                <input type="text" class="form-control" id="tutorLocationZipCode" name="tutorLocationZipCode">
            </div>
            
            <div class="form-group mb-3">


                <h4>Available for:</h4>
                <div class="mb-3">
                    <label for="tutorAvailableInWeek" class="form-label">Available in week</label>
                    <select class="form-select" id="tutorAvailableInWeek" name="tutorAvailableInWeek[]" multiple required>
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
            <div class="form-group mb-3">

                <label for="tutionMethod">Tuition Method:</label>
                <select class="form-control" id="tutionMethod" name="tutionMethod">
                    <option value="inPerson">In-Person</option>
                    <option value="online">online</option>
                    
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="anySpecialRequirement">Any Special Requirement:</label>
                <textarea class="form-control" id="anySpecialRequirement" name="anySpecialRequirement" rows="3"></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="sessionDurationInHours">Session Duration in Hours:</label>
                <input type="number" step="0.5" class="form-control" id="sessionDurationInHours" name="sessionDurationInHours">
            </div>
            <div class="form-group mb-3">
                <label for="numberOfSessions">Number of Sessions:</label>
                <input type="number" class="form-control" id="numberOfSessions" name="numberOfSessions">
            </div>
            <div class="form-group mb-3">
                <label for="tutorBudget">Tutor Budget:</label>
                <input type="text" class="form-control" id="tutorBudget" name="tutorBudget">
            </div>
            <div class="submit-button">
                <button type="submit" class="btn btn-primary btn-lg" name ="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
