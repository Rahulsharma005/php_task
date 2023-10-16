<?php
// Include the database connection file
include("db_connection.php"); // Replace with your actual database connection file

// Define variables to store user input and error messages
$username = $password = $role = $email = $age = $address = $about = "";
$username_err = $password_err = $role_err = $email_err = $age_err = $address_err = $about_err = "";

// Define the allowed roles
$allowed_roles = array("student", "instructor", "qa", "coordinator");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have at least 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate role
    $role = $_POST["userRole"];
    if (!in_array($role, $allowed_roles)) {
        $role_err = "Invalid role selected.";
    }

    // Validate email
    if (empty(trim($_POST["email"])) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate age
    if (empty(trim($_POST["age"])) || !is_numeric($_POST["age"])) {
        $age_err = "Please enter a valid age.";
    } else {
        $age = trim($_POST["age"]);
    }

    // Validate address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter an address.";
    } else {
        $address = trim($_POST["address"]);
    }

    // Validate about
    if (empty(trim($_POST["about"]))) {
        $about_err = "Please provide some information about yourself.";
    } else {
        $about = trim($_POST["about"]);
    }

    // Check if there are no validation errors
    if (empty($username_err) && empty($password_err) && empty($role_err) && empty($email_err) && empty($age_err) && empty($address_err) && empty($about_err)) {
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
                    $sql = "INSERT INTO users (username, password, role, email) VALUES (?, ?, ?, ?)";

                    if ($stmt = $mysqli->prepare($sql)) {
                        $stmt->bind_param("ssss", $param_username, $param_password, $param_role, $param_email);
                        $param_username = $username;
                        // $param_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
                        $param_password = $password;
                        $param_role = $role;
                        $param_email = $email;

                        if ($stmt->execute()) {
                            // Inserted user into the 'users' table, now get the user ID
                            $user_id = $stmt->insert_id;

                            // Prepare an INSERT statement to add userdesc data
                            $sql = "INSERT INTO userdesc (user_id, age, address, about) VALUES (?, ?, ?, ?)";

                            if ($stmt = $mysqli->prepare($sql)) {
                                $stmt->bind_param("isss", $user_id, $param_age, $param_address, $param_about);
                                $param_age = $age;
                                $param_address = $address;
                                $param_about = $about;

                                if ($stmt->execute()) {
                                    // Registration successful, send a confirmation email
                                    $to = $email;
                                    $subject = "Welcome to Skillify";
                                    $message = "Thank you for registering with Skillify. Your account has been created successfully.";
                                    $headers = "From: your_email@example.com"; // Replace with your email address

                                    mail($to, $subject, $message, $headers);

                                    // Give an alert message
                                    echo "<script>alert('Registration successful, please check your email to activate your account.');</script>";

                                    // Redirect to a success page or login page
                                    header("location: index.php");
                                } else {
                                    echo "Oops! Something went wrong. Please try again later.";
                                }
                            }
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }
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
    <link rel="stylesheet" href="../Css/register.css"> <!-- Link to your CSS file -->
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
            <input type="password" name="password" placeholder="Password" required>
            <span class="help-block"><?php echo $password_err; ?></span>
            <div>
                <label for="userRole">Role:</label>
                <select id="userRole" name="userRole">
                    <option value="student">Student</option>
                    <option value="instructor">Instructor</option>
                    <option value="qa">Quality Assurance Officer</option>
                    <option value="coordinator">Program Coordinator</option>
                </select>
                <span class="help-block"><?php echo $role_err; ?></span>
            </div>
            <input type="email" name="email" placeholder="Email" required>
            <span class="help-block"><?php echo $email_err; ?></span>
            <input type="number" name="age" placeholder="Age" required>
            <span class="help-block"><?php echo $age_err; ?></span>
            <input type="text" name="address" placeholder="Address" required>
            <span class="help-block"><?php echo $address_err; ?></span>
            <textarea name="about" placeholder="Tell us about yourself" required></textarea>
            <span class="help-block"><?php echo $about_err; ?></span>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
