<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "nicole_database"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM form"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<h1>REGISTERED STUDENT</h1>";
    
    echo "<table border='2' class='center'><tr><th>ID</th><th>Name</th><th>Subject Code</th><th>Course Code</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["subcode"]."</td><td>".$row["course_code"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER REGISTRATION</title>
    <style>
        body{
            text-align: center;
        }
        table{
            border-collapse: collapse;
            width: 70%;
            height:50%;
            text-align: center;
        }
        td {
            text-align: center;
        }
        th {
            background-color: beige;
        }
        .center{
            margin-left: auto;
            margin-right: auto;
        }
        a{
            text-decoration:none;
            font-weight: bold;
        }
        nav {
            position: fixed;
            top: 0;
            left: 0;
            height: 70px;
            width: 100%;
            display: flex;
            align-items: center;
            background: #d6a41c;
            justify-content: space-between;
        }
        .reg-log{
	        margin-left: 30px;
        }
    </style>
</head>
    <body>
    <nav>
        <div class="reg-log">
            <a href="form.html">HOME</a>
        </div>
    </nav>
    </body>
</html>