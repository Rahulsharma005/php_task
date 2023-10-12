<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Coordinator Dashboard</title>
    <link rel="stylesheet" href="../Css/Program.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../Css/Home.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../Css/index.css"> <!-- Link to your CSS file -->
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
                <li><a href="student.php">Student</a></li>
                <li><a href="instructor.php">Instructor</a></li>
                <li><a href="QA.php">QA officer</a></li>
                <li><a href="programCordinator.php">Co-ordinator</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <!-- <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Signup</a></li> -->
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
            <h2>Welcome, Mike Watts</h2>
            <p>Email: Mike.W@gmail.com</p>
        </div>

        <!-- Communication Tools -->
        <div class="communication-tools">
            <h2>Communication Tools</h2>
            <!-- Add communication tools here, e.g., chat, messaging, email -->
            <ul>
                <li><a href="#">Chat with Instructors</a></li>
                <li><a href="#">Send Messages to Students</a></li>
                <li><a href="#">Email Administrators</a></li>
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
                <tbody>
                    <!-- Dummy data for student performance (5 records) -->
                    <tr>
                        <td>John Doe</td>
                        <td>Math 101</td>
                        <td>90%</td>
                        <td>85%</td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>English 201</td>
                        <td>95%</td>
                        <td>78%</td>
                    </tr>
                    <tr>
                        <td>Michael Johnson</td>
                        <td>Science 301</td>
                        <td>88%</td>
                        <td>92%</td>
                    </tr>
                    <tr>
                        <td>Susan White</td>
                        <td>History 101</td>
                        <td>92%</td>
                        <td>80%</td>
                    </tr>
                    <tr>
                        <td>Linda Brown</td>
                        <td>Art 202</td>
                        <td>98%</td>
                        <td>88%</td>
                    </tr>
                </tbody>
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
