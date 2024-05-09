<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Login Form Using Bootstrap 5</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/event.css">
</head>
<body> 
    <section class="wrapper">
		<div class="container">
			 
			<a href="../HTML/Admin_Dashboard.html" class="back-button"><button type="button" class="btn btn-primary submit_btn w-20 my-4">Back</button></a>
			<div class="events-container">
				<?php include '../php/fetch_events.php'; ?>
			</div>
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
				<form class="rounded bg-white shadow p-5" action="../php/add_event.php" method="post" enctype="multipart/form-data">
					<h3 class="text-dark fw-bolder fs-4 mb-5">Create an Event</h3>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="title" placeholder="Event Title" name="title" required>
                        <label for="title">Event Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="date" placeholder="date" name="date" required>
                        <label for="date">Date</label>
                    </div> 
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="location" placeholder="name@example.com" name="location" required>
						<label for="location">Location</label>
					</div>

					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="description" placeholder="name@example.com" name="description" required>
						<label for="description">Description</label>
					</div>

					<div class="form-floating mb-3" id="IMG">
						<input type="file" class="form-control" id="image" placeholder="name@example.com" name="image" required>
						<label for="image">Event Image</label>
					</div>
					<button type="submit" class="btn btn-primary submit_btn w-100 my-4">Create Event</button> 
				</form>
			</div>
		</div>
	</section>
</body>
</html>


