<?php
session_start(); // Start the session

// Check if the user is logged in (user_id is set in the session)
if (isset($_SESSION["user_id"])) {
    // Unset all of the session variables
    session_unset();

    // Destroy the session
    session_destroy();
}

// Redirect to the login page or any other page as needed
header("Location: login_form.html"); // You can change this to your desired page
exit();
?>
