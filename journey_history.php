<?php
require_once "database.php"; // Include the database connection file

// Fetch journey details from the database
$sql = "SELECT * FROM journey";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Create an array to store the journey details
    $journeys = array();

    // Loop through each row and store the data in the array
    while ($row = mysqli_fetch_assoc($result)) {
        $journeys[] = $row;
    }
} else {
    echo "No journeys found.";
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
            margin-top: 20px;
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

        h2 {
            color: #fff;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: rgba(0, 0, 255, 0.3);
            border-radius: 20px;
            border: none;
            color: #fff;
            text-decoration: none;
            margin-top: -10px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: rgba(0, 0, 255, 0.6);
        }

    </style>
</head>

<body>
    <div class="video-container">
        <video src="11.mp4" autoplay loop muted></video>
    </div>
    <div class="container">
        <h2>Journeys History</h2>
        <?php if (!empty($journeys)) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Flights</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th>Transportation</th>
                        <th>Hotel</th>
                        <th>Sightseeings</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($journeys as $journey) { ?>
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
                            <td>
                                <a href="edit_journey.php?id=<?php echo $journey['journey_id']; ?>">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
        <?php } ?>

        <a class="back-button" href="user_home.php">Back</a>
    </div>
</body>

</html>