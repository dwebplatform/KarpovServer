<?php

session_start();
if(!$_SESSION['admin']){
    header("Location: enter.php");
    exit;
   }

    
?>
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

   <?php


   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$page=1;

  
    $totalcountquery="SELECT COUNT(*) as count from tasks";
  
    $numberOfPages=mysqli_query($conn,$totalcountquery) or die('no tasks were found');

     $totalCount= mysqli_fetch_assoc($numberOfPages)['count'] ;
       
      $sql="SELECT * from tasks ;";

      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          
          echo "<table class='table'>";
          echo "<tr></tr>";
        echo"<tr>";
         echo" <th scope='col'>id</th>";
         echo" <th scope='col'>email</th>";
         echo" <th scope='col'>name</th>";
         echo" <th scope='col'>task</th>";
         
         echo" <th scope='col'>редактировать</th>";
        
         echo" <th scope='col'>&nbsp;</th>";
        echo"</tr>";
          while($row = mysqli_fetch_assoc($result)) {
   ?>
              <tr scope='row'>
             <td><?=$row['id'];?></td>
             <td><?=$row['email'];?></td>
             <td><?=$row['name'];?></td>
             <td><?=$row['taskname'];?>
            
             </td>
              <td >
                <form action="http://localhost/KarpovServer/CURL/update.php" 
                    
                    updatedId="<?php echo $row['id'];?>" class="redact">  
                      <input
                      style="display:none;"
                      value="<?php echo $row['id'];?>"
                      name="id"
                      type="text"
                      />
                    <input name="updatedtext" currentElId="<?=$row['id']?>"  type="text"/>
                <input type="submit" value="Изменить"/>
            </form>
              </td>
             <td><span class="deleted_btn" deletedId="<?php echo $row['id'];?>"   >X</span></td>
             </tr>  
     <?php
          }
          echo "</table>"; 
      } else {

          echo "0 results";
      }
      
      mysqli_close($conn);     
 
      
     
 
?>

<form>
</form>
 
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script>
$(document).ready(function(){

});
     
//   $('.deleted_btn').on('click',function(){
//     let currentId= $(this).attr('deletedId') ;
    
//         $.ajax({
//             url:'CURL/delete.php',
//             data:{
//                 id:currentId
//             },
//             success:function(data){
//                 alert(data);
//             }
//         });
//   });
//  });

</script>
</body>
</html>