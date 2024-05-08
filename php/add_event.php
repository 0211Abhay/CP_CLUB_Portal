<?php
// add_event.php

// Include the database connection file
include '../includes/dbh.inc.php';

// Retrieve form data
$title = $_POST['title'];
$date = $_POST['date'];
$location = $_POST['location'];
$description = $_POST['description'];

// File handling and upload
$imagePath = ''; // Initialize image path variable
if ($_FILES['image']['error'] == 0) {
    $targetDir = 'http://localhost/CP_CLUB_Portal/assets/Events/'; // Directory where images will be stored
    $targetFile = $targetDir . basename($_FILES['image']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['image']['size'] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Insert event into database
$query = "INSERT INTO events (title, date, location, description, image_path) VALUES (:title, :date, :location, :description, :imagePath)";
$statement = $pdo->prepare($query);
$statement->bindParam(':title', $title);
$statement->bindParam(':date', $date);
$statement->bindParam(':location', $location);
$statement->bindParam(':description', $description);
$statement->bindParam(':imagePath', $imagePath);


if ($statement->execute()) {
    // Redirect back to admin page after successful insertion
    header('Location: ../php/events.php');
} else {
    // Handle error
    echo "Error: Unable to add event.";
}
?>
