
<?php
session_start();    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection code (similar to the previous examples)
    $servername = "localhost"; // Replace with your server name or IP address
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $database = "emp_db"; // Replace with your database name
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // SQL query to retrieve user data based on the provided email
    $sql = "SELECT * FROM emp_details WHERE email = ?";
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("s", $email);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Check if a user with the provided email exists
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                
                // Verify the password
                if ($password == $row["password"]) {
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["name"] = $row["name"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["designation"] = $row["designation"];
                    $_SESSION["date_of_joining"] = $row["date_of_joining"];
                    
                    // Redirect to the dashboard
                    header("Location:dashboard.php");
                    exit();
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "User with the provided email not found.";
            }
            
            // Close the result set
            $result->close();
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
    header("Location: login.html"); // Redirect to the login form if accessed directly
    exit();
}
?>
