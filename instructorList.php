<?php
// Include the database connection file
include("db_connection.php");

// Fetch a list of instructors from the database
$sql = "SELECT * FROM users WHERE role = 'instructor'";
$result = $mysqli->query($sql);
$instructors = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor List</title>
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
    <h1>Instructor List</h1>
    <ul>
        <?php foreach ($instructors as $instructor): ?>
            <li>
                <a href="userinfo.php?username=<?php echo $instructor['username']; ?>">
                    <?php echo $instructor['username']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
