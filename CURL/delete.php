<?php


require_once('../includes/dbh.inc.php');

if(isset($_GET['id']))
{
 
$deletedId=$_GET['id'];  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM tasks WHERE id=$deletedId";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close(); 
}

var_dump($_GET['id']);