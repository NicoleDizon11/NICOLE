<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="head.css">
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA_Copmatible" content="IE-edge"/>
    <meta name="viewport" content="width=device-widt, intial-scale=1.0"/>
    <title>ACCOUNTS RECORD</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "nicole_database";

    $connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query: " . $connection->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
    $connection->close();
    ?>

    <nav>
        <div class="logo">
            <span class="logo-name"><a href="home.php">ACCOUNTS RECORD</a></span>
        </div>

        <div class="reg-log">
            <a><b><?php echo $row['username']; ?></b></a>
            <a href="login.php">Logout</a>
        </div>
        
    </nav>
</body>
</html>
