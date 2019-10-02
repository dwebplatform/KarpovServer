<?php
session_start();
 
$admin = 'admin';
$pass = '123';
 
if($_POST['submit']){
 if($admin == $_POST['user'] AND  $_POST['pass'] =='123'){
 $_SESSION['admin'] = $admin;
 header("Location: admin.php");
 exit;
 }else echo '<p>Логин или пароль неверны!</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/main.css">

    <title>Document</title>
</head>
<body>

 
Это страница авторизации.
<br />
<form method="post">
 <label for="user">Логин:</label><input id='user' type="text"
 
 name="user" /><br />
 <label for="user">Пароль:</label> <input type="password"
 id="pass"
 name="pass" /><br />
 <button type="submit" id="submit" class="btn btn-primary" name="submit" value="Войти" >Войти</button>
</form>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $('#submit').on('click',
    function(e){
   
        let login=$('#user').val();
        let pass=$('#pass').val();
         if(pass!=='123'||login!=='admin') {
            e.preventDefault();

        
   if(pass!=='123'){

    $('#pass').css('border','1px solid red');
   }
   if(login!=='admin') {
 $('#user').css('border','1px solid red');
        }
        }
       
         
    })
 })
</script>

</body>
</html>

