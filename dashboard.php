<?php
session_start(); // Start a session

if (empty($_SESSION["id"])) {
    header("Location: login.html"); // Redirect to the login form if not logged in
    exit();
}

// Display the dashboard with user information
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION["name"]; ?></h1>
    <p>Email: <?php echo $_SESSION["email"]; ?></p>
    <p>Designation: <?php echo $_SESSION["designation"]; ?></p>
    <p>Date of Joining: <?php echo $_SESSION["date_of_joining"]; ?></p>
    
    <!-- Add other dashboard content here -->


  
<a href="logout.php">Logout</a>

</body>
</html>
