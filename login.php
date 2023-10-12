<?php
// Start a session
session_start();

// Check if the user is already logged in, redirect them to the home page
if(isset($_SESSION["username"])){
    header("Location: index.php");
    exit;
}

// Include the database connection file
include("db_connection.php"); // Replace with your actual database connection file

// Define variables to store user input
$username = $password = "";
$username_err = $password_err = "";

// roles
$student = "student";
$instructor = "instructor";
$qa = "qa";
$coordinator = "coordinator";
$admin = "admin";
$role = "";

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Check if there are no validation errors
    if(empty($username_err) && empty($password_err)){
        // Prepare a SELECT statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store the result
                $stmt->store_result();
                
                // Check if the username exists, if yes then verify the password
                if($stmt->num_rows == 1){                    
                    $stmt->bind_result($id, $username, $db_password);
                    if($stmt->fetch()){
                        if($password === $db_password){ // Compare plain text passwords
                            // Password is correct, start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;

                            // get role
                            $sql = "SELECT role FROM users WHERE username = '$username'";
                            $result = mysqli_query($mysqli, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $role = $row['role'];
                            $_SESSION["role"] = $role;
                            
                            //email
                            $sql = "SELECT email FROM users WHERE username = '$username'";
                            $result = mysqli_query($mysqli, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $email = $row['email'];
                            $_SESSION["email"] = $email;

                            // if role is student redirect to student page
                            if($role == $student){
                                // get student courses from courses table
                                $courses = array(); // Initialize an array to store courses
                                $instructors = array(); // Initialize an array to store instructors
                                $instructor_ids = array(); // Initialize an array to store instructor IDs
                                $sql = "SELECT course_name, instructor_id, student_id FROM courses WHERE student_id = '$id'";
                                $result = mysqli_query($mysqli, $sql);
                                $row = mysqli_fetch_assoc($result);
                                
                                // Loop over the results and store them in the arrays
                                while($row = mysqli_fetch_assoc($result)){
                                    array_push($courses, $row['course_name']);
                                    array_push($instructor_ids, $row['instructor_id']);
                                    echo $row['instructor_id'];
                                }

                                // Loop over the instructor IDs and get the instructor names
                                foreach($instructor_ids as $instructor_id){
                                    $sql = "SELECT username FROM users WHERE id = '$instructor_id'";
                                    $result = mysqli_query($mysqli, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    array_push($instructors, $row['username']);
                                }

                                // Store the arrays in session variables
                                $_SESSION["courses"] = $courses;
                                $_SESSION["instructors"] = $instructors;
                                header("location: student.php");
                            }
                            // if role is instructor redirect to instructor page
                            if($role == $instructor){
                                header("location: instructor.php");
                            }
                            // if role is qa redirect to qa page
                            if($role == $qa){
                                header("location: qa.php");
                            }
                            // if role is coordinator redirect to coordinator page
                            if($role == $coordinator){
                                header("location: coordinator.php");
                            }
                            // if role is admin redirect to admin page
                            if($role == $admin){
                                header("location: admin.php");
                            }
                            // if role is not set redirect to login page
                            if($role == ""){
                                header("location: login.php");
                            }
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered is not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Css/login.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../Css/index.css"> <!-- Link to your CSS file -->
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Skillify</a>
        </div>
    </nav>

    <div class="login-container">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <span class="help-block"><?php echo $username_err; ?></span>
            <input type="password" name="password" placeholder="Password" required>
            <span class="help-block"><?php echo $password_err; ?></span>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <p>Forgot Your Password? <a href="Forgot.php">Forgot Password</a></p>
    </div>
</body>
</html>
