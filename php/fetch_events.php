<?php
// fetch_events.php

// Include the database connection file
include '../includes/dbh.inc.php';

// Query to fetch events from database
$query = "SELECT * FROM events";
$statement = $pdo->prepare($query);
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
    echo '<p>No events found.</p>';
}
?>
