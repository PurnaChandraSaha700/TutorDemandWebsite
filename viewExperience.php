<?php
// Check if the required parameter is provided
if (isset($_GET['id'])) {
    $teacherId = $_GET['id']; // Teacher ID

    // Create a connection to the database
    $conn = new mysqli('localhost', 'root', '', 'tutorquestdatabase');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetch the experience document data from the database
    $query = "SELECT teacherExperience FROM teacherTable WHERE teacherId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $teacherId);
    $stmt->execute();
    $stmt->bind_result($documentData);
    $stmt->fetch();
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Display the PDF document
    header("Content-type: application/pdf");
    echo $documentData;
} else {
    // Redirect to an error page or display an error message
    echo "Error: Missing parameter.";
}
?>
