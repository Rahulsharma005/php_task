<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
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
            <ul class="nav-menu">
                <li><a href="stuAnalytics.php">Grades</a></li>
                <li><a href="Files.php">Files</a></li>
                <li><a href="Chat.php">Chat</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><form action="logout.php" method="POST">
                    <button type="submit" name="logout-submit" class="logout-btn"
                    >Logout</button>
                </form></li>

                <!-- <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Signup</a></li> -->
            </ul>
        </div>
    </nav>

    <section class="student-info-section">
        <h2>Student Information</h2>
        <div class="student-info">
            <!-- <p><strong>Name:</strong> [Student Name]</p> -->
            <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
            <!-- <p><strong>Email:</strong> [Student Email]</p> -->
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION["email"]); ?></p>
            <!-- <p><strong>Student ID:</strong> [Student ID]</p> -->
            <p><strong>Student ID:</strong> <?php echo htmlspecialchars($_SESSION["id"]); ?></p>
            <!-- Add more student information here -->
        </div>
    </section>

    <section class="courses-section">
        <h2>Your Courses</h2>
        <!-- <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Course 1</td>
                    <td><button class="start-course">Start</button></td>
                </tr>
                <tr>
                    <td>Course 2</td>
                    <td><button class="start-course">Start</button></td>
                </tr>
            </tbody>
        </table> -->
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Instructor</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- loop over number of courses and add a row for each course -->
                <?php
                for ($i = 0; $i < count($_SESSION["courses"]); $i++) {
                    echo "<tr>";
                    echo "<td>" . $_SESSION["courses"][$i] . "</td>";
                    echo "<td>" . $_SESSION["instructors"][$i] . "</td>";
                    echo "<td><button class='start-course'>Start</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
    </section>

    <section class="exams-section">
        <h2>Your Exams</h2>
        <table>
            <thead>
                <tr>
                    <th>Exam Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Exam 1</td>
                    <td><button  class="start-exam">Start</button></td>
                </tr>
                <tr>
                    <td>Exam 2</td>
                    <td><button class="start-exam">Start</button></td>
                </tr>
                <!-- Add more exams here -->
            </tbody>
        </table>
    </section>

    <section class="reports-section">
        <h2>Your Reports</h2>
        <table>
            <thead>
                <tr>
                    <th>Report Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Report 1</td>
                    <td><a class="table_btn" href="#" target="_blank">View Report</a></td>
                </tr>
                <tr>
                    <td>Report 2</td>
                    <td><a class="table_btn"  href="#" target="_blank">View Report</a></td>
                </tr>
                <!-- Add more reports here -->
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

    <script src="../js/index.js"></script> <!-- Link to your JavaScript file -->
</body>
</html>
