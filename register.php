<?php

// Include the database connection file
include("db_connection.php"); // Replace with your actual database connection file


// Define variables to store user input and error messages
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

$default_role = "student"; // Replace with your default role

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email address.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have at least 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password != $confirm_password) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check if there are no validation errors
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare a SELECT statement to check if the username is already taken
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = $username;

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    // Prepare an INSERT statement to add the user to the database
                    // $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";

                    if ($stmt = $mysqli->prepare($sql)) {
                        $stmt->bind_param("ssss", $param_username, $param_email, $param_password, $default_role);
                        $param_username = $username;
                        $param_email = $email;
                        // $param_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
                        $param_password = $password;
                        if ($stmt->execute()) {
                            // Registration successful, send a confirmation email
                            $to = $email;
                            $subject = "Welcome to Skillify";
                            $message = "Thank you for registering with Skillify. Your account has been created successfully.";
                            $headers = "From: bihefiy469@czilou.com"; // Replace with your email address

                            mail($to, $subject, $message, $headers);

                            // give a alert message
                            echo "<script>alert('Registration successful, please check your email to activate your account.');</script>";

                            // Redirect to a success page or login page
                            header("location: index.php");
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }

                    $stmt->close();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        $mysqli->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../Css/login.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../Css/index.css"> <!-- Link to your CSS file -->
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Skillify</a>
        </div>
    </nav>

    <div class="register-container">
        <h2>Register</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <span class="help-block"><?php echo $username_err; ?></span>
            <input type="email" name="email" placeholder="Email" required>
            <span class="help-block"><?php echo $email_err; ?></span>
            <input type="password" name="password" placeholder="Password" required>
            <span class="help-block"><?php echo $password_err; ?></span>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
