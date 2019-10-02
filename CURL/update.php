<?php

require_once('../includes/dbh.inc.php');

 if(isset($_GET['id']))
{
 
 $id=$_GET['id']; 
 $task=$_GET['updatedtext']; 
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
   }

 $sql = "UPDATE tasks SET is_changed='1', taskname='$task' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close(); 
}

 