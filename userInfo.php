<?php
// Include the database connection file
include("db_connection.php");

// get user data from username
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $user = $row;
} else {
    header("Location: index.php");
    exit;
}

// if it is a student, get courses
if ($user['role'] == "student") {
    // Fetch the student's courses from the database
    $studentId = $user['id'];
    $coursesSql = "SELECT course_name, instructor_id FROM courses WHERE student_id = $studentId";
    $coursesResult = $mysqli->query($coursesSql);
    $studentCourses = $coursesResult->fetch_all(MYSQLI_ASSOC);
    $courses = [];
    
    // Fetch the instructor's name from the database
    foreach ($studentCourses as $course) {
        $instructorId = $course['instructor_id'];
        $instructorSql = "SELECT username FROM users WHERE id = $instructorId";
        $instructorResult = $mysqli->query($instructorSql);
        $instructor = $instructorResult->fetch_assoc();
        $course['instructor_name'] = $instructor['username'];
        $courses[] = $course;
    }
    $_SESSION["course"] = array_column($courses, 'course_name');
    $_SESSION["instructorName"] = array_column($courses, 'instructor_name');
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php htmlspecialchars($user["username"]); ?> Profile</title>
    <link rel="stylesheet" href="../Css/student.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../Css/index.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../Css/Home.css"> <!-- Link to your CSS file -->
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Skillify</a>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <section class="student-info-section">
        <h2><?php echo htmlspecialchars($user["username"]); ?> Profile</h2>
        <div class="student-info">
            <!-- <p><strong>Name:</strong> [Student Name]</p> -->
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user["username"]); ?></p>
            <!-- <p><strong>Email:</strong> [Student Email]</p> -->
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user["email"]); ?></p>
            <!-- <p><strong>Student ID:</strong> [Student ID]</p> -->
            <p><strong>ID:</strong> <?php echo htmlspecialchars($user["id"]); ?></p>
            <!-- Add more student information here -->
        </div>
    </section>


    <!-- if user is a student -->
    <?php if ($user['role'] == "student"): ?>
        <section class="courses-section">
            <?php
            echo "<h2>Your Courses</h2>";
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Course Name</th>";
            echo "<th>Instructor</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            for ($i = 0; $i < count($_SESSION["course"]); $i++) {
                echo "<tr>";
                echo "<td>" . $_SESSION["course"][$i] . "</td>";
                echo "<td>" . $_SESSION["instructorName"][$i] . "</td>";
                echo "<td><a href='stuAnalytics.php'>View Analytics</a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            ?>
        </section>
    <?php endif ?>

    <footer>
        <div class="container-footer">
            <p>&copy; 2023 Skillify. All rights reserved.</p>
            <div class="social-media-icons">
                <a href="https://www.facebook.com/skilfy" target="_blank"><img width="20" height="20" src="../icon/facebook.png" alt="Facebook"></a>
                <a href="https://www.twitter.com/skilfy" target="_blank"><img width="20" height="20" src="../icon/twitter.png" alt="Twitter"></a>
                <a href="https://www.linkedin.com/company/skilfy" target="_blank"><img width="20" height="20" src="../icon/instagram.png" alt="instagram"></a>
            </div>
        </div>
    </footer>

</body>
</html>
