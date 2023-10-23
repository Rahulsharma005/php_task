
<?php
session_start();

// all users get here
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

// get all users list   
include("db_connection.php");
$sql = "SELECT * FROM users";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
$mysqli->close();

// remove own id from users list
foreach ($users as $key => $user) {
    if ($user['id'] == $_SESSION['id']) {
        unset($users[$key]);
    }
}
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
                <li><a href="chats.php">Chat</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <?php if ($_SESSION['role'] == "student"): ?>
                        <li><a href="student.php">Student
                                <?php echo $_SESSION['username']; ?>
                            </a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "instructor"): ?>
                        <li><a href="instructor.php">Instructor
                                <?php echo $_SESSION['username']; ?>
                            </a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "admin"): ?>
                        <li><a href="admin.php">Admin
                                <?php echo $_SESSION['username']; ?>
                            </a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "coordinator"): ?>
                        <li><a href="programCordinator.php">Coordinator
                                <?php echo $_SESSION['username']; ?>
                            </a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "qa_officer"): ?>
                        <li><a href="QA.php">QA Officer
                                <?php echo $_SESSION['username']; ?>
                            </a></li>
                    <?php endif ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif ?>
                <?php if (!isset($_SESSION['username'])): ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Signup</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>

    <div class="chat-container">
        <div class="chat-header">
            <h2>Chat</h2>
        </div>
        <div class="chat-messages" id="chat-messages">
            <!-- Chat messages will be displayed here -->
            <!-- Sender message -->
            <div class="sender-message">
            </div>

            <!-- Receiver message -->
            <div class="receiver-message">
            </div>

        </div>
        <div class="chat-input">
            <input type="text" id="message-input" placeholder="Type your message...">
            <select name="users" id="users" class="users">
                <?php foreach ($users as $user) : ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                <?php endforeach; ?>
            </select>

            <button id="send-button">Send</button>
        </div>
    </div>

    <footer>
        <div class="container-footer">
            <p>&copy; 2023 Skillify. All rights reserved.</p>
            <div class="social-media-icons">
                <a href="https://www.facebook.com/yourcompany" target="_blank"><img width="20" height="20"
                        src="../icon/facebook.png" alt="Facebook"></a>
                <a href="https://www.twitter.com/yourcompany" target="_blank"><img width="20" height="20"
                        src="../icon/twitter.png" alt="Twitter"></a>
                <a href="https://www.linkedin.com/company/yourcompany" target="_blank"><img width="20" height="20"
                        src="../icon/instagram.png" alt="instagram"></a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var chatMessages = document.getElementById("chat-messages");
            var messageInput = document.getElementById("message-input");
            var sendButton = document.getElementById("send-button");

            // Initialize senderId and receiverId
            var senderId = <?php echo $_SESSION["id"]; ?>;
            var senderName = "<?php echo $_SESSION["username"]; ?>";
            var receiverId = document.getElementById("users").value;
            var receiverName = document.getElementById("users").text;

            // onchange event listener for the users dropdown
            document.getElementById("users").addEventListener("change", function () {
                receiverId = this.value;
                receiverName = this.text;
            });

            // Function to fetch and display messages
            function displayMessages() {
                // console.log(senderId);
                // console.log(receiverId);
                // Make an AJAX request to get chat messages
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "get_chat_messages.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var messages = JSON.parse(xhr.responseText);
                        chatMessages.innerHTML = "";
                        for (var i = 0; i < messages.length; i++) {
                            var message = messages[i];
                            var messageDiv = document.createElement("div");
                            if (message.sender_id == senderId) {
                                messageDiv.className = "sender-message";
                                messageDiv.textContent = senderName + ": " + message.message_text;
                                chatMessages.appendChild(messageDiv);
                            } else {
                                messageDiv.className = "receiver-message";
                                messageDiv.textContent = receiverName + ": " + message.message_text;
                                chatMessages.appendChild(messageDiv);
                            }
                        }
                    }
                };
                xhr.send("sender_id=" + senderId + "&receiver_id=" + receiverId);
            }

            // Poll for new messages every 5 seconds (you can adjust the interval)
            setInterval(displayMessages, 5000);

            // Send a new message
            sendButton.addEventListener("click", function () {
                var message = messageInput.value;
                messageInput.value = "";

                // Make an AJAX request to send the message
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "send_chat_message.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === "Message sent successfully!") {
                            // If the message was sent successfully, refresh the messages
                            displayMessages();
                        }
                    }
                };
                xhr.send("sender_id=" + senderId + "&receiver_id=" + receiverId + "&message=" + message);
            });

            // Initial call to displayMessages
            displayMessages();
        });
    </script>

</body>

</html>