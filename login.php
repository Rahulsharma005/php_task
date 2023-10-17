<?php
// Start a session
session_start();

// Check if the user is already logged in, redirect them to the home page
if (isset($_SESSION["username"])) {
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check if there are no validation errors
    if (empty($username_err) && empty($password_err)) {
        // Prepare a SELECT statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store the result
                $stmt->store_result();

                // Check if the username exists, if yes then verify the password
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $db_password);
                    if ($stmt->fetch()) {
                        if ($password === $db_password) { // Compare plain text passwords
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
                            if ($role == $student) {
                                // Initialize arrays to store data
                                $courses = array();
                                $instructors = array();
                                $instructor_ids = array();

                                // Query to get student courses
                                $sql = "SELECT course_name, instructor_id, student_id FROM courses WHERE student_id = '$id'";
                                $result = mysqli_query($mysqli, $sql);

                                // Loop over the results and store them in the arrays
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo $row['course_name'];
                                    array_push($courses, $row['course_name']);
                                    array_push($instructor_ids, $row['instructor_id']);
                                }

                                // Loop over the instructor IDs and get the instructor names
                                foreach ($instructor_ids as $instructor_id) {
                                    $sql = "SELECT username FROM users WHERE id = '$instructor_id'";
                                    $result = mysqli_query($mysqli, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    array_push($instructors, $row['username']);
                                }

                                // Store the arrays in session variables
                                $_SESSION["courses"] = $courses;
                                $_SESSION["instructors"] = $instructors;


                                // Initialize arrays to store data
                                $exams = array();
                                $startDates = array();
                                $marks = array();
                                $totalmarks = array();
                                $titles = array();
                                $examdone = array();
                                $course_ids = array();

                                // Query to get student exams
                                $sql = "SELECT exam_id, date, marks, totalmarks, title, examdone, course_id FROM exam WHERE student_id = '$id'";
                                $result = mysqli_query($mysqli, $sql);

                                // Loop over the results and store them in the arrays
                                while ($row = mysqli_fetch_assoc($result)) {
                                    array_push($exams, $row['exam_id']);
                                    array_push($startDates, $row['date']);
                                    array_push($marks, $row['marks']);
                                    array_push($totalmarks, $row['totalmarks']);
                                    array_push($titles, $row['title']);
                                    array_push($examdone, $row['examdone']);
                                    array_push($course_ids, $row['course_id']);
                                }

                                // Store the arrays in session variables
                                $_SESSION["exams"] = $exams;
                                $_SESSION["startDates"] = $startDates;
                                $_SESSION["marks"] = $marks;
                                $_SESSION["totalmarks"] = $totalmarks;
                                $_SESSION["titles"] = $titles;
                                $_SESSION["examdone"] = $examdone;
                                $_SESSION["course_ids"] = $course_ids;

                                // get student report query

                                // Initialize arrays to store data
                                $reports = array();
                                $attendance = array();

                                // Query to get student reports
                                $sql = "SELECT report_id, Attendance FROM report WHERE student_id = '$id'";
                                $result = mysqli_query($mysqli, $sql);

                                // Loop over the results and store them in the arrays
                                while ($row = mysqli_fetch_assoc($result)) {
                                    array_push($reports, $row['report_id']);
                                    array_push($attendance, $row['Attendance']);
                                }

                                // Store the arrays in session variables
                                $_SESSION["reports"] = $reports;
                                $_SESSION["attendance"] = $attendance;

                                // Initialize an array to store exam marks
                                $examMarks = array();

                                // Step 1: Query to get exam IDs from the "report" table for the logged-in student
                                $sql = "SELECT exam_id FROM report WHERE student_id = '$id'";
                                $result = mysqli_query($mysqli, $sql);

                                // Step 2: Loop over the exam IDs and query the "exam" table to get marks
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $examId = $row['exam_id'];
                                    $marksQuery = "SELECT marks FROM exam WHERE exam_id = '$examId'";
                                    $marksResult = mysqli_query($mysqli, $marksQuery);

                                    if (mysqli_num_rows($marksResult) > 0) {
                                        $marksRow = mysqli_fetch_assoc($marksResult);
                                        array_push($examMarks, $marksRow['marks']);
                                    }
                                }

                                // Store the array in a session variable
                                $_SESSION["examMarks"] = $examMarks;
                                // attendance
                                $sql = "SELECT Attendance FROM report WHERE student_id = '$id'";
                                $result = mysqli_query($mysqli, $sql);

                                // Loop over the results and store them in the arrays
                                while ($row = mysqli_fetch_assoc($result)) {
                                    array_push($attendance, $row['Attendance']);
                                }

                                // Store the arrays in session variables
                                $_SESSION["attendance"] = $attendance;

                                // Redirect to the student.php page
                                header("location: student.php");
                            }
                            // if role is instructor redirect to instructor page
                            if ($role == $instructor) {
                                header("location: instructor.php");
                            }
                            // if role is qa redirect to qa page
                            if ($role == $qa) {
                                // Initialize arrays to store data
                                // Instructor Name
                                // Course
                                // Student Name

                                $instructorName = array();
                                $course = array();
                                $studentName = array();
                                $instructor_ids = array();
                                $student_ids = array();

                                // get all courses
                                $sql = "SELECT course_name, instructor_id, student_id FROM courses";
                                $result = mysqli_query($mysqli, $sql);

                                // Loop over the results and store them in the arrays
                                while ($row = mysqli_fetch_assoc($result)) {
                                    array_push($course, $row['course_name']);
                                    array_push($instructor_ids, $row['instructor_id']);
                                    array_push($student_ids, $row['student_id']);
                                }

                                // Loop over the instructor IDs and get the instructor names
                                foreach ($instructor_ids as $instructor_id) {
                                    $sql = "SELECT username FROM users WHERE id = '$instructor_id'";
                                    $result = mysqli_query($mysqli, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    array_push($instructorName, $row['username']);
                                }

                                // Loop over the student IDs and get the student names
                                foreach ($student_ids as $student_id) {
                                    $sql = "SELECT username FROM users WHERE id = '$student_id'";
                                    $result = mysqli_query($mysqli, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    array_push($studentName, $row['username']);
                                }

                                // Store the arrays in session variables
                                $_SESSION["instructorName"] = $instructorName;
                                $_SESSION["course"] = $course;
                                $_SESSION["studentName"] = $studentName;

                                header("location: qa.php");
                            }
                            // if role is coordinator redirect to coordinator page
                            if ($role == $coordinator) {
                                $students = array();
                                $courseName = array();
                                $reports = array();
                                $attendance = array();
                                $marks = array();
                                $totalmarks = array();
                                $course_ids = array();
                                $examIds = array();
                                $reportIds = array();

                                // get all students
                                $sql = "SELECT username, id FROM users WHERE role = 'student'";
                                $result = mysqli_query($mysqli, $sql);

                                // Loop over the results and store them in the arrays
                                while ($row = mysqli_fetch_assoc($result)) {
                                    array_push($students, $row['username']);
                                }

                                // get courses, reports, and exam IDs for each student
                                foreach ($students as $student) {
                                    $sql = "SELECT course_name, course_id FROM courses WHERE student_id = (SELECT id FROM users WHERE username = '$student')";
                                    $result = mysqli_query($mysqli, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    array_push($courseName, $row['course_name']);
                                    array_push($course_ids, $row['course_id']);

                                    $sql = "SELECT report_id, Attendance, exam_id FROM report WHERE student_id = (SELECT id FROM users WHERE username = '$student')";
                                    $result = mysqli_query($mysqli, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    array_push($reports, $row['report_id']);
                                    array_push($attendance, $row['Attendance']);
                                    array_push($examIds, $row['exam_id']);
                                }

                                // Calculate and store the percentage for each student
                                $percentage = array();
                                for ($i = 0; $i < count($reports); $i++) {
                                    $sql = "SELECT marks, totalmarks FROM exam WHERE exam_id = '$examIds[$i]'";
                                    $result = mysqli_query($mysqli, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    array_push($marks, $row['marks']);
                                    array_push($totalmarks, $row['totalmarks']);
                                    array_push($percentage, round(($marks[$i] / $totalmarks[$i]) * 100, 2));
                                }


                                // Store the arrays in session variables
                                $_SESSION["students"] = $students;
                                $_SESSION["courseName"] = $courseName;
                                $_SESSION["attendance"] = $attendance;
                                $_SESSION["percentage"] = $percentage;
                                header("location: programCordinator.php");
                            }
                            // if role is admin redirect to admin page
                            if ($role == $admin) {
                                // Initialize arrays to store data
                                $studentName = array();
                                $instructorName = array();
                                $QAName = array();
                                $coordinatorName = array();
                                $student_ids = array();
                                $instructor_ids = array();
                                $QA_ids = array();
                                $coordinator_ids = array();

                                // get all students
                                $sql = "SELECT username, id FROM users WHERE role = 'student'";
                                $result = mysqli_query($mysqli, $sql);

                                // Loop over the results and store them in the arrays
                                while ($row = mysqli_fetch_assoc($result)) {
                                    array_push($studentName, $row['username']);
                                    array_push($student_ids, $row['id']);
                                }

                                // get all instructors
                                $sql = "SELECT username, id FROM users WHERE role = 'instructor'";
                                $result = mysqli_query($mysqli, $sql);

                                // Loop over the results and store them in the arrays
                                while ($row = mysqli_fetch_assoc($result)) {
                                    array_push($instructorName, $row['username']);
                                    array_push($instructor_ids, $row['id']);
                                }

                                // get all QAs
                                $sql = "SELECT username, id FROM users WHERE role = 'qa'";
                                $result = mysqli_query($mysqli, $sql);

                                // Loop over the results and store them in the arrays
                                while ($row = mysqli_fetch_assoc($result)) {
                                    array_push($QAName, $row['username']);
                                    array_push($QA_ids, $row['id']);
                                }

                                // get all coordinators
                                $sql = "SELECT username, id FROM users WHERE role = 'coordinator'";
                                $result = mysqli_query($mysqli, $sql);

                                // Loop over the results and store them in the arrays
                                while ($row = mysqli_fetch_assoc($result)) {
                                    array_push($coordinatorName, $row['username']);
                                    array_push($coordinator_ids, $row['id']);
                                }

                                // Initialize arrays to store user data
                                $studentdata = array();
                                $instructordata = array();
                                $qadata = array();
                                $coordinatordata = array();

                                // Get additional data for students from userdesc using student IDs
                                foreach ($student_ids as $student_id) {
                                    $sql = "SELECT about FROM userdesc WHERE user_id = ?";
                                    $stmt = $mysqli->prepare($sql);
                                    $stmt->bind_param("i", $student_id);
                                    $stmt->execute();
                                    $stmt->bind_result($about);
                                    $stmt->fetch();
                                    $studentdata[] = $about;
                                    $stmt->close();
                                }

                                // Get additional data for instructors from userdesc using instructor IDs
                                foreach ($instructor_ids as $instructor_id) {
                                    $sql = "SELECT about FROM userdesc WHERE user_id = ?";
                                    $stmt = $mysqli->prepare($sql);
                                    $stmt->bind_param("i", $instructor_id);
                                    $stmt->execute();
                                    $stmt->bind_result($about);
                                    $stmt->fetch();
                                    $instructordata[] = $about;
                                    $stmt->close();
                                }

                                // Get additional data for QA officers from userdesc using QA officer IDs
                                foreach ($QA_ids as $QA_id) {
                                    $sql = "SELECT about FROM userdesc WHERE user_id = ?";
                                    $stmt = $mysqli->prepare($sql);
                                    $stmt->bind_param("i", $QA_id);
                                    $stmt->execute();
                                    $stmt->bind_result($about);
                                    $stmt->fetch();
                                    $qadata[] = $about;
                                    $stmt->close();
                                }

                                // Get additional data for coordinators from userdesc using coordinator IDs
                                foreach ($coordinator_ids as $coordinator_id) {
                                    $sql = "SELECT about FROM userdesc WHERE user_id = ?";
                                    $stmt = $mysqli->prepare($sql);
                                    $stmt->bind_param("i", $coordinator_id);
                                    $stmt->execute();
                                    $stmt->bind_result($about);
                                    $stmt->fetch();
                                    $coordinatordata[] = $about;
                                    $stmt->close();
                                }


                                // Store the arrays in session variables
                                $_SESSION["studentName"] = $studentName;
                                $_SESSION["instructorName"] = $instructorName;
                                $_SESSION["QAName"] = $QAName;
                                $_SESSION["coordinatorName"] = $coordinatorName;
                                $_SESSION["studentdata"] = $studentdata;
                                $_SESSION["instructordata"] = $instructordata;
                                $_SESSION["qadata"] = $qadata;
                                $_SESSION["coordinatordata"] = $coordinatordata;


                                header("location: admin.php");
                            }
                            // if role is not set redirect to login page
                            if ($role == "") {
                                header("location: login.php");
                            }
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered is not valid.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
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
            <span class="help-block">
                <?php echo $username_err; ?>
            </span>
            <input type="password" name="password" placeholder="Password" required>
            <span class="help-block">
                <?php echo $password_err; ?>
            </span>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <p>Forgot Your Password? <a href="Forgot.php">Forgot Password</a></p>
    </div>
</body>

</html>