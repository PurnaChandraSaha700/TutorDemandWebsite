<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Filter and Display</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .filter-container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #333;
        }
        .filter-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .filter-header h2 {
            color: #007bff;
            font-size: 36px;
            margin-bottom: 5px;
        }
        .filter-header p {
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
        .table-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #333;
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
<a href="adminHomePage.php" class="btn btn-secondary back-button">Back</a>
</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 filter-container">
                <div class="filter-header">
                    <h2>Student Filter and Display</h2>
                    <p>Use the filters below to refine your search.</p>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="filterOutput" class="form-label">Select Catagory:</label>
                        <select class="form-select" id="filterOutput" name="filterOutput">
                            <option value="all">All</option>
                            <option value="name">Name</option>
                            <option value="email">Email</option>
                            <option value="gender">Gender</option>
                            <option value="city">City</option>
                            <option value="zipcode">ZipCode</option>
                            <option value="varification">Varification</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inputData" class="form-label">Input:</label>
                        <input type="text" class="form-control" id="inputData" name="inputData">
                    </div>
                    <!-- Add more filter options here -->

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <div class="container">
        <h1 class="mb-4 text-light">Student Details</h1>
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Permanent Address</th>
                    <th>Current Address</th>
                    <th>City</th>
                    <th>Zip Code</th>
                    <th>Password</th>
                    <th>Post Count</th>
                    <th>Tutor Count</th>
                    <th>Varified Student</th>
                    <th>Student Bio</th>
                    <th>Profile Picture</th>
                    <!-- Add more column headers here -->
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', 'root', '', 'tutorquestdatabase');
                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                }
                $sql = "SELECT * FROM studentTable";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        
                    $selectedCatagory = $_POST['filterOutput'];
                    

                    if($selectedCatagory =='all'){
                        $sql = "SELECT * FROM studentTable";
                    }// name email gender ciy zipcode varification
                    if($selectedCatagory =="name"){
                        $inputData = $_POST['inputData'];
                        $sql = "SELECT * FROM studentTable WHERE CONCAT(studentFirstName, ' ', studentLastName) LIKE '%$inputData%'";
                    }
                    if($selectedCatagory == "email"){
                        $inputData = $_POST['inputData'];
                        $sql = "SELECT * FROM studentTable WHERE studentEmail = '$inputData'";
                    }
                    if($selectedCatagory =="gender"){
                        $inputData = $_POST['inputData'];
                        $sql = "SELECT * FROM studentTable WHERE studentGender = '$inputData'";
                    }
                    if($selectedCatagory =="city"){
                        $inputData = $_POST['inputData'];
                        $sql = "SELECT * FROM studentTable WHERE studentCity = '$inputData'";
                    }
                    if($selectedCatagory =="zipcode"){
                        $inputData = $_POST['inputData'];
                        $sql = "SELECT * FROM studentTable WHERE studentZipCode = '$inputData'";
                    }
                    if($selectedCatagory =="varification"){
                        $inputData = $_POST['inputData'];
                        $sql = "SELECT * FROM studentTable WHERE isVarifiedStudent = '$inputData'";
                    }


                }

                
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["studentId"] . "</td>";
                        echo "<td>" . $row["studentFirstName"] . " " . $row["studentLastName"] . "</td>";
                        echo "<td>" . $row["studentDOB"] . "</td>";
                        echo "<td>" . $row["studentGender"] . "</td>";
                        echo "<td>" . $row["studentEmail"] . "</td>";
                        echo "<td>" . $row["studentPhone"] . "</td>";
                        echo "<td>" . $row["studentPermanentAddress"] . "</td>";
                        echo "<td>" . $row["studentCurrentAddress"] . "</td>";
                        echo "<td>" . $row["studentCity"] . "</td>";
                        echo "<td>" . $row["studentZipCode"] . "</td>";
                        echo "<td>" . $row["studentPassword"] . "</td>";
                        echo "<td>" . $row["studentCountPost"] . "</td>";
                        echo "<td>" . $row["tutorCount"] . "</td>";
                        echo "<td>" . $row["isVarifiedStudent"] . "</td>";
                        echo "<td>" . $row["studentBio"] . "</td>";
                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row["studentProfilePicture"]) . "' alt='Profile Image' style='width: 50px; height: 50px; object-fit: cover; border-radius: 50%;'></td>";
                        // Add more columns here as needed
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='15'>No records found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
