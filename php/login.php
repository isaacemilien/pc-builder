<?php
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password1 = $_POST["password"];

    // Your database connection code goes here
    $servername = "localhost:3306"; // Change this to your database server hostname
    $username = "hc920_1"; // Change this to your database username
    $password = "PC_PARTS_BRIGHTON"; // Change this to your database password
    $dbname = "hc920_pc_parts"; // Change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $sql = "SELECT * FROM tblUsers WHERE Email='$email' AND Password='$password1'";

    $result = $conn->query($sql);

    // Check if query was successful
    if ($result) {
        // Check if user with given credentials exists
        if ($result->num_rows > 0) {

            // Get username from result 
            $row = $result->fetch_assoc();
            $username = $row['Username']; 

            // Set session variable
            $_SESSION['username'] = $username;

            // User exists, redirect to homepage
            header("Location: ../index.html"); 
            echo "<script>userLoggedIn();</script>";
            exit;
        } else {
            // User does not exist or credentials are incorrect
            echo "Invalid email or password";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>