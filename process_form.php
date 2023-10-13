<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    include("db_connection.php"); // Replace with your actual database connection file

    // Get user input
    $userName = $_POST["userName"];
    $userRole = $_POST["userRole"];

    // Generate user email and password
    $userMail = $userName . "@skillify.com";
    $password = $userName . "@" . $userRole;

    // Check if a user with the same name already exists
    $checkQuery = "SELECT * FROM users WHERE username = ?";
    
    if ($stmt = $conn->prepare($checkQuery)) {
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            echo "<script>alert('User already exists!');</script>";
        } else {
            // Insert the user into the database using a prepared statement
            $insertQuery = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
            
            if ($stmt = $conn->prepare($insertQuery)) {
                $stmt->bind_param("ssss", $userName, $userMail, $password, $userRole);
                
                if ($stmt->execute()) {
                    echo "<script>alert('User added successfully!');</script>";
                } else {
                    echo "<script>alert('Error: " . $stmt->error . "');</script>";
                }
            }
        }
        
        $stmt->close();
    }

    $conn->close();
}
?>