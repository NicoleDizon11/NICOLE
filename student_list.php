<?php include 'head2.php'?>
<link rel="stylesheet" type="text/css" href="tableStudent.css">
<div class="page-content">
    <div class="titles">
        <h2>Students Accounts List</h2>
    </div>
    <div id="STUDENT" class="tabcontent">
        <div class="student_list">
            <div class="row">
                <div class="col-md-12">
                    <div class="container_my-5">
                        <br>
                        <div class="search-container">
                            <form method="get" action="" id="searchForm" class="formsearch">
                                <label for="search">Search:</label>
                                <input type="text" id="search" name="search" placeholder="Enter student name, number, or year">
                            </form>
                            <a class="btn add" href="create.php" role="button">+ Add Student</a>
                        </div>
                            
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Student Number</th>
                                    <th>Student Name</th>
                                    <th>Program</th>
                                    <th>Year & Section</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
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

                                // Check if the search form is submitted
                                if (isset($_GET['search'])) {
                                    $search = $_GET['search'];

                                    // Use a prepared statement to prevent SQL injection
                                    $stmt = $connection->prepare("SELECT * FROM guidance_records
                                                                    WHERE Student_number LIKE ?
                                                                    OR Student_Name  LIKE ?
                                                                    OR Program LIKE ?
                                                                    OR YearSection LIKE ?
                                                                     ");
                                    $searchParam = "%$search%"; // Adding % for partial matching
                                    $stmt->bind_param("ssss", $searchParam, $searchParam, $searchParam, $searchParam);

                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    // Output the search results
                                    while ($row = $result->fetch_assoc()) {
                                        echo "
                                        <tr>
                                            <td>{$row['Student_number']}</td>
                                            <td>{$row['Student_Name']}</td>
                                            <td>{$row['Program']}</td>
                                            <td>{$row['YearSection']}</td>
                                            
                                            <td>
                                                <a class='btn btn-primary btn-sm' href='edit.php?id={$row['id']}'>Edit</i></a>
                                                <a class='btn btn-primary btn-sm' href='delete.php?id={$row['id']}'>Delete</a>
                                            </td>
                                        </tr>
                                        ";
                                    }

                                    $stmt->close();
                                } else {
                                    // read all rows from the database table
                                    $sql = "SELECT * FROM guidance_records";
                                    $result = $connection->query($sql);

                                    if (!$result) {
                                        die("Invalid query: " . $connection->error);
                                    }

                                    // read data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "
                                        <tr>
                                            <td>{$row['Student_number']}</td>
                                            <td>{$row['Student_Name']}</td>
                                            <td>{$row['Program']}</td>
                                            <td>{$row['YearSection']}</td>
                                            
                                            <td>
                                                <a class='btn btn-primary btn-sm' href='edit_student.php?id={$row['id']}'><i class='bx bxs-edit-alt' ></i></a>
                                                <a class='btn btn-primary btn-sm' href='delete.php?id={$row['id']}'><i class='bx bx-trash'></i></a>
                                            </td>
                                        </tr>
                                        ";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add a script to automatically submit the form when the user types in the search field or presses Enter
    var searchInput = document.getElementById('search');
    var searchForm = document.getElementById('searchForm');

    searchInput.addEventListener('input', function(event) {
        // Check if the key pressed is Enter (key code 13)
        if (event.key === 'Enter') {
            searchForm.submit();
        }
    });
</script>


