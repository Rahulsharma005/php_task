<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/chat.css">
    <link rel="stylesheet" href="../Css/index.css">
    <link rel="stylesheet" href="../Css/Home.css">
    <title>Chat</title>
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
            <ul class="nav-menu">
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="chat.php">Chat</a></li>
                <?php if (isset($_SESSION['username'])) : ?>
                    <?php if ($_SESSION['role'] == "student") : ?>
                        <li><a href="student.php">Student <?php echo $_SESSION['username']; ?></a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "instructor") : ?>
                        <li><a href="instructor.php">Instructor <?php echo $_SESSION['username']; ?></a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "admin") : ?>
                        <li><a href="admin.php">Admin <?php echo $_SESSION['username']; ?></a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "coordinator") : ?>
                        <li><a href="programCordinator.php">Coordinator <?php echo $_SESSION['username']; ?></a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "qa_officer") : ?>
                        <li><a href="QA.php">QA Officer <?php echo $_SESSION['username']; ?></a></li>
                    <?php endif ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif ?>
                <?php if (!isset($_SESSION['username'])) : ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Signup</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>

    <div class="chat-container">
        <div class="chat-header">
            <h2>Chat with Instructors and QA Coordinators</h2>
        </div>
        <div class="chat-messages" id="chat-messages">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="chat-input">
            <input type="text" id="message-input" placeholder="Type your message...">
            <button id="send-button">Send</button>
        </div>
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

    <script src="../js/script.js"></script>
</body>
</html>
