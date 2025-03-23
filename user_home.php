<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

$userID = $_SESSION["user"];
$name = ""; // Initialize the $name variable

$sql = "SELECT * FROM users WHERE id='$userID'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $name = $user["full_name"];
} else {
    // Handle error when user data cannot be retrieved from the database
    // Redirect to an error page or display an error message
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .video-container {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(70%); /* Adjusted brightness for the video background */
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 255, 0.1); /* Adjusted opacity for the blue overlay */
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 3em;
            margin-bottom: 1em;
        }

        .btn {
            display: block; /* Changed to display block to make the buttons one under the other */
            margin: 1em auto; /* Added margin for spacing between buttons */
            padding: 1em 2em; /* Increased padding for bigger buttons */
            font-size: 1.2em; /* Increased font size */
            background-color: rgba(0, 123, 255, 0.8); /* Adjusted background color with transparency */
            color: #fff;
            border: none;
            border-radius: 20px; /* Added border-radius for rounder buttons */
            cursor: pointer;
            text-decoration: none; /* Removed text-decoration from default */
            position: relative; /* Added relative positioning for the underline */
        }

        .btn::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: #fff;
            transform: scaleX(0); /* Initially hide the underline */
            transition: transform 0.3s ease-in-out; /* Add a transition effect */
        }

        .btn:hover::before {
            transform: scaleX(1); /* Show the underline on hover */
        }
    </style>
</head>

<body>
    <div class="video-container">
        <video src="8.mp4" autoplay muted loop></video>
        <div class="overlay"></div>
        <div class="container">
            <h1>Welcome, <?php echo $name; ?>!</h1>
            <?php
            if (isset($_SESSION["journey_added"]) && $_SESSION["journey_added"]) {
                echo '<script>alert("Journey added successfully!");</script>'; // Show the popup message
                unset($_SESSION["journey_added"]); // Reset the session variable
            }
            ?>
            <a href="create_journey.php" class="btn">Create Journey</a>
            <a href="display_journey.php" class="btn">Display Journey</a>
            <a href="journey_history.php" class="btn">Journey History</a>
            <a href="logout.php" class="btn btn-warning">Logout</a>
        </div>
    </div>
</body>

</html>
