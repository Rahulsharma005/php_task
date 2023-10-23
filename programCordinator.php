<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Coordinator Dashboard</title>
    <link rel="stylesheet" href="../Css/Program.css"> 
    <link rel="stylesheet" href="../Css/Home.css"> 
    <link rel="stylesheet" href="../Css/index.css"> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                <li><a href="instructorList.php">Instructor</a></li>
                <li><a href="QAList.php">QA officer</a></li>
                <li><a href="adminList.php">Admin</a></li>
                <li><a href="chats.php">Chat</a></li>
                <li><a href="userInfo.php?username=<?php echo $_SESSION['username']; ?>">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <header>
        <h1>Program Coordinator Dashboard</h1>
    </header>

    <!-- Program Coordinator Dashboard Content -->
    <section class="dashboard-content">
        <!-- Coordinator Information -->
        <div class="coordinator-info">
            <?php
                echo "<h2>Welcome, " . $_SESSION["username"] . "</h2>";
                echo "<p>Email: " . $_SESSION["email"] . "</p>";
            ?>
        </div>

        <!-- Communication Tools -->
        <div class="communication-tools">
            <h2>Communication Tools</h2>
            <!-- Add communication tools here, e.g., chat, messaging, email -->
            <ul>
                <li><a href="chats.php">Chat with Instructors</a></li>
                <li><a href="chats.php">Send Messages to Students</a></li>
                <li><a href="mailto:
                <?php
                    echo $_SESSION["email"];
                ?>
                ">Email Administrators</a></li>
            </ul>
        </div>

        <!-- Student Performance Monitoring -->
        <div class="performance-monitoring">
            <h2>Student Performance Monitoring</h2>
            <!-- Analytics table for student performance -->
            <table border="1">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Attendance (%)</th>
                        <th>Grades (%)</th>
                    </tr>
                </thead>
                <?php
                    echo "<tbody>";
                    for ($i = 0; $i < count($_SESSION["students"]); $i++) {
                        echo "<tr>";
                        echo "<td>" . $_SESSION["students"][$i] . "</td>";
                        echo "<td>" . $_SESSION["courseName"][$i] . "</td>";
                        echo "<td>" . $_SESSION["attendance"][$i] . "</td>";
                        echo "<td>" . $_SESSION["percentage"][$i] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                ?>
            </table>
        </div>
    </section>

    <!-- Link to Reports Page -->
    <div class="student-inquiries-chart">
        <canvas id="studentInquiriesPieChart" width="400" height="200"></canvas>
    </div>
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
<script>
    // Sample data for the pie chart (replace with your actual data)
    const studentInquiriesData = {
        labels: ['General Questions', 'Course Information', 'Technical Issues', 'Other'],
        datasets: [{
            data: [30, 25, 15, 10],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
            hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
        }]
    };

    // Create the pie chart
    const studentInquiriesPieChartCanvas = document.getElementById('studentInquiriesPieChart').getContext('2d');
    new Chart(studentInquiriesPieChartCanvas, {
        type: 'pie',
        data: studentInquiriesData,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
</html>
