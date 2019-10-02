<?php
include_once('includes/dbh.inc.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/main.css">

    <title>Karpov </title>
</head>
<body> 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Wellcome to the task page</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>
</nav>
   <?php


   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$page=1;

if(isset($_GET['page']))
{
    $totalcountquery="SELECT COUNT(*) as count from tasks";
  
    $numberOfPages=mysqli_query($conn,$totalcountquery) or die('no tasks were found');

     $totalCount= mysqli_fetch_assoc($numberOfPages)['count'] ;
     $limit=ceil($totalCount/3);
      $page=$_GET['page'];
      $from=($page-1)*$limit;
      $sql="SELECT * from tasks LIMIT $from,$limit;";

      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          
          echo "<table class='table'>";
          echo "<tr></tr>";
        echo"<tr>";
         echo" <th scope='col'>id</th>";
         echo" <th scope='col'>email</th>";
         echo" <th scope='col'>name</th>";
         echo" <th scope='col'>task</th>";
         
          
        echo"</tr>";
          while($row = mysqli_fetch_assoc($result)) {
   ?>
              <tr scope='row'>
             <td><?=$row['id'];?></td>
             <td><?=$row['email'];?></td>
             <td><?=$row['name'];?></td>
             <td><?=$row['taskname'];?>
              <?php echo $row['is_changed']? "<p>отредактировано</p>":""; ?> 
             </td>
             
              </tr>  
     <?php
          }
          echo "</table>"; 
      } else {

          echo "0 results";
      }
      
      mysqli_close($conn);     
 
      
    }
else{

    $sql="SELECT * from tasks LIMIT 1;";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "id: " . $row["id"]. " - Name: " . $row["email"]. " " . $row["taskname"]. "<br>";
        }
    } else {
        echo "0 results";
    }
    
    mysqli_close($conn);   
}

?>
<div class="container">
<form id="form_addNewItem">
<div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" 
    
    class="form-control"
    name="email"
    id="newEmail" aria-describedby="emailHelp" placeholder="Enter email">
   </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Имя</label>
    <input type="text" 
    name="username"
    id="newUserName"
    
    class="form-control"   placeholder="Имя">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Задание</label>
    <input name="taskname" 
    id="newTask"
    type="text" class="form-control" 
    
    placeholder="Задача">
  </div>
 
  <button type="submit" id="btn_addNewItem" class="btn btn-primary">Submit</button>
</div>
</form>
</div>
<a  href="?page=1" style="color:<?php echo $page==1?'red':'#000';?>">First Page</a>
<a   href="?page=2" style="color:<?php echo $page==2?'red':'#000';?>"> Second Page</a>
<a  href="?page=3" style="color:<?php echo $page==3?'red':'#000';?>">Third Page</a>

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script>
$(document).ready(function(){

   
    $('#form_addNewItem').on('submit',function(e){
        e.preventDefault();
        let email=$('#newEmail').val();
        let name=$('#newUserName').val();
        let task=$("#newTask").val();
                 //newTasknewUserNamenewEmail
         $.ajax({
            url:'CURL/add.php',
            data:{
                email,
                name,
                task

            },
            success:function(data){
                alert(data);
            }
         })
     })
    $('.redact').keypress(function(event){
    let keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        // alert('You pressed a "enter" key in textbox'); 
       let curId=$(this).attr('currentElId')
       let redactedText= $(this).val();
        $.ajax({
            url:'CURL/update.php',
            data:{ 
                id:curId,
                text:redactedText
            },
            success:function(data){
                alert(data);
            }
        });
    }
});
  $('.deleted_btn').on('click',function(){
    let currentId= $(this).attr('deletedId') ;
    
        $.ajax({
            url:'CURL/delete.php',
            data:{
                id:currentId
            },
            success:function(data){
                alert(data);
            }
        });
  });
 });

</script>
</body>
</html>