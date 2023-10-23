<?php
// Include the database connection file
include("db_connection.php");

// Fetch a list of QA officers from the database
$sql = "SELECT * FROM users WHERE role = 'qa_officer'";
$result = $mysqli->query($sql);
$qaOfficers = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QA Officer List</title>
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
    <h1>QA Officer List</h1>
    <ul>
        <?php foreach ($qaOfficers as $qaOfficer): ?>
            <li>
                <a href="userinfo.php?username=<?php echo $qaOfficer['username']; ?>">
                    <?php echo $qaOfficer['username']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
