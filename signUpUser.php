<?php
    session_start();
    
// collecting all information from signUpUser html file
    $firstName =$_POST['firstName'];
    $lastName =$_POST['lastName'];
    $dateOfBirth =$_POST['dateOfBirth'];
    $gender =$_POST['gender'];
    $email =$_POST['email'];
    $phone =$_POST['phone'];
    $permanentAddress =$_POST['permanentAddress'];
    $currentAddress =$_POST['currentAddress'];
    $city =$_POST['city'];
    $zipCode =$_POST['zipCode'];
    $role =$_POST['role'];
    $password =$_POST['password'];
    $confirmPassword =$_POST['confirmPassword'];

    $_SESSION['teacherEmailSignUp'] = $email;


    $studentCountPost =0;
    $studentTutorCount =0;
    $isVarifiedStudent = 1;
    // checking the user role teacher or student
    if($role == "teacher"  && $password == $confirmPassword ){ /// uploading data to teacher table  ***************************************************************************************************
        $conn =new mysqli('localhost','root','','tutorquestdatabase');


        $conn =new mysqli('localhost','root','','tutorquestdatabase');
        if($conn->connect_error){
            die('connection failed : '.$conn->connect_error);
        }
        // checking if there already exist an account with same email
        $sql3 = "SELECT * FROM teachertable WHERE teacherEmail  = '$email'";
        $result = mysqli_query($conn, $sql3);

        // Check if the query returned any rows
        if (mysqli_num_rows($result) > 0) {
            header('Location: signUpFailed.html');
        }else{


        $sql = "INSERT INTO TeacherTable 
        (teacherFirstName, teacherLastName, teacherDOB, teacherGender, teacherEmail, 
        teacherPhone, teacherCurrentAddress, teacherParmanentAddress, teacherCity, 
        teacherZipcode, teacherPassword) 
        VALUES 
        ('$firstName', '$lastName', '$dateOfBirth', '$gender', '$email', 
        '$phone', '$currentAddress', '$permanentAddress', '$city', 
        '$zipCode', '$password')";

        if ($conn->query($sql) === TRUE) {

            header('Location: teacherSignUpPage2.php');
        } else {
            echo "Error: " . $conn->error;
        }



        }


        
    $conn->close();



    }
    else if($role == "student" && $password != $confirmPassword ){  // pass and confirm pass id not matched ****************************************************************************************
        header('Location: signUpFailed.html');
    }
    else if($role == "student" && $password == $confirmPassword ){/// uploading data to student table  ***************************************************************************************************
        // if all the student information is correct 
        // connection to database 
        $conn =new mysqli('localhost','root','','tutorquestdatabase');
        if($conn->connect_error){
            die('connection failed : '.$conn->connect_error);
        }
        // checking if there already exist an account with same email
        $sql2 = "SELECT * FROM studenttable WHERE studentEmail = '$email'";
        $result = mysqli_query($conn, $sql2);

        // Check if the query returned any rows
        if (mysqli_num_rows($result) > 0) {
            header('Location: signUpFailed.html');
        } else {
            // if this is a new account then information is inserted into database
            $sql = "INSERT INTO studenttable (studentFirstName, studentLastName, studentDOB, studentGender, studentEmail, studentPhone, studentPermanentAddress, studentCurrentAddress, studentCity, studentZipCode, studentPassword, studentCountPost,tutorCount, isVarifiedStudent) VALUES ('$firstName','$lastName','$dateOfBirth','$gender','$email','$phone','$permanentAddress','$currentAddress','$city','$zipCode','$password', $studentCountPost,$studentTutorCount,$isVarifiedStudent)";
            if (mysqli_query($conn, $sql)) {
                header('Location: signUpSuccessful.html');
                
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }


        mysqli_close($conn);
    
    }
    

    

    // $conn =new mysqli('localhost','root','','tutorquestdatabase');
    // if($conn->connect_error){
    //     die('connection failed : '.$conn->connect_error);
    // }
    // else{
    //     $stmt = $conn->prepare("insert into StudentTable(studentName, studentEmail,studentPhone) values(?,?,?)");
    //     $stmt->bind_param("ssi",$stundetName,$studentEmail,$stundentPhone);
    //     $stmt->execute();
    //     echo "registration successful";
    //     $stmt->close();
    //     $conn->close();
    // }

?>