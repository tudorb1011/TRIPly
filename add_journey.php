<?php
session_start();

if (isset($_POST["submit"])) {
    $userId = $_SESSION["user_id"]; // Assuming you have a user ID stored in the session
    $flights = $_POST["flights"];
    $departure = $_POST["departure"];
    $arrival = $_POST["arrival"];
    $transportation = $_POST["transportation"];
    $hotel = $_POST["hotel"];
    $sightseeings = $_POST["sightseeings"];

    // Database connection
    $hostname = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "login_register";
    $conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);
    if (!$conn) {
        die("Something went wrong");
    }

    $sql = "INSERT INTO journey (user_id, flights, departure, arrival, transportation, hotel, sightseeings) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "issssss", $userId, $flights, $departure, $arrival, $transportation, $hotel, $sightseeings);
        mysqli_stmt_execute($stmt);
        // Redirect to a success page or perform any other necessary actions
        header("Location: login.php");
        exit();
    } else {
        die("Something went wrong");
    }
}
?>