<?php
session_start();

// Include the database connection file
include("db_connection.php");

// Check if the user is an instructor (you might want to use a different role check)
if ($_SESSION['role'] !== 'instructor') {
    // Redirect or display an error message if the user is not an instructor
    echo "You don't have permission to access this page.";
    exit;
}

// Get the instructor's ID
$instructor_id = $_SESSION["id"];

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'create_exam') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exam_title = $_POST['exam_title'];
            $sql = "INSERT INTO exams (instructor_id, exam_title) VALUES (?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $instructor_id, $exam_title);
            if ($stmt->execute()) {
                // Exam created successfully
            } else {
                echo "Error creating exam: " . $stmt->error;
            }
        }
        ?>
        <form method="POST">
            <label for="exam_title">Exam Title:</label>
            <input type="text" name="exam_title" id="exam_title" required>
            <button type="submit">Create Exam</button>
        </form>
        <?php
    } elseif ($action === 'grade_students') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $student_id = $_POST['student_id'];
            $grade = $_POST['grade'];
            $sql = "UPDATE students SET grade = ? WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $grade, $student_id);
            if ($stmt->execute()) {
                // Grade updated successfully
            } else {
                echo "Error updating grade: " . $stmt->error;
            }
        }
        ?>
        <form method="POST">
            <!-- Add form fields for selecting students and input for grades -->
            <!-- Example: <select name="student_id">...</select> -->
            <!-- Example: <input type="text" name="grade" id="grade"> -->
            <button type="submit">Grade Students</button>
        </form>
        <?php
    } elseif ($action === 'create_course') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_name = $_POST['course_name'];
            $sql = "INSERT INTO courses (instructor_id, course_name) VALUES (?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $instructor_id, $course_name);
            if ($stmt->execute()) {
                header("Location: instructor.php");
            } else {
                echo "Error creating course: " . $stmt->error;
            }
        }
        ?>
        <form method="POST">
            <label for "course_name">Course Name:</label>
            <input type="text" name="course_name" id="course_name" required>
            <button type="submit">Create Course</button>
        </form>
        <?php
    } elseif ($action === 'create_forum') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $forum_title = $_POST['forum_title'];
            $sql = "INSERT INTO forums (instructor_id, forum_title) VALUES (?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $instructor_id, $forum_title);
            if ($stmt->execute()) {
                header("Location: instructor.php");
            } else {
                echo "Error creating forum: " . $stmt->error;
            }
        }
        ?>
        <form method="POST">
            <label for="forum_title">Forum Title:</label>
            <input type="text" name="forum_title" id="forum_title" required>
            <button type="submit">Create Forum</button>
        </form>
        <?php
    } else {
        echo "Invalid action.";
    }
}
?>

