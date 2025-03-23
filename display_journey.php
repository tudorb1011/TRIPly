<?php
session_start(); // Start the session

require_once "database.php"; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Fetch the last journey from the database
$sql = "SELECT * FROM journey ORDER BY journey_id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

// Check if a row was returned
if (mysqli_num_rows($result) > 0) {
    // Fetch the journey details
    $journey = mysqli_fetch_assoc($result);
} else {
    echo "No journey found.";
}

// Fetch the user's name from the database if the session is set
$user_name = "";
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
    $user_sql = "SELECT full_name FROM users WHERE id = $user_id";
    $user_result = mysqli_query($conn, $user_sql);
    $user = mysqli_fetch_assoc($user_result);
    $user_name = $user['full_name'];
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Journey</title>
    <style>
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
            /* Adjust the opacity and color as desired */
        }


        .container {
            text-align: center;
            max-width: 800px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            /* Rounded corners */
        }

        .journey-details {
            margin-bottom: 20px;
            color: #fff;
            /* Set the text color to white */
        }

        table {
            width: 100%;
            border-collapse: separate;
            /* Use separate border-collapse */
            border-spacing: 0;
            /* Set border-spacing to 0 */
            margin-bottom: 20px;
            color: #000;
            overflow: hidden;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-radius: 0;
            border-right: 1px solid #000;
            /* Add a right border */
        }

        th:last-child,
        td:last-child {
            border-right: none;
            /* Remove the right border for the last column */
        }

        th {
            background-color: #ccc;
        }

        td {
            background-color: #fff;
        }

        .download-button {
            margin-top: 0px;
            display: inline-block;
        }

        .download-button input[type="submit"] {
            padding: 10px 20px;
            /* Adjust padding for a bigger button */
            font-size: 1em;
            background-color: rgba(0, 123, 255, 0.8);
            /* Use an rgba color with transparency */
            color: #fff;
            border: none;
            border-radius: 10px;
            /* Add border-radius for a rounder button */
            cursor: pointer;
        }

        .download-button input[type="submit"]:hover {
            background-color: rgba(0, 123, 255, 1);
            /* Darker blueish color on hover */
        }

        .back-button {
            margin-top: 10px;
        }

        .back-button input[type="submit"] {
            padding: 0.8em 2em;
            font-size: 1em;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .back-button input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="video-container">
        <video src="10.mp4" autoplay loop muted></video>
    </div>

    <div class="container">
        <div class="journey-details">
            <?php if (!empty($journey)) { ?>
                <h2>
                    <?php
                    if (!empty($user_name)) {
                        echo $user_name . ", here are your trip details from " . $journey['departure'] . " to " . $journey['arrival'];
                    } else {
                        echo "Here are the trip details from " . $journey['departure'] . " to " . $journey['arrival'];
                    }
                    ?>
                </h2>
            <?php } else {
                echo "No journey found.";
            } ?>
        </div>
        <?php if (!empty($journey)) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Flights</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th>Transportation</th>
                        <th>Hotel</th>
                        <th>Sightseeings</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $journey['flights']; ?>
                        </td>
                        <td>
                            <?php echo $journey['departure']; ?>
                        </td>
                        <td>
                            <?php echo $journey['arrival']; ?>
                        </td>
                        <td>
                            <?php echo $journey['transportation']; ?>
                        </td>
                        <td>
                            <?php echo $journey['hotel']; ?>
                        </td>
                        <td>
                            <?php echo $journey['sightseeings']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php } ?>
        <?php if (!empty($journey)) { ?>
            <form action="download_pdf.php" method="post" class="download-button">
                <input type="hidden" name="journey_id" value="<?php echo $journey['journey_id']; ?>">
                <input type="submit" name="download" value="Download as PDF">
            </form>
            <form action="user_home.php" class="back-button">
                <input type="submit" name="back" value="Back">
            </form>
        <?php } ?>
    </div>
</body>

</html>