<?php
session_start();
// Include the database connection file
include("db_connection.php");

// Get student's ID from url parameter
if (isset($_GET['studentName'])) {
    $studentName = $_GET['studentName'];
    $sql = "SELECT * FROM users WHERE username = '$studentName'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $student_id = $row['id'];
} else {
    header("Location: index.php");
    exit;
}

// Check if a student with the provided ID exists
if ($result->num_rows === 1) {
    $student_data = $result->fetch_assoc();
} else {
    header("Location: index.php");
    exit;
}

// Fetch the student's courses from the database
$coursesSql = "SELECT course_name, instructor_id FROM courses WHERE student_id = $student_id";
$coursesResult = $mysqli->query($coursesSql);
$studentCourses = $coursesResult->fetch_all(MYSQLI_ASSOC);
$courses = [];
foreach ($studentCourses as $course) {
    $instructorId = $course['instructor_id'];
    $instructorSql = "SELECT username FROM users WHERE id = $instructorId";
    $instructorResult = $mysqli->query($instructorSql);
    $instructor = $instructorResult->fetch_assoc();
    $course['instructor_name'] = $instructor['username'];
    $courses[] = $course;
}

// get marks and attendance for each course from the database
// Fetch the student's courses from the database
$coursesSql = "SELECT course_id, course_name, instructor_id FROM courses WHERE student_id = $student_id";
$coursesResult = $mysqli->query($coursesSql);
$studentCourses = $coursesResult->fetch_all(MYSQLI_ASSOC);
$courses = [];

// Iterate through the student's courses
foreach ($studentCourses as $course) {
    $instructorId = $course['instructor_id'];
    $courseId = $course['course_id'];

    // Fetch instructor's username
    $instructorSql = "SELECT username FROM users WHERE id = $instructorId";
    $instructorResult = $mysqli->query($instructorSql);
    $instructor = $instructorResult->fetch_assoc();
    $course['instructor_name'] = $instructor['username'];

    // Fetch marks for this course
    $marksSql = "SELECT marks, totalmarks, title FROM exam WHERE student_id = $student_id AND course_id = $courseId";
    $marksResult = $mysqli->query($marksSql);
    $marksData = $marksResult->fetch_all(MYSQLI_ASSOC);
    $course['marks'] = $marksData;

    // Fetch attendance data for this course
    $attendanceSql = "SELECT Attendance FROM report WHERE student_id = $student_id AND course_id = $courseId";
    $attendanceResult = $mysqli->query($attendanceSql);
    $attendanceData = $attendanceResult->fetch_all(MYSQLI_ASSOC);
    $course['attendance'] = $attendanceData;

    $courses[] = $course;
}

// Close the database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Analytics</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Course Analytics</h1>
    <h2>Student: <?php echo $studentName; ?></h2>
    <!-- Add a canvas element to display the chart -->
    <canvas id="myChart"></canvas>
    <script>
        // Get the canvas element
        var ctx = document.getElementById('myChart').getContext('2d');

        // Get the data from PHP
        var courseName = <?php echo json_encode(array_column($courses, 'course_name')); ?>;
        var marks = <?php echo json_encode(array_column($courses, 'marks')); ?>;
        var attendance = <?php echo json_encode(array_column($courses, 'attendance')); ?>;

        // Create the chart
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: courseName,
                datasets: [{
                    label: 'Marks',
                    data: marks,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Attendance',
                    data: attendance,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
    </script>
</body>
</html>