<?php
session_start();
require 'database_connection.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch events
    $sql = "SELECT id, title, start, end FROM events";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch all events as an associative array
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Convert dates to ISO format and set allDay to true
    foreach ($events as $key => $event) {
        $events[$key]['start'] = date(DATE_ISO8601, strtotime($event['start']));
        $events[$key]['end'] = date(DATE_ISO8601, strtotime($event['end']));
        $events[$key]['allDay'] = true;
        // Include the event ID in the event data
        $events[$key]['id'] = $event['id'];
    }

    // Output events as JSON
    echo json_encode($events);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
