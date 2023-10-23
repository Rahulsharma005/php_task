<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QAO Dashboard</title>
    <!-- Add your CSS and JavaScript libraries here -->
    <link rel="stylesheet" href="../Css/Qa.css">
    <link rel="stylesheet" href="../Css/index.css">
    <link rel="stylesheet" href="../Css/Home.css">
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
                <li><a href="studentlist.php">Student List</a></li>
                <li><a href="instructor.php">Instructor</a></li>
                <li><a href="programCordinator.php">Co-ordinator</a></li>
                <li><a href="chats.php">Chat</a></li>
                <li><a href="userInfo.php?username=<?php echo $_SESSION['username']; ?>">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <header>
        <h1>Quality Assurance Officer Dashboard</h1>
    </header>

    <!-- Course Data Section -->
    <section>
        <h2>Course Data</h2>
        <!-- Add a table to display course data -->
        <table>
            <!-- Add table headers here -->
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Instructor</th>
                </tr>
            </thead>
            <?php
                echo "<tbody>";
                for ($i = 0; $i < count($_SESSION["course"]); $i++) {
                    echo "<tr>";
                    echo "<td>" . $_SESSION["course"][$i] . "</td>";
                    echo "<td>" . $_SESSION["instructorName"][$i] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
            ?>
        </table>
    </section>

    <!-- Student Data Section -->
    <section>
        <h2>Student Data</h2>
        <!-- Add a table to display student data -->
        <table>
            <!-- Add table headers here -->
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Instructor</th>
                    <th>Analytics</th>
                </tr>
            </thead>
            <?php
                echo "<tbody>";
                for ($i = 0; $i < count($_SESSION["studentName"]); $i++) {
                    echo "<tr>";
                    echo "<td>" . $_SESSION["studentName"][$i] . "</td>";
                    echo "<td>" . $_SESSION["course"][$i] . "</td>";
                    echo "<td>" . $_SESSION["instructorName"][$i] . "</td>";
                    echo "<td><a href='analytics.php?studentName=" . $_SESSION["studentName"][$i] . "'>View Analytics</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
            ?>
        </table>
    </section>

    <!-- Instructor Data Section -->
    <section>
        <h2>Instructor Data</h2>
        <!-- Add a table to display instructor data -->
        <table>
            <!-- Add table headers here -->
            <thead>
                <tr>
                    <th>Instructor Name</th>
                    <th>Course</th>
                </tr>
            </thead>
            <?php
                echo "<tbody>";
                for ($i = 0; $i < count($_SESSION["instructorName"]); $i++) {
                    echo "<tr>";
                    echo "<td>" . $_SESSION["instructorName"][$i] . "</td>";
                    echo "<td>" . $_SESSION["course"][$i] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
            ?>
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

</body>
</html>
