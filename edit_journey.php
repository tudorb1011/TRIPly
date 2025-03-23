<?php
require_once "database.php"; // Include the database connection file

if (isset($_GET['id'])) {
    $journeyId = $_GET['id'];

    // Retrieve the journey record from the database
    $sql = "SELECT * FROM journey WHERE journey_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $journeyId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $journey = mysqli_fetch_assoc($result);
    }

    // Handle the form submission
    if (isset($_POST['submit'])) {
        $flights = $_POST['flights'];
        $departure = $_POST['departure'];
        $arrival = $_POST['arrival'];
        $transportation = $_POST['transportation'];
        $hotel = $_POST['hotel'];
        $sightseeings = $_POST['sightseeings'];

        // Update the journey record in the database
        $sql = "UPDATE journey SET flights = ?, departure = ?, arrival = ?, transportation = ?, hotel = ?, sightseeings = ? WHERE journey_id = ?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssi", $flights, $departure, $arrival, $transportation, $hotel, $sightseeings, $journeyId);
            mysqli_stmt_execute($stmt);
            // Redirect to the journey history page or perform any other necessary actions
            header("Location: journey_history.php");
            exit();
        } else {
            die("Something went wrong");
        }
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the journey ID is not provided in the URL, redirect to the journey history page or display an error message
    header("Location: journey_history.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Journey</title>
    <style>
        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-container::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 255, 0.1);
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f2f2f2;
        }

        .container {
            text-align: center;
            max-width: 800px;
            padding: 30px 50px 30px 30px;
            /* Adjust the padding values as needed */
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            margin: 0 auto;
            margin-top: 20px;
        }

        .container h2 {
            color: #fff;
            margin-bottom: 20px;
        }

        .container label {
            color: #fff;
            text-align: left;
        }

        .container input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 10px;
        }

        .container .update-button {
            width: 150px;
            padding: 10px;
            border-radius: 20px;
            border: none;
            background-color: rgba(64, 224, 208, 0.8);
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .container .update-button:hover {
            background-color: rgba(64, 224, 208, 1);
        }

        .container .btn-back {
            display: block;
            margin: 1em auto;
            padding: 0.5em 1em;
            font-size: 1em;
            background-color: red;
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
    </style>
</head>

<body>
    <div class="video-container">
        <video src="12.mp4" autoplay loop muted></video>
    </div>
    <div class="container">
        <h2>Edit Journey</h2>
        <form action="" method="post">
            <label for="flights">Flights:</label>
            <input type="text" id="flights" name="flights" value="<?php echo $journey['flights']; ?>">
            <br>
            <label for="departure">Departure:</label>
            <input type="text" id="departure" name="departure" value="<?php echo $journey['departure']; ?>">
            <br>
            <label for="arrival">Arrival:</label>
            <input type="text" id="arrival" name="arrival" value="<?php echo $journey['arrival']; ?>">
            <br>
            <label for="transportation">Transportation:</label>
            <input type="text" id="transportation" name="transportation"
                value="<?php echo $journey['transportation']; ?>">
            <br>
            <label for="hotel">Hotel:</label>
            <input type="text" id="hotel" name="hotel" value="<?php echo $journey['hotel']; ?>">
            <br>
            <label for="sightseeings">Sightseeings:</label>
            <input type="text" id="sightseeings" name="sightseeings" value="<?php echo $journey['sightseeings']; ?>">
            <br>
            <input type="submit" name="submit" class="update-button" value="Update">
            <a href="journey_history.php" class="btn btn-back">Back</a>
        </form>
    </div>
</body>

</html>