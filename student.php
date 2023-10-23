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
                <li><a href="chats.php">Chat</a></li>
                <li><a href="About.php">About</a></li>
                <li><a href="Contact">Contact</a></li>
                <li><a href="userInfo.php?username=<?php echo $_SESSION['username']; ?>">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
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
        for ($i = 0; $i < count($_SESSION["courses"]); $i++) {
            echo "<tr>";
            echo "<td>" . $_SESSION["courses"][$i] . "</td>";
            echo "<td>" . $_SESSION["instructors"][$i] . "</td>";
            echo "<td><button class='start-course'>Start</button></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        ?>
    </section>

    <section class="exams-section">
        <?php
        echo "<h2>Your Exams</h2>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Exam Name</th>";
        echo "<th>Course Name</th>";
        echo "<th>Start Date</th>";
        echo "<th>Marks</th>";
        echo "<th>Total Marks</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        for ($i = 0; $i < count($_SESSION["exams"]); $i++) {
            echo "<tr>";
            echo "<td>" . $_SESSION["titles"][$i] . "</td>";
            echo "<td>" . $_SESSION["course_ids"][$i] . "</td>";
            echo "<td>" . $_SESSION["startDates"][$i] . "</td>";
            echo "<td>" . $_SESSION["marks"][$i] . "</td>";
            echo "<td>" . $_SESSION["totalmarks"][$i] . "</td>";
            if ($_SESSION["examdone"][$i] == 0) {
                echo "<td><button class='start-exam'>Start</button></td>";
            } else {
                echo "<td><button class='start-exam'>View</button></td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        ?>
    </section>

    <section class="reports-section">
        <?php
        echo "<h2>Your Reports</h2>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Course Name</th>";
        echo "<th>Attendance</th>";
        echo "<th>Exam Marks</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        for ($i = 0; $i < count($_SESSION["reports"]); $i++) {
            echo "<tr>";
            echo "<td>" . $_SESSION["reports"][$i] . "</td>";
            echo "<td>" . $_SESSION["attendance"][$i] . "</td>";
            echo "<td>" . $_SESSION["examMarks"][$i] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        ?>
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