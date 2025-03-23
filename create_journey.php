<?php
session_start();

if (isset($_POST["submit"])) {
    $userId = $_SESSION["user_id"];
    $flightNumber = $_POST["flight-number"]; // Add flight number variable
    $departure = $_POST["departure"];
    $arrival = $_POST["arrival"];
    $transportation = $_POST["transportation"];
    $hotel = $_POST["hotel"];
    $sightseeing = $_POST["sightseeing"]; // Change "sightseeings" to "sightseeing"

    require_once "database.php";
    $sql = "INSERT INTO journey (user_id, flights, departure, arrival, transportation, hotel, sightseeings) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "issssss", $userId, $flightNumber, $departure, $arrival, $transportation, $hotel, $sightseeing); // Update the parameter binding to include flightNumber and sightseeing
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION["journey_added"] = true;
            header("Location: user_home.php");
            exit();
        } else {
            die("Something went wrong");
        }
    } else {
        die("Something went wrong");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Journey</title>
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
            filter: brightness(70%);
            /* Adjusted brightness for the video background */
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 255, 0.1);
            /* Adjusted opacity for the blue overlay */
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
            font-family: Arial, sans-serif;
            max-height: 80vh;
            overflow-y: auto;
            padding: 20px;
            border-radius: 20px;
            background-color: rgba(0, 0, 0, 0.5);
        }

        h2 {
            font-size: 2.5em;
            margin-bottom: 1em;
        }

        .container button {
            display: block;
            margin: 1em auto;
            /* Added margin for spacing between buttons */
            padding: 1em 2em;
            /* Increased padding for bigger buttons */
            font-size: 1.2em;
            /* Increased font size */
            background-color: rgba(0, 123, 255, 0.8);
            /* Adjusted background color with transparency */
            color: #fff;
            border: none;
            border-radius: 20px;
            /* Added border-radius for rounder buttons */
            cursor: pointer;
            text-decoration: none;
            /* Removed text-decoration from default */
            position: relative;
            /* Added relative positioning for the underline */
        }

        .container button::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: #fff;
            transform: scaleX(0);
            /* Initially hide the underline */
            transition: transform 0.3s ease-in-out;
            /* Add a transition effect */
        }

        .container button:hover::before {
            transform: scaleX(1);
            /* Show the underline on hover */
        }

        .container textarea {
            display: none;
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
            padding: 10px;
            resize: none;
        }

        .container input[type="submit"] {
            display: block;
            margin: 1em auto;
            padding: 1em 2em;
            font-size: 1.2em;
            background-color: green;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            position: relative;
        }

        .container .btn-back {
            display: block;
            margin: 1em auto;
            padding: 1em 2em;
            font-size: 1.2em;
            background-color: red;
            /* Red background color */
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            position: relative;
        }

        .container .btn-back::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: #fff;
            transform: scaleX(0);
            transition: transform 0.3s ease-in-out;
        }

        .container .btn-back:hover::before {
            transform: scaleX(1);
        }

        .save-wrapper {
            position: relative;
            display: inline-block;
            margin: 0 10px;
        }

        .save-wrapper::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 19px;
            /* Adjust the value to move the underline further down */
            width: 100%;
            height: 2px;
            background-color: #fff;
            transform: scaleX(0);
            transition: transform 0.3s ease-in-out;
        }

        .save-wrapper:hover::after {
            transform: scaleX(1);
        }
    </style>
    <script>
        function showTextbox(buttonId) {
            var textbox = document.getElementById(buttonId + "-textbox");
            var container = document.getElementById(buttonId + "-container");
            textbox.style.display = "block";
            container.style.display = "block";
            if (buttonId === 'flights') {
                var departureContainer = document.getElementById("departure-container");
                departureContainer.style.display = "block";
                var arrivalContainer = document.getElementById("arrival-container");
                arrivalContainer.style.display = "block";
            }
            adjustContainerHeight();
        }

        function adjustContainerHeight() {
            var container = document.querySelector(".container");
            var windowHeight = window.innerHeight;
            var containerHeight = container.scrollHeight;
            var containerMargin = 20; // Adjust the margin as needed
            var maxHeight = windowHeight - 2 * containerMargin;
            container.style.maxHeight = maxHeight + "px";
            container.style.overflowY = "auto";
        }
    </script>
</head>

<body>
    <div class="video-container">
        <video src="9.mp4" autoplay muted loop></video>
        <div class="overlay"></div>
        <div class="container">
            <h2>Add Journey</h2>
            <form action="create_journey.php" method="post">
                <button onclick="showTextbox('flights')" type="button" class="btn">Add Flights</button>
                <div id="flights-container" style="display: none;">
                    <div id="flights-textbox" style="display: none;">
                        <label for="flight-number-textbox">Flight number:</label>
                        <input type="text" id="flight-number-textbox" name="flight-number"
                            placeholder="Enter flight number">
                    </div>
                    <div id="departure-container" style="display: none;">
                        <label for="departure-textbox">Departure:</label>
                        <input type="text" id="departure-textbox" name="departure" placeholder="Enter departure city">
                    </div>
                    <div id="arrival-container" style="display: none;">
                        <label for="arrival-textbox">Arrival:</label>
                        <input type="text" id="arrival-textbox" name="arrival" placeholder="Enter arrival city">
                    </div>
                </div>
                <button onclick="showTextbox('transportation')" type="button" class="btn">Add Metropolitan
                    Transportation</button>
                <div id="transportation-textbox" style="display: none;">
                    <label for="transportation-textbox">Transportation details:</label>
                    <input type="text" id="transportation-textbox" name="transportation"
                        placeholder="Enter transportation details...">
                </div>
                <button onclick="showTextbox('hotel')" type="button" class="btn">Add Hotel</button>

                <div id="hotel-textbox" style="display: none;">
                    <label for="hotel-textbox">Hotel details:</label>
                    <input type="text" id="hotel-textbox" name="hotel" placeholder="Enter hotel details...">
                </div>
                <button onclick="showTextbox('sightseeing')" type="button" class="btn">Add Sightseeings</button>
                <div id="sightseeing-container" style="display: none;">
                    <div id="sightseeing-textbox" style="display: none;">
                        <label for="sightseeing-textbox">Sightseeing details:</label>
                        <input type="text" id="sightseeing-textbox" name="sightseeing"
                            placeholder="Enter sightseeing details...">
                    </div>
                </div>
                <div class="save-wrapper">
                    <input type="submit" name="submit" value="Save Journey" class="btn">
                </div>
                <a href="user_home.php" class="btn btn-back">Back</a>
            </form>
        </div>
    </div>
</body>

</html>