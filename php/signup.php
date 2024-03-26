<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $userPassword = $_POST["password"];

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

    // Prepare SQL statement with prepared statement
    $sql = "INSERT INTO tblUsers (Username, Email, Password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if prepare() succeeded
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute statement
    $result = $stmt->bind_param("sss", $fullName, $email, $userPassword);

    // Check if bind_param() succeeded
    if (!$result) {
        die("Binding parameters failed: " . $stmt->error);
    }
    // Execute SQL query
    if ($stmt->execute()) {
        // User registration successful, redirect to login page
        header("Location: ../login.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>