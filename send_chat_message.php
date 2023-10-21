<?php
// Include the database connection file
include("db_connection.php");

// Retrieve sender and receiver IDs and the message from the request
$senderId = $_POST['sender_id'];
$receiverId = $_POST['receiver_id'];
$message = $_POST['message'];

// Insert the chat message into the database
$stmt = $mysqli->prepare("INSERT INTO chat_messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $senderId, $receiverId, $message);

if ($stmt->execute()) {
    // Message inserted successfully
    echo "Message sent successfully!";
} else {
    // Error occurred while sending the message
    echo "Error: Message not sent.";
}

// Close the database connection
$stmt->close();
?>
