<?php
$deleteMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentEmailToDelete = $_POST['studentEmailToDelete'];

    // Perform the deletion process here
    $conn = new mysqli('localhost', 'root', '', 'tutorquestdatabase');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Delete the student using the provided email
    $deleteQuery = "DELETE FROM studentTable WHERE studentEmail = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $studentEmailToDelete);

    if ($stmt->execute()) {
        header("Location: DeleteSuccessful.html");
    } else {
        
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f0f0;
            font-family: 'Arial', sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            width: 600px;
            padding: 30px;
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .delete-button {
            width:200px;
            background-color: #dc3545;
            border: none;
            padding: 12px 0;
            font-weight: bold;
            letter-spacing: 1px;
            transition: background-color 0.3s;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        .result-message {
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            color: #fff;
        }
        .result-success {
            background-color: #28a745;
        }
        .result-error {
            background-color: #dc3545;
        }
    </style>
</head>
<body style="background-image: url('img/page2.jpg');">
    <div class="container">
        <div class="card">
            <h1 class="card-title text-center">Delete Student</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="studentEmailToDelete" class="form-label">Enter Student Email to Delete:</label>
                    <input type="email" class="form-control" id="studentEmailToDelete" name="studentEmailToDelete" required>
                </div>
                <button type="submit" class="btn btn-danger btn-block delete-button">Delete Student</button>
            </form>

            <?php if ($deleteMessage !== '') : ?>
                <div class="result-message <?php echo $deleteMessage.includes('Error') ? 'result-error' : 'result-success'; ?>">
                    <?php echo $deleteMessage; ?>
                </div>
            <?php endif; ?>

            <div class="mt-3 text-center">
                <a href="adminHomePage.php" class="btn btn-secondary">Back to Admin Page</a>
            </div>
        </div>
    </div>
</body>
</html>
