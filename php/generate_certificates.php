<?php
// Include the database connection file
include '../includes/dbh.inc.php';

if(isset($_POST['generate_certificate'])) {
    header('content-type:image/jpeg');

    // Get event ID and name from the form submission
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];

    // Query to fetch registered users for the event
    $query = "SELECT * FROM event_registrations WHERE event_id = :event_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':event_id', $event_id);
    $statement->execute();
    $registrations = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Load the certificate template image
    $certificate_template = imagecreatefromjpeg("../assets/Images/certificate.jpg");

    // Set font path
    $font = "NotoSans-Variable.ttf"; // Make sure this path is correct

    // Set text color
    $text_color = imagecolorallocate($certificate_template, 0, 0, 0); // Black

    // Loop through registrations to generate certificates
    foreach ($registrations as $registration) {
        // Get user email from registration
        $user_email = $registration['user_email'];

        // Query to fetch user details based on email (Assuming users table exists)
        $query = "SELECT * FROM users WHERE inst_mail = :user_email";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':user_email', $user_email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // Check if user exists
        if ($user) {
            // Get user name and registration date
            $name = $user['name'];
            $registration_date = $registration['registration_date'];

            // Add user details to the certificate
            imagettftext($certificate_template, 30, 0, 100, 200, $text_color, $font, $name);
            imagettftext($certificate_template, 20, 0, 100, 250, $text_color, $font, $registration_date);

            // Add event name to the certificate
            imagettftext($certificate_template, 20, 0, 100, 300, $text_color, $font, $event_name);

            // Save the certificate with the user's name
            $certificate_name = preg_replace("/[^A-Za-z0-9]/", "", $name); // Remove invalid characters
            imagejpeg($certificate_template, "../assets/Certificates/{$certificate_name}.jpg");

            // Reset certificate template for next user
            $certificate_template = imagecreatefromjpeg("certificate_template.jpg");
        }
    }

    // Free up memory
    imagedestroy($certificate_template);
}
?>
