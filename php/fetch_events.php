<?php
// Include the database connection file
include '../includes/dbh.inc.php';

// Get current date
$current_date = date('Y-m-d');

// Query to fetch events from database
$query = "SELECT * FROM events WHERE date >= :current_date";
$statement = $pdo->prepare($query);
$statement->bindParam(':current_date', $current_date);
$statement->execute();
$events = $statement->fetchAll(PDO::FETCH_ASSOC);

// Check if there are any events
if ($events) {
    // Display events
    foreach ($events as $event) {
        echo '<div class="event-card">';
        echo '<img src="' . $event['image_path'] . '" alt="' . $event['title'] . '" class="event-image">';
        echo '<div class="event-details">';
        echo '<h3>' . $event['title'] . '</h3>';
        echo '<p><strong>Date:</strong> ' . $event['date'] . '</p>';
        echo '<p><strong>Location:</strong> ' . $event['location'] . '</p>';
        echo '<p><strong>Description:</strong> ' . $event['description'] . '</p>';
        echo '</div>'; // Close event-details
        echo '</div>'; // Close event-card
    }
} else {
    echo '<p>No upcoming events found.</p>';
}
?>
