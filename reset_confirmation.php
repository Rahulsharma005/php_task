<?php
session_start();

// Check if the user is already logged in, and if so, redirect to a welcome page or their profile
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Confirmation</title>
    <link rel="stylesheet" href="../Css/reset_confirmation.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="reset-confirmation-container">
        <h2>Password Reset Confirmation</h2>
        <?php
        // Check if a confirmation message is stored in the session
        if (isset($_SESSION['reset_confirmation_message'])) {
            echo '<p>' . $_SESSION['reset_confirmation_message'] . '</p>';
            // Clear the confirmation message from the session
            unset($_SESSION['reset_confirmation_message']);
        } else {
            // Display a default message if no confirmation message is found
            echo '<p>An email with instructions to reset your password has been sent to your email address.</p>';
            echo '<p>Please check your email and follow the provided instructions to reset your password.</p>';
            echo '<p>Didn\'t receive an email? <a href="forgot.php">Try again</a></p>';
        }
        ?>
    </div>
</body>
</html>
