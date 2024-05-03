<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Full Calendar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }
        .button:hover {background-color: #3e8e41}
        .button:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
    </style>
</head>
<body>
    <div id="calendar"></div>
    <a href="display_event.php" class="button">My Events</a>
    <a href="logout.php" class="button">Logout</a> <!-- Logout Link -->

    <script>
    $(document).ready(function() {
        // Initialize the FullCalendar
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            selectHelper: true,
            displayEventTime: false,
            events: 'fetch_events.php', // Fetch events from the server
            select: function(start, end) {
                var title = prompt('Add New Event:');
                if (title !== null) {
                    var startDate = prompt('Start Date (YYYY-MM-DD):', start.format());
                    var endDate = prompt('End Date (YYYY-MM-DD):', end.format());
                    if (startDate && endDate) {
                        var eventData = {
                            title: title,
                            start: startDate,
                            end: endDate,
                        };
                        $.ajax({
                            url: 'save_event.php',
                            type: 'POST',
                            data: eventData,
                            success: function(response) {
                                response = JSON.parse(response);
                                if (response.status === 'success') {
                                    $('#calendar').fullCalendar('renderEvent', {
                                        id: response.event.id,
                                        title: response.event.title,
                                        start: response.event.start,
                                        end: response.event.end
                                    }, true); // Stick the event
                                } else {
                                    alert('Failed to add event: ' + response.message);
                                }
                            },
                        });
                    }
                }
                $('#calendar').fullCalendar('unselect');
            },
        });
    });
    </script>
</body>
</html>
