<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <link rel="stylesheet" href="../css/event.css">
    <style>
        .back-button {
            position: absolute;
            top: 10px; /* Adjust as needed */
            left: 10px; /* Adjust as needed */
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Event Management Dashboard</h1>
        <!-- Back button -->
        <a href="../HTML/Admin_Dashboard.html" class="back-button">Back</a>
        
        <div class="events-container">
            <?php include '../php/fetch_events.php'; ?>
        </div>
        <div class="event-form">
            <h2>Create New Event</h2>
            <form action="../php/add_event.php" method="post" enctype="multipart/form-data">
                <label for="title">Event Title:</label>
                <input type="text" id="title" name="title" required>
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
                <label for="image">Event Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                <button type="submit">Create Event</button>
            </form>
        </div>
    </div>
</body>
</html>
