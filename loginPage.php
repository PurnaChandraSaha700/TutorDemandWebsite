<?php
session_start();

    $passcheck = 0;
    $username =$_POST['loginUsername'];
    $password =$_POST['loginPassword'];
    $conn =new mysqli('localhost','root','','tutorquestdatabase');
        if($conn->connect_error){
            die('connection failed : '.$conn->connect_error);
        }


    // Sanitize user input
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Query to check student table
    $studentQuery = "SELECT * FROM studenttable WHERE studentEmail = '$username' AND studentPassword = '$password'";
    $studentResult = $conn->query($studentQuery);

    if ($studentResult->num_rows > 0) {
        $_SESSION['studentEmailfromLoginPage'] = $username;
        header("Location: studentHomepage.php");
        exit;
    }

    // Query to check teacher table
    $teacherQuery = "SELECT * FROM teachertable WHERE teacherEmail = '$username' AND teacherPassword = '$password'";
    $teacherResult = $conn->query($teacherQuery);

    if ($teacherResult->num_rows > 0) {
        $_SESSION['teacherEmailfromLoginPage'] = $username;
        header("Location: teacherHomepage.php");
        exit;
    }

    // Check admin login
    if ($username === 'rafee' && $password === '1111') {
        $_SESSION['user_type'] = 'admin';
        header("Location: adminHomePage.php");
        exit;
    }

    else{
        header('Location: logInFailed.html');
    }



?>