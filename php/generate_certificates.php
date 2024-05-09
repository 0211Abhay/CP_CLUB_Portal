<?php
require('../includes/dbh.inc.php');
if(isset($_POST['generate_certificate'])) {
    // Establish database connection (replace dbname, username, password with your actual database credentials)
    $conn = new mysqli('localhost', 'root', '', 'final_database_iwt_project');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get event details using event ID
    $eventId = $_POST['event_id'];
    $stmtEvent = $conn->prepare("SELECT title, date FROM events WHERE id = ?");
    $stmtEvent->bind_param('i', $eventId);
    $stmtEvent->execute();
    $eventResult = $stmtEvent->get_result();
    $event = $eventResult->fetch_assoc();

    // Get user details using event ID
    $stmtUsers = $conn->prepare("SELECT u.first_name, u.last_name, e.user_email FROM users u JOIN event_registrations e ON u.inst_mail = e.user_email WHERE e.event_id = ?");
    $stmtUsers->bind_param('i', $eventId);
    $stmtUsers->execute();
    $usersResult = $stmtUsers->get_result();
    $users = $usersResult->fetch_all(MYSQLI_ASSOC);

    // Load the certificate image
    $image = imagecreatefromjpeg("../assets/Images/certificate.jpeg");

    // Text color
    $color = imagecolorallocate($image, 116, 112, 67);

    // Font path
    $font = "NotoSans-Variable.ttf"; // Make sure this path is correct

    // Iterate over each user and generate a certificate
    foreach ($users as $user) {
        // Certificate details
        $name = $user['first_name'] . " " . $user['last_name'];
        $date = $event['date'];
        $eventName = $event['title'];

        // Add text to the image
        imagettftext($image, 30, 0, 1000, 770, $color, $font, $name);
        imagettftext($image, 25, 0, 400, 940, $color, $font, $date);
        imagettftext($image, 25, 0, 400, 1010, $color, $font, $eventName); // Add event title

        // Remove invalid characters from the filename
        $filename = preg_replace("/[^A-Za-z0-9]/", "", $name);

        // Save the image with the name provided
        imagejpeg($image, "../assets/Certificates/{$filename}.jpeg");

        // Output image
        header('content-type:image/jpeg');
        imagejpeg($image);

        // Clean up
        imagedestroy($image);
    }

    // Close connection
    $conn->close();
}
?>
