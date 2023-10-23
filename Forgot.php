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
        $email_err = preg_match('/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/', $email) ? "" : "Invalid email address.";
        // Check if the email address exists in the database
        if (empty($email_err)) {
            $sql = "SELECT id FROM users WHERE email = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                $email_err = "No account found with that email address.";
            }
        }

        // from
        $from = "admin@skilify.com";
        // send email
        $to = $email;
        $subject = "Reset Password";
        $message = "Click the link to reset your password: http://localhost:8080/Php/forget.php";
        $headers = "From: Skillify";
        
        // send email
        mail($to, $subject, $message, $headers);
        
        // show in console
        echo "<script>console.log($email_err)</script>";
    }

    // If there are no validation errors, proceed to send the password reset email
    if (empty($email_err)) {
        $resetToken = uniqid();
        // show in console
        echo "<script>console.log($resetToken)</script>";

        // wait for 5 seconds
        sleep(5);
        // Redirect to a confirmation page
        header("Location: reset_confirmation.php?resetToken=$resetToken");
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
        <!-- <form action="reset_confirmation.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Reset Password</button>
        </form> -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
