<?php
// Include the database connection file
include '../includes/dbh.inc.php';

// Retrieve form data
$event_id = $_POST['event_id'];
$user_email = $_POST['user_email'];

if(!empty($event_id) && !empty($user_email)){
    // Insert registration into database
$query = "INSERT INTO event_registrations (event_id, user_email) VALUES (:event_id, :user_email)";
$statement = $pdo->prepare($query);
$statement->bindParam(':event_id', $event_id);
$statement->bindParam(':user_email', $user_email);
}

if ($statement->execute()) {
    // Registration successful
    echo "Registration successful!";
} else {
    // Registration failed
    echo "Error: Unable to register for event.";
}
?>
