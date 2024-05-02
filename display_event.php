<?php
session_start();
require 'database_connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM events WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Events</title>
    <style>
        .button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>My Events</h1>
    <a href="dynamic-full-calendar.php" class="button">Back to Calendar</a>
    <?php foreach ($events as $event): ?>
        <p>
            <?php echo htmlspecialchars($event['title']); ?>
            <button class="button" onclick="deleteEvent(<?php echo $event['id']; ?>)">Delete</button>
        </p>
    <?php endforeach; ?>
    <script>
    function deleteEvent(eventId) {
        if (confirm('Are you sure you want to delete this event?')) {
            fetch('delete_event.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'event_id=' + eventId
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Event deleted');
                    location.reload(); // Reload the page to update the list of events
                } else {
                    alert('Error deleting event: ' + data.message);
                }
            })
            .catch(error => alert('Error deleting event: ' + error));
        }
    }
    </script>
</body>
</html>


