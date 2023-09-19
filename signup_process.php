<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection code (similar to the previous example)
    $servername = "localhost"; // Replace with your server name or IP address
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $database = "emp_db"; // Replace with your database name
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input from the form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"] ;
    $designation = $_POST["designation"];
    $date_of_joining = date("Y-m-d");
    
    // SQL query to insert data into the "login_db" table
    $sql = "INSERT INTO emp_details (name, email, password, designation, date_of_joining) VALUES (?, ?, ?, ?, ?)";
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sssss", $name, $email, $password, $designation, $date_of_joining);
        
        // Execute the statement
        if ($stmt->execute()) {
            header("Location: success.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
} else {
    header("Location: signup.html"); // Redirect to the sign-up form if accessed directly
    exit();
}
?>
