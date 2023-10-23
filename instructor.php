<?php
session_start();

// Include the database connection file
include("db_connection.php");

// get current user id
$instructor_id = $_SESSION["id"];

// get all students names
$sql = "SELECT * FROM users WHERE role = 'student'";
$result = $mysqli->query($sql);
$row = mysqli_fetch_array($result);
$student_names = array();
while ($row = mysqli_fetch_array($result)) {
    $student_names[] = $row['username'];
}

// get all feedbacks for the current instructor
$sql = "SELECT feedback_text FROM feedback WHERE instructor_id = '$instructor_id'";
$result = $mysqli->query($sql);
$row = mysqli_fetch_array($result);
$feedbacks = array();
while ($row = mysqli_fetch_array($result)) {
    $feedbacks[] = $row['feedback_text'];
}

// get student name and feedback text
$sql = "SELECT users.username, feedback.feedback_text FROM users INNER JOIN feedback ON users.id = feedback.student_id";
$result = $mysqli->query($sql);
$row = mysqli_fetch_array($result);
$student_feedbacks = array();
while ($row = mysqli_fetch_array($result)) {
    $student_feedbacks[] = array($row['username'], $row['feedback_text']);
}

// feedback form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // aleart
    echo "<script>alert('Feedback added successfully!')</script>";
    // get student name and feedback text
    $student_name = $_POST["student-name-input"];
    $feedback_text = $_POST["feedback-input"];

    // get student id
    $sql = "SELECT id FROM users WHERE username = '$student_name'";
    $result = $mysqli->query($sql);
    $row = mysqli_fetch_array($result);
    if ($row) {
        $student_id = $row['id'];
        // Insert feedback into the database
        $sql = "INSERT INTO feedback (student_id, instructor_id, feedback_text) VALUES ('$student_id', '$instructor_id', '$feedback_text')";
        $mysqli->query($sql);
        // Refresh page or redirect as needed
        header("Refresh:0");
    } else {
        echo "Student not found in the database.";
    }
}


// get all courses assigned to the current instructor
$sql = "SELECT course_name, report FROM courses WHERE instructor_id = '$instructor_id'";
$result = $mysqli->query($sql);
$row = mysqli_fetch_array($result);
$courses = array();
while ($row = mysqli_fetch_array($result)) {
    $courses[] = array($row['course_name'], $row['report']);
}

// course form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // aleart
    echo "<script>alert('Course added successfully!')</script>";
    // get course name and course description
    $course_name = $_POST["course-name-input"];
    $course_description = $_POST["course-desc-input"];
    $student_deafult_id = 5;
    $sql = "INSERT INTO courses (course_name, report, instructor_id, student_id) VALUES ('$course_name', '$course_description', '$instructor_id', '$student_deafult_id')";
    $mysqli->query($sql);

    // refresh page
    header("Refresh:0");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Page</title>
    <link rel="stylesheet" href="../Css/instructor.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../Css/index.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../Css/Home.css"> <!-- Link to your CSS file -->
</head>

