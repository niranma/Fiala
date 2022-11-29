<?php
   include("config.php");
   session_start();
   $_SESSION['authenticated'] = false;

   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
      // grab username and password. set authenticated to false
      $myusername = mysqli_real_escape_string($db,md5($_POST['username']));
      $mypassword = mysqli_real_escape_string($db,md5($_POST['password'])); 
      $_SESSION['authenticated'] = false;
    
      // prepare SQL to search for login credientals 
      $sql = "SELECT * FROM admin WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      $error = "";
		
      // If match found log user in and set authenticated to true
      if($count == 1)
      {
         $_SESSION['login_user'] = $myusername;
         $_SESSION['authenticated'] = true;
         $error = "valid";
         header("location: fart.php");
      }else
      {
         $_SESSION['authenticated'] = false;
         echo "<h1 id='error' style='text-align: center; color: red;'>Your Login Name or Password is invalid!</h1>";
      }
   }
?>

<html>   
   <head>
      <title>Login Page</title>
      <style type = "text/css">
         body{
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
   </head>
   
   <body background-color = "#FFFFFF">
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            <div style = "margin:30px">
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
            </div>
         </div>
      </div>
   </body>
</html>