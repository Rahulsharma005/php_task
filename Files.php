<?php
session_start();

// Include the database connection file
include("db_connection.php");

// Get the current user's ID from the session
$user_id = $_SESSION["id"];

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = $_FILES["file"]["name"];
    $file_temp = $_FILES["file"]["tmp_name"];
    $file_description = $_POST["file_description"];

    // Define the directory where uploaded files will be stored
    $upload_dir = "uploads/"; // You may need to create this directory

    // Generate a unique file name to prevent overwriting
    $unique_file_name = $user_id . '_' . time() . '_' . $file_name;

    // Move the uploaded file to the upload directory
    if (move_uploaded_file($file_temp, $upload_dir . $unique_file_name)) {
        // Insert file information into the database
        $sql = "INSERT INTO user_files (user_id, file_name, file_description, file_path, upload_date) VALUES ('$user_id', '$file_name', '$file_description', '$upload_dir$unique_file_name', NOW())";
        $mysqli->query($sql);
        // Redirect to the same page
        header("Location: Files.php");
        exit;
    } else {
        echo "File upload failed.";
    }
}

// Query to retrieve the user's uploaded files
$sql = "SELECT * FROM user_files WHERE user_id = '$user_id'";
$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Files</title>
    <link rel="stylesheet" type="text/css" href="../Css/files.css">
    <link rel="stylesheet" href="../Css/index.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../Css/Home.css"> 
</head>
<body>

<!-- the header of the website -->
<nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Skillify</a>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu">
                <li><a href="Studentlist.php">Students</a></li>
                <li><a href="Files.php">Files</a></li>
                <li><a href="Chats.php">Chat</a></li>
                <li><a href="Appointments.php">Appointments</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
</nav>

<h2 class="heading_files">Upload the Necessary Documents</h2>
<form class="files_form" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST" enctype="multipart/form-data">
    <label class="files_label" for="file">Choose a file to upload:</label>
    <input type="file" name="file" id="file" required>
    <br>
    <label class="files_label" for="file_description">File Description (optional):</label>
    <input type="text" name="file_description" id="file_description">
    <br>
    <button type="submit">Upload File</button>
</form>

<h2 class="heading_files">Your Uploaded Files</h2>
<table>
    <thead>
        <tr>
            <th>File Name</th>
            <th>File Description</th>
            <th>Upload Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><a href='" . $row["file_path"] . "' target='_blank'>" . $row["file_name"] . "</a></td>";
            echo "<td>" . $row["file_description"] . "</td>";
            echo "<td>" . $row["upload_date"] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- <footer>
    <div class="container-footer">
        <p>&copy; 2023 Skillify. All rights reserved.</p>
        <div class="social-media-icons">
            <a href="https://www.facebook.com/yourcompany" target="_blank"><img width="20" height="20" src="../icon/facebook.png" alt="Facebook"></a>
            <a href="https://www.twitter.com/yourcompany" target="_blank"><img width="20" height="20" src="../icon/twitter.png" alt="Twitter"></a>
            <a href="https://www.linkedin.com/company/yourcompany" target="_blank"><img width="20" height="20" src="../icon/instagram.png" alt="instagram"></a>
        </div>
    </div>
</footer> -->
</body>
</html>
