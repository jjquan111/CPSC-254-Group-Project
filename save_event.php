<?php
session_start();
require 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'], $_POST['title'], $_POST['start'], $_POST['end'])) {
    $title = $_POST['title'];
    $start = date('Y-m-d H:i:s', strtotime($_POST['start'])); // Format the start date
    $end = date('Y-m-d H:i:s', strtotime($_POST['end'])); // Format the end date
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO events (title, start_event, end_event, user_id) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$title, $start, $end, $user_id])) {
        $newEventId = $pdo->lastInsertId();
        // Return the newly added event data along with the event ID
        echo json_encode(['status' => 'success', 'event' => ['id' => $newEventId, 'title' => $title, 'start' => $start, 'end' => $end]]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to insert event']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
