<?php
// Include the database connection file
include("db_connection.php");

// Fetch a list of students from the database
$sql = "SELECT * FROM users WHERE role = 'student'";
$result = $mysqli->query($sql);
$students = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
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
        </div>
    </nav>

    <h1>Student List</h1>
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Student Email</th>
                <th>Student ID</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student["username"]); ?></td>
                    <td><?php echo htmlspecialchars($student["email"]); ?></td>
                    <td><?php echo htmlspecialchars($student["id"]); ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
