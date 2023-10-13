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
                <li><a href="chat.php">Chat</a></li>
                <li>
                    <form action="logout.php" method="POST">
                        <button type="submit" name="logout-submit" class="logout-btn">Logout</button>
                    </form>
                </li>
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
                    <th>Analytics</th>
                </tr>
            </thead>
            <tbody>
                <!-- Add rows for each course -->
                <tr>
                    <td>Course A</td>
                    <td>Instructor X</td>
                    <td><a href="analytics.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Course B</td>
                    <td>Instructor Y</td>
                    <td><a href="analytics.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Course C</td>
                    <td>Instructor Z</td>
                    <td><a href="analytics.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Course D</td>
                    <td>Instructor X</td>
                    <td><a href="analytics.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Course E</td>
                    <td>Instructor Y</td>
                    <td><a href="analytics.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Course F</td>
                    <td>Instructor Z</td>
                    <td><a href="analytics.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Course G</td>
                    <td>Instructor X</td>
                    <td><a href="analytics.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Course H</td>
                    <td>Instructor Y</td>
                    <td><a href="analytics.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Course I</td>
                    <td>Instructor Z</td>
                    <td><a href="analytics.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Course J</td>
                    <td>Instructor X</td>
                    <td><a href="analytics.php">View Analytics</a></td>
                </tr>
                
                <!-- Add more rows as needed -->
            </tbody>
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
                for ($i = 0; $i < count($_SESSION["student"]); $i++) {
                    echo "<tr>";
                    echo "<td>" . $_SESSION["studentName"][$i] . "</td>";
                    echo "<td>" . $_SESSION["course"][$i] . "</td>";
                    echo "<td>" . $_SESSION["instructorName"][$i] . "</td>";
                    echo "<td><a href='stuAnalytics.php'>View Analytics</a></td>";
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
                    <th>Analytics</th>
                </tr>
            </thead>
            <tbody>
                <!-- Add rows for each instructor -->
                <tr>
                    <td>Instructor X</td>
                    <td>Course A</td>
                    <td><a href="insAnalytic.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Instructor Y</td>
                    <td>Course B</td>
                    <td><a href="insAnalytic.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Instructor Z</td>
                    <td>Course C</td>
                    <td><a href="insAnalytic.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Instructor X</td>
                    <td>Course D</td>
                    <td><a href="insAnalytic.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Instructor Y</td>
                    <td>Course E</td>
                    <td><a href="insAnalytic.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Instructor Z</td>
                    <td>Course F</td>
                    <td><a href="insAnalytic.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Instructor X</td>
                    <td>Course G</td>
                    <td><a href="insAnalytic.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Instructor Y</td>
                    <td>Course H</td>
                    <td><a href="insAnalytic.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Instructor Z</td>
                    <td>Course I</td>
                    <td><a href="insAnalytic.php">View Analytics</a></td>
                </tr>
                <tr>
                    <td>Instructor X</td>
                    <td>Course J</td>
                    <td><a href="analytics.php">View Analytics</a></td>
                </tr>
                
                <!-- Add more rows as needed -->
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

</body>
</html>
