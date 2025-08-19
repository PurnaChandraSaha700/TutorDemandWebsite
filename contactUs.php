<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Contact Us - Tutor Demand Website</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #343a40;
    }
    .form-control {
      border-color: #ced4da;
    }
    .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
  </style>
</head>
<body style="background-image: url('img/page2.jpg');">
  <div class="container mt-5">
                  <div class="back-button">
                    <a href="homePage.html" class="btn btn-secondary back-button">Back</a>
                  </div>
    <h1>Contact Us</h1>
    <p>We'd love to hear from you. Please fill out the form below.</p>
    
    <form action="contact.php" method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Your Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
      </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>
