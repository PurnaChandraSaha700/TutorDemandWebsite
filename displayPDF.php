<?php
session_start();
$recerivedEmailfromTeacherUpdateProfile = $_SESSION['teacherEmailFromTeacherUpdateProfile'];

$pdfType = $_GET['id'];

$conn =new mysqli('localhost','root','','tutorquestdatabase');
if($conn->connect_error){
    die('connection failed : '.$conn->connect_error);
}
if($pdfType == 'college'){

    $selectQuery = "SELECT teacherCollegeCertificate FROM teacherTable WHERE teacherEmail = ?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $recerivedEmailfromTeacherUpdateProfile);
    $stmt->execute();
    $stmt->bind_result($collegeCertificatepdfData);
    $stmt->fetch();
    $stmt->close();
    
    
    $conn->close();
    
    // Output PDF data with appropriate content headers
    header("Content-Type: application/pdf");
    echo $collegeCertificatepdfData;

}
else if($pdfType == 'varsity'){

    $selectQuery = "SELECT teacherVarsityCertificate FROM teacherTable WHERE teacherEmail = ?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $recerivedEmailfromTeacherUpdateProfile);
    $stmt->execute();
    $stmt->bind_result($VarsityCertificatepdfData);
    $stmt->fetch();
    $stmt->close();
    
    
    $conn->close();
    
    // Output PDF data with appropriate content headers
    header("Content-Type: application/pdf");
    echo $VarsityCertificatepdfData;


}


else if($pdfType == 'experience'){

    $selectQuery = "SELECT  teacherExperience  FROM teacherTable WHERE teacherEmail = ?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $recerivedEmailfromTeacherUpdateProfile);
    $stmt->execute();
    $stmt->bind_result($teacherExperiencepdfData);
    $stmt->fetch();
    $stmt->close();
    
    
    $conn->close();
    
    // Output PDF data with appropriate content headers
    header("Content-Type: application/pdf");
    echo $teacherExperiencepdfData;

    
}



?>