<?php
session_start(); // Start the session (if not already started)

// Check if the user is already logged in, and if so, redirect to a welcome page or their profile
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Include the database connection file
include("db_connection.php"); // Replace with your actual database connection file

// Define variables to store user input
$email = "";
$email_err = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the email address
    if (empty($_POST["email"])) {
        $email_err = "Please enter your email address.";
    } else {
        $email = $_POST["email"];
        // You can add further email validation here if needed
    }

    // If there are no validation errors, proceed to send the password reset email
    if (empty($email_err)) {
        // TODO: Generate a unique token for password reset
        $resetToken = uniqid();
        // Redirect to a confirmation page
        header("Location: reset_confirmation.php"); // Replace with the appropriate URL
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../Css/forgot.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <p>Enter your email address to receive a password reset link.</p>
        <form action="forget.php" method="POST"> <!-- Use the same script for form submission -->
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Reset Password</button>
        </form>
        <!-- Display email validation error if any -->
        <?php if (!empty($email_err)) : ?>
            <p class="error"><?php echo $email_err; ?></p>
        <?php endif; ?>
        <p>Remember your password? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
