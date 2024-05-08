<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CP Club Events</title>
    <link rel="icon" href="../assets/Images/12.png" type="image/png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        .main {
            text-align: center;
        }
        .heading {
            margin-top: 20px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .event-card {
            margin: 10px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: left;
            max-width: 400px;
        }
        .event-card h3 {
            margin-top: 0;
        }
        .event-card input[type="text"], .event-card input[type="email"], .event-card button {
            margin-top: 10px;
            width: calc(100% - 40px);
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .event-card button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="main">
        <h3 class="heading">CP Club Event Registration</h3>
        <div class="container">
            <?php
            // Include the database connection file
            include '../includes/dbh.inc.php';

            // Query to fetch events from the database
            $query = "SELECT * FROM events";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $events = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Check if there are any events
            if ($events) {
                // Loop through each event and display it in a card
                foreach ($events as $event) {
                    echo '<div class="event-card">';
                    echo '<h3 class="title">' . $event['title'] . '</h3>';
                    echo '<p>' . $event['description'] . '</p>';
                    echo '<form action="register_event.php" method="POST">';
                    echo '<input type="hidden" name="event_id" value="' . $event['id'] . '">';
                    echo '<label for="user_email">Your Email:</label><br>';
                    echo '<input type="email" id="user_email" name="user_email" required><br>';
                    echo '<button type="submit">Register</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No events found.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
