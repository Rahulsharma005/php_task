<?php
session_start();

if (!isset($_POST['sender_id']) || !isset($_POST['receiver_id'])) {
    exit("Sender ID and Receiver ID are required.");
}

$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];

include("db_connection.php"); // Include your database connection script

// Prepare the SQL query to select chat messages
$stmt = $mysqli->prepare("SELECT sender_id, receiver_id, message_text FROM chat_messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY message_id ASC");

// Check if the SQL query is prepared successfully
if ($stmt === false) {
    exit("Error in preparing the SQL query.");
}

// Bind the parameters and execute the query
$stmt->bind_param('iiii', $sender_id, $receiver_id, $receiver_id, $sender_id);

// Check if the query is executed successfully
if ($stmt->execute()) {
    // Fetch the results and create an array of messages
    $result = $stmt->get_result();
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    echo json_encode($messages); // Return messages as JSON
} else {
    exit("Error executing the SQL query.");
}

// Close the prepared statement and the database connection
$stmt->close();
$mysqli->close();
