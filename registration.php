<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

$errors = array();
$successMessage = '';

if (isset($_POST["submit"])) {
    $fullName = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = isset($_POST["repeat_password"]) ? $_POST["repeat_password"] : '';

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
        $errors[] = "All fields are required to be filled";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    if ($password !== $passwordRepeat) {
        $errors[] = "Password does not match";
    }

    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        $errors[] = "Email already exists";
    }

    if (empty($errors)) {
        require_once "database.php";
        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            $successMessage = "You are registered successfully";
        } else {
            die("Something went wrong");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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
            background-color: rgba(0, 0, 255, 0.1);
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
            font-family: Arial, sans-serif;
            z-index: 999;
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
            font-size: 1em;
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            border-radius: 10px;
            color: #fff;
        }

        .form-btn {
            margin-top: 1em;
        }

        input[type="submit"] {
            padding: 0.8em 2em;
            font-size: 1em;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #ff0000;
        }

        .success-message {
            color: #00ff00;
        }

        p {
            margin-top: 10px;
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
    </style>
</head>

<body>
    <header>
        <a href="index.php" class="brand">TRIPly</a>
    </header>
    <div class="video-container">
        <video src="7.mp4" autoplay loop muted></video>
        <div class="overlay"></div>
        <div class="container">
            <h2>Registration</h2>
            <?php if (!empty($errors)) { ?>
                <div class="error-message">
                    <?php foreach ($errors as $error) {
                        echo $error . "<br>";
                    } ?>
                </div>
            <?php } ?>

            <?php if (!empty($successMessage)) { ?>
                <div class="success-message">
                    <?php echo $successMessage; ?>
                </div>
            <?php } ?>

            <form action="registration.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password"
                        required>
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Register" name="submit">
                </div>
            </form>
            <p>Already Registered? <a href="login.php">Login Here</a></p>
        </div>
    </div>
</body>

</html>