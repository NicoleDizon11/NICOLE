<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "nicole_database";

$connection = new mysqli($servername, $username, $password, $database);


$Student_number = "";
$Student_Name = "";
$Program = "";
$YearSection = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $Student_number = $_POST["Student_number"];
    $Student_Name = $_POST["Student_Name"];
    $Program = $_POST["Program"];
    $YearSection = $_POST["YearSection"];
   // ...

    do {
        if(empty($Student_number) ||empty($Student_Name) || empty($Program) || empty($YearSection)){
            $errorMessage = "All fields are required";
            break;
        }


            $sql = "INSERT INTO guidance_records (Student_number, Student_Name, Program, YearSection) " .
                    "VALUES ('$Student_number', '$Student_Name', '$Program', '$YearSection')";
            $result = $connection->query($sql);



        if(!$result){
            $errorMessage = "Invalid query: " . $connection ->error;
            break;

        }

        $Student_number = "";
        $Student_Name = "";
        $Program = "";
        $YearSection = "";
        $successMessage = "Client added correctly";

        header("location: student_list.php");
        exit;

    } while(false);

    // ...

}



?>
<?php include 'index.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link rel="stylesheet" href="create.css">
    
</head>
<body>
    <div class="container my-5">
        <h2>Student</h2>
       
        <?php
            if (!empty($errorMessage)) {
                echo "               
                <div class='alert alert-warning alert-dismissible fade show' role='alert'> 
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>        
                </div>
                ";
            }    
        ?>
        
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Student Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Student_number" autocomplete="off" value="<?php echo $Student_number;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Student_Name" autocomplete="off" value="<?php echo $Student_Name;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Program</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Program" autocomplete="off" value="<?php echo $Program;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Year & Section</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="YearSection" value="<?php echo $YearSection;?>">
                </div>
            </div>
            

            <?php
            
            if (!empty($successMessage)) {

                echo "
                
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>               
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>    
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>              
                        </div>               
                    </div>               
                </div>
                ";
            }
            ?>

            <div class="row mb-2">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="student_list.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>