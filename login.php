<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: user_home.php");
    exit();
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once "database.php";

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $name = $user["full_name"];

        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user["id"]; // Store the user's ID in the session variable
            header("Location: user_home.php");
            exit();
        } else {
            $errorMessage = "Password does not match";
        }
    } else {
        $errorMessage = "Email does not exist";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

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
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 255, 0.2);
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
        }

        h2 {
            font-size: 2em;
            margin-bottom: 1em;
        }

        .form-group {
            margin-bottom: 1em;
        }

        .form-control {
            width: 100%;
            padding: 0.8em;
            /* Increased padding for bigger boxes */
            font-size: 1em;
            background-color: rgba(255, 255, 255, 0.3);
            /* Adjusted opacity for the form boxes */
            border: none;
            border-radius: 10px;
            /* Added border-radius for rounder boxes */
            color: #fff;
        }

        .form-btn {
            margin-top: 1em;
        }

        input[type="submit"] {
            padding: 0.8em 2em;
            /* Increased padding for bigger buttons */
            font-size: 1em;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 10px;
            /* Added border-radius for rounder buttons */
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #ff0000;
        }

        header {
            z-index: 999;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 200px;
            transition: 0.5s ease;
        }

        header .brand {
            position: absolute;
            top: 15px;
            left: 15px;
            color: #fff;
            font-size: 1.5em;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: none;
            z-index: 999;
            cursor: pointer;
        }

        .signup-link {
            margin-top: 1em;
        }
    </style>
</head>

<body>
    <header>
        <a href="index.php" class="brand">TRIPly</a>
    </header>

    <div class="video-container">
        <video src="5.mp4" autoplay loop muted></video>
        <div class="overlay"></div>
        <div class="container">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Login" name="login">
                </div>
            </form>
            <p class="signup-link">Don't have an account? <a href="registration.php">Sign up</a></p>
            <?php if (isset($errorMessage)): ?>
                <div class="error-message">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>