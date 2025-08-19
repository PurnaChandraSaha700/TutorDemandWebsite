<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Demand Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .table {
            margin-top: 20px;
        }
        .teacher-profile {
            display: flex;
            align-items: center;
        }
        .profile-picture img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 20px;
        }
        .profile-details {
            flex-grow: 1;
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
        <h1 class ="text-light">Teacher Profiles</h1>
        
        <form class="mb-4" method="get" action="">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search by Name">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Teacher</th>    
                    <th>City</th>
                    <th>Zip Code</th>
                    <th>Subjects</th>
                    <th>View Profile</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn = new mysqli('localhost', 'root', '', 'tutorquestdatabase');
                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }

                    if (isset($_GET['search'])) {
                        $search = $_GET['search'];
                        $query = "SELECT * FROM teacherTable WHERE (CONCAT(teacherFirstName, ' ', teacherLastName) LIKE '%$search%' or teacherEmail like '%$search%' )";
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>';
                                echo '<div class="teacher-profile">';
                                echo '<div class="profile-picture">';
                                
                                if (isset($row['teacherProfilePicture'])) {
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['teacherProfilePicture']) . '" alt="Teacher Profile Picture">';
                                } else {
                                    echo '<img src="../img/defaultDP.jpg" alt="Default Profile Picture">';
                                }
                                
                                echo '</div>';
                                echo '<div class="profile-details">';
                                echo '<h3>' . $row['teacherFirstName'] . ' ' . $row['teacherLastName'] . '</h3>';
                                echo '<p>' . $row['teacherBio'] . '</p>';
                                echo '<p><strong>Email:</strong> ' . $row['teacherEmail'] . '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '</td>';
                                echo '<td>' . $row['teacherCity'] . '</td>';
                                echo '<td>' . $row['teacherZipcode'] . '</td>';
                                echo '<td>' . $row['teacherSubjectExpert'] . '</td>';
                                echo '<td><a class="btn btn-primary" href="publicViewTeacherProfile.php?teacherId=' . $row['teacherId'] . '" target="_blank">View Profile</a></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No teachers found.</td></tr>';
                        }
                    }

                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>