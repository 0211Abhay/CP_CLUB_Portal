<?php
require("../includes/dbh.inc.php"); // Include your database connection file
require("../includes/config_session.inc.php");

// Check if data is received from JavaScript
if ( isset($_POST['response']) && isset($_POST['time_taken']) ){
    $user_id = $_COOKIE["user_id"];
    $response = $_POST['response'];
    $time_taken = $_POST['time_taken'];

    try {
        // Prepare SQL statement to insert data into the database
        $stmt = $pdo->prepare("INSERT INTO user_responses (user_id, response, time_taken) VALUES (:user_id, :response, :time_taken)");

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':response', $response);
        $stmt->bindParam(':time_taken', $time_taken);

        // Execute the statement
        $stmt->execute();

        echo "Data inserted successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
