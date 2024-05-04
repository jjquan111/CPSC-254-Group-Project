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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
</head>
<body>
    <div id="calendar"></div>

    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newEventModal">
      Add New Event
    </button>

    <!-- The Modal -->
    <div class="modal fade" id="newEventModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add New Event</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            <form id="eventForm">
              <div class="form-group">
                <label for="eventName">Event name:</label>
                <input type="text" class="form-control" id="eventName" placeholder="Enter your event name" required>
              </div>
              <div class="form-group">
                <label for="eventStart">Event start:</label>
                <input type="date" class="form-control" id="eventStart" required>
              </div>
              <div class="form-group">
                <label for="eventEnd">Event end:</label>
                <input type="date" class="form-control" id="eventEnd" required>
              </div>
              <button type="submit" class="btn btn-primary">Save Event</button>
            </form>
          </div>

        </div>
      </div>
    </div>

    <a href="display_event.php" class="btn btn-info">My Events</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>

    <script>
    $(document).ready(function() {
        var calendar = $('#calendar'); // Ensuring the calendar div is targeted correctly
        calendar.fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'month', // Ensure a default view is set
            selectable: true,
            selectHelper: true,
            displayEventTime: false, // Adjusted to match your settings
            events: 'fetch_events.php', // Ensure this script is returning valid JSON data
            select: function(start, end) {
                // Function to handle adding new events
                $('#newEventModal').modal('show');
                $('#eventStart').val(start.format('YYYY-MM-DD'));
                $('#eventEnd').val(end.format('YYYY-MM-DD'));
            }
        });

        $('#eventForm').on('submit', function(e) {
            e.preventDefault();
            var eventName = $('#eventName').val();
            var eventStart = $('#eventStart').val();
            var eventEnd = $('#eventEnd').val();

            $.ajax({
                url: 'save_event.php',
                type: 'POST',
                data: {
                    title: eventName,
                    start: eventStart,
                    end: eventEnd
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status === 'success') {
                        calendar.fullCalendar('renderEvent', {
                            id: response.event.id,
                            title: response.event.title,
                            start: response.event.start,
                            end: response.event.end
                        }, true);
                        $('#newEventModal').modal('hide');
                    } else {
                        alert('Failed to add event: ' + response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Failed to add event: ' + textStatus);
                }
            });
        });
    });
    </script>
</body>
</html>
