
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
$servername = "localhost";
$username ="root";
$password = "";
$database = "nicole_database";

$conn = mysqli_connect($servername,$username,$password,$database);

if (!$conn){
    die("Connection failed:". mysqli_connect_error());
}
$id = $_POST["id"];
$name = $_POST["name"];
$subcode = $_POST["subcode"];
$course_code = $_POST["course_code"];

$sql = "INSERT INTO form(id,name,subcode,course_code) 
VALUES($id,'$name','$subcode','$course_code');";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully!";
}else {
    echo "ERROR:" . $sql . "<br>" . $conn->error;

    }

$sql = "SELECT * FROM form";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>You're Registered!</h1>";
    // Start the table
    echo "<table border='2' class='center'><tr><th>ID</th><th>Name</th><th>Subject code</th><th>Course</th></tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["subcode"]."</td><td>".$row["course_code"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
}
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
    
    </style>
</head>
    <body></body>
</html>
    