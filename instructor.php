<?php
session_start();
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
                <li><a href="student.php">Student</a></li>
                <li><a href="instructor.php">Instructor</a></li>
                <li><a href="QA.php">QA officer</a></li>
                <li><a href="p.php">Co-ordinator</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="#">About</a></li>
                <li><a href="./pages/contact.php">Contact</a></li>
                <!-- <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Signup</a></li> -->
            </ul>
        </div>
    </nav>

    <section class="student-info-section">
        <h2>Instructor  Information</h2>
        <div class="student-info">
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Email:</strong> John@gmail.com</p>
            <p><strong>Instructor ID:</strong> 792739</p>
            <!-- Add more student information here -->
        </div>
    </section>

    <section class="student-feedback">
        <h2>Student Feedback</h2>
        <form id="feedback-form">
            <label for="student-name-input">Student Name:</label>
            <input type="text" id="student-name-input" name="student-name-input" required>

            <label for="feedback-input">Feedback:</label>
            <textarea id="feedback-input" name="feedback-input" required></textarea>

            <button type="submit">Add Feedback</button>
        </form>

        <table id="feedback-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mike tyson</td>
                    <td>Good Working</td>
                </tr>
                <tr>
                    <td>Mike tyson</td>
                    <td>Good Working</td>
                </tr>
                <tr>
                    <td>Mike tyson</td>
                    <td>Good Working</td>
                </tr>
            </tbody>
        </table>
    </section>
    <!-- ... (previous HTML code) ... -->

<section class="course-management">
    <h2>Course Management</h2>
    <form id="course-form">
        <label for="course-name-input">Course Name:</label>
        <input type="text" id="course-name-input" name="course-name-input" required>

        <label for="course-desc-input">Course Description:</label>
        <input type="text" id="course-desc-input" name="course-desc-input" required>

        <button type="submit">Add Course</button>
    </form>

    <table id="course-table">
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
    </table>
</section>

<section class="student-progress">
    <h2>Student Progress Tracking</h2>
    <form id="progress-form">
        <label for="student-name-input">Student Name:</label>
        <input type="text" id="student-name-input" name="student-name-input" required>

        <label for="progress-input">Progress:</label>
        <input type="text" id="progress-input" name="progress-input" required>

        <button type="submit">Add Progress</button>
    </form>

    <table id="progress-table">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Progress</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mike tyson</td>
                <td>Good Working</td>
            </tr>
            <tr>
                <td>Mike tyson</td>
                <td>Good Working</td>
            </tr>
            <tr>
                <td>Mike tyson</td>
                <td>Good Working</td>
            </tr>
        </tbody>
    </table>
</section>

<footer>
    <div class="container-footer">
        <p>&copy; 2023 Skillify. All rights reserved.</p>
        <div class="social-media-icons">
            <a href="https://www.facebook.com/yourcompany" target="_blank"><img width="20" height="20" src="../icon/facebook.png" alt="Facebook"></a>
            <a href="https://www.twitter.com/yourcompany" target="_blank"><img width="20" height="20" src="../icon/twitter.png" alt="Twitter"></a>
            <a href="https://www.linkedin.com/company/yourcompany" target="_blank"><img width="20" height="20" src="../icon/instagram.png" alt="instagram"></a>
        </div>
    </div>
</footer>

<!-- ... (rest of the code) ... -->


    <script src="../js/ins.js"></script> <!-- Link to your JavaScript file -->
</body>
</html>