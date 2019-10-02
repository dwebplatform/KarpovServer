<?php
require_once('../includes/dbh.inc.php');

$name=$_GET['name'];
$email=$_GET['email'];
$task=$_GET['task'];


$sql = "INSERT INTO tasks (email, name, taskname)
VALUES ('$email', '$name', '$task')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
