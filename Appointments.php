<?php
session_start();

// Include the database connection file
include("db_connection.php");

// Get the current instructor's ID from the session
$instructor_id = $_SESSION["id"];

// Query to retrieve appointments for the current instructor
$sql = "SELECT * FROM appointments WHERE instructor_id = '$instructor_id'";
$result = $mysqli->query($sql);
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
    <div class="header">
        <h1>Appointments</h1>
    </div>
    <div class="row">
        <div class="column">
            <h2>Appointments</h2>
            <?php
                // Check if there are appointments
                if ($result->num_rows > 0) {
                    // Display appointments in a table or list
                    echo "<h2>Appointments</h2>";
                    echo "<table>";
                    echo "<thead><tr><th>Appointment Date</th><th>Student Name</th><th>Description</th></tr></thead>";
                    echo "<tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["appointment_date"] . "</td>";
                        // You may need to fetch the student's name based on their ID
                        echo "<td>Student Name</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>No appointments found for this instructor.</p>";
                }
            ?>
        </div>
    </div>
</body>
</html>