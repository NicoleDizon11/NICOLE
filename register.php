<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "nicole_database";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Initialize the error and success messages
$errorMsg = "";
$successMsg = "";

// Process registration form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["new_username"];
    $newPassword = $_POST["new_password"];

    // Check if the username already exists
    $checkUserSql = "SELECT * FROM users WHERE username='$newUsername'";
    $checkUserResult = $connection->query($checkUserSql);

    if ($checkUserResult->num_rows > 0) {
        $errorMsg = "Username already exists.<br> Please choose a different username.";
    } else {
        // Insert a new record if the username is unique
        $insertUserSql = "INSERT INTO users (username, password) VALUES ('$newUsername', '$newPassword')";

        if ($connection->query($insertUserSql) === TRUE) {
            $successMsg = "Registration successful!";
        } else {
            $errorMsg = "Error: " . $insertUserSql . "<br>" . $connection->error;
        }
    }
}
?>

<!-- Your HTML code for registration with added CSS -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: #ff0000;
            text-align: center;
            margin-bottom: 16px;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'head.php'?>
    <form action="register.php" method="post">
        <h2>Register</h2>
        <div class="success-message"><?php echo $successMsg; ?></div>
        <div class="error-message"><?php echo $errorMsg; ?></div>
        <label for="new_username">Username:</label>
        <input type="text" name="new_username" required>

        <label for="new_password">Password:</label>
        <input type="password" name="new_password" required>

        <button type="submit">Register</button>

        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </form>
</body>
</html>