<body>

    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Skillify</a>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu">
                <li><a href="Studentlist.php">Students</a></li>
                <li><a href="Files.php">Files</a></li>
                <li><a href="Chats.php">Chat</a></li>
                <li><a href="Appointments.php">Appointments</a></li>
                <li><a href="userInfo.php?username=<?php echo $_SESSION['username']; ?>">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <section class="student-info-section">
        <h2>Instructor Information</h2>
        <div class="student-info">
            <!-- <p><strong>Name:</strong> [Student Name]</p> -->
            <p><strong>Name:</strong>
                <?php echo htmlspecialchars($_SESSION["username"]); ?>
            </p>
            <!-- <p><strong>Email:</strong> [Student Email]</p> -->
            <p><strong>Email:</strong>
                <?php echo htmlspecialchars($_SESSION["email"]); ?>
            </p>
            <!-- <p><strong>Student ID:</strong> [Student ID]</p> -->
            <p><strong>Instructor ID:</strong>
                <?php echo htmlspecialchars($_SESSION["id"]); ?>
            </p>
            <!-- Add more student information here -->
        </div>
    </section>

    <section class="student-feedback">
        <div>
            <ul>
                <button><a href="CGCC.php?action=create_exam">Create Exam</a></button>
                <button><a href="CGCC.php?action=grade_students">Grade Students</a></button>
                <button><a href="CGCC.php?action=create_course">Create Course</a></button>
                <button><a href="CGCC.php?action=create_forum">Create Forum</a></button>

            </ul>
        </div>
        <br>
        <h2>Student Feedback</h2>
        <form id="feedback-form" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST">
            <label for="student-name-input">Student Name:</label>
            <select id="student-name-input" name="student-name-input">
                <?php
                foreach ($student_names as $student_name) {
                    echo "<option value='$student_name'>$student_name</option>";
                }
                ?>
            </select>

            <label for="feedback-input">Feedback:</label>
            <textarea id="feedback-input" name="feedback-input" required></textarea>

            <button type="submit">Add Feedback</button>
        </form>

        <?php
        if (count($student_feedbacks) > 0) {
            echo "<table id='feedback-table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Student Name</th>";
            echo "<th>Feedback</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($student_feedbacks as $student_feedback) {
                echo "<tr>";
                echo "<td>" . $student_feedback[0] . "</td>";
                echo "<td>" . $student_feedback[1] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No feedbacks found.</p>";
        }
        ?>
    </section>
    <!-- ... (previous HTML code) ... -->

    <section class="course-management">
        <h2>Course Management</h2>
        <form id="course-form" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST">
            <label for="course-name-input">Course Name:</label>
            <input type="text" id="course-name-input" name="course-name-input" required>

            <label for="course-desc-input">Course Description:</label>
            <input type="text" id="course-desc-input" name="course-desc-input" required>

            <button type="submit">Add Course</button>
        </form>

        <!-- <table id="course-table">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Course Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Python</td>
                <td>From Basics</td>
            </tr>
            <tr>
                <td>Python</td>
                <td>From Basics</td>
            </tr>
            <tr>
                <td>Python</td>
                <td>From Basics</td>
            </tr>
        </tbody>
    </table> -->
        <?php
        if (count($courses) > 0) {
            echo "<table id='course-table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Course Name</th>";
            echo "<th>Course Description</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($courses as $course) {
                echo "<tr>";
                echo "<td>" . $course[0] . "</td>";
                echo "<td>" . $course[1] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No courses found.</p>";
        }
        ?>
    </section>

    <section class="student-progress">
        <h2>Student Progress Tracking</h2>
        <form id="progress-form" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST">
            <label for="student-name-input">Student Name:</label>
            <input type="text" id="student-name-input" name="student-name-input" required>

            <label for="progress-input">Progress:</label>
            <input type="text" id="progress-input" name="progress-input" required>

            <button type="submit">Add Progress</button>
        </form>

        <?php
        if (count($student_feedbacks) > 0) {
            echo "<table id='progress-table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Student Name</th>";
            echo "<th>Progress</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($student_feedbacks as $student_feedback) {
                echo "<tr>";
                echo "<td>" . $student_feedback[0] . "</td>";
                echo "<td>" . $student_feedback[1] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No progress found.</p>";
        }
        ?>
    </section>

    <footer>
        <div class="container-footer">
            <p>&copy; 2023 Skillify. All rights reserved.</p>
            <div class="social-media-icons">
                <a href="https://www.facebook.com/yourcompany" target="_blank"><img width="20" height="20"
                        src="../icon/facebook.png" alt="Facebook"></a>
                <a href="https://www.twitter.com/yourcompany" target="_blank"><img width="20" height="20"
                        src="../icon/twitter.png" alt="Twitter"></a>
                <a href="https://www.linkedin.com/company/yourcompany" target="_blank"><img width="20" height="20"
                        src="../icon/instagram.png" alt="instagram"></a>
            </div>
        </div>
    </footer>

    <!-- ... (rest of the code) ... -->


    <!-- <script src="../js/ins.js"></script> Link to your JavaScript file -->
</body>

</html>