
<?php
if(isset ($_GET["id"])){
   $id = $_GET["id"];

   $servername = "localhost";
   $username = "root";
   $password = "";
   $database = "nicole_database";

 // Create connection
   $connection = new mysqli($servername, $username, $password, $database);

   $sql = "DELETE FROM guidance_records WHERE id=$id";
   $connection->query($sql);

}

header("location: student_list.php");
exit;

?>