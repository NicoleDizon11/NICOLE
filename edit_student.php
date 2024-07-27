<?php
include 'head2.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "nicole_database";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$id = $_GET['id'];

$sql = "SELECT * FROM guidance_records WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Student not found";
    exit;
}

$row = $result->fetch_assoc();

// Handle form submission for updating student information
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Student_number = $_POST["Student_number"];
    $Student_Name = $_POST["Student_Name"];
    $Program = $_POST["Program"];
    $YearSection = $_POST["YearSection"];

    // Update student information in the database
    $updateSql = "UPDATE guidance_records SET Student_number = ?, Student_Name = ?, Program = ?, YearSection = ? WHERE id = ?";
    $updateStmt = $connection->prepare($updateSql);
    $updateStmt->bind_param("isssi", $Student_number, $Student_Name, $Program, $YearSection,$id);
    $updateStmt->execute();

    // Redirect to the student list page after updating
    header("Location: student_list.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 50px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4caf50;
        }

        a {
            display: inline-block;
            background-color: #ddd;
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 3px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Student</h2>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <!-- Add other form fields for editing student information -->
            <label for="Student_number">Student #:</label>
            <input type="text" name="Student_number" autocomplete="off" value="<?php echo $row['Student_number']; ?>">

            <label for="Student_Name">Name:</label>
            <input type="text" name="Student_Name" autocomplete="off" value="<?php echo $row['Student_Name']; ?>">

            <label for="Program">Program:</label>
            <input type="text" name="Program" autocomplete="off" value="<?php echo $row['Program']; ?>">

            <label for="YearSection"> Year & Section:</label>
            <input type="text" name="YearSection" value="<?php echo $row['YearSection']; ?>">


            <!-- Add the submit button and cancel link -->
            <div>
                <button type="submit">Update</button>
                <a href="student_list.php">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
