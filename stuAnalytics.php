<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Analytics</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <a href="QA.php"> <- Go Back to QA Page</a>
        <h1>Student Analytics</h1>
    </header>

    <!-- Course Enrollment Chart -->
    <section>
        <h2>Course Enrollment</h2>
        <canvas id="courseEnrollmentChart" width="400" height="200"></canvas>
    </section>

    <!-- Exams Chart -->
    <section>
        <h2>Exams</h2>
        <canvas id="examsChart" width="400" height="200"></canvas>
    </section>

   
    
    <script>
        // Sample data for the course enrollment chart (replace with your actual data)
        const courseEnrollmentData = {
            labels: ['Course A', 'Course B', 'Course C', 'Course D'],
            datasets: [{
                label: 'Enrollment',
                data: [30, 45, 20, 60],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                ],
                borderWidth: 1
            }]
        };

        // Create the course enrollment chart
        const courseEnrollmentChartCanvas = document.getElementById('courseEnrollmentChart').getContext('2d');
        new Chart(courseEnrollmentChartCanvas, {
            type: 'bar',
            data: courseEnrollmentData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Enrollment Count'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Courses'
                        }
                    }
                }
            }
        });

        // Sample data for the exams chart (replace with your actual data)
        const examsData = {
            labels: ['Exam 1', 'Exam 2', 'Exam 3'],
            datasets: [{
                label: 'Scores',
                data: [85, 78, 92],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        };

        // Create the exams chart
        const examsChartCanvas = document.getElementById('examsChart').getContext('2d');
        new Chart(examsChartCanvas, {
            type: 'bar',
            data: examsData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Scores'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Exams'
                        }
                    }
                }
            }
        });

        // Add more chart creation logic for other analytics sections (assessments, attendance, grading)
    </script>
</body>
</html>
