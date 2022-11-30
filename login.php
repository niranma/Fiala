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
         header("location: admin.php");
      }else
      {
         $_SESSION['authenticated'] = false;
         echo "<h1 id='error' style='position:absolute;vertical-align: text-top; top:10%;color: red;'>Your Login Name or Password is invalid!</h1>";
      }
   }
?>

<html>   
   <head>
      <title>Login Page</title>
      <style type = "text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap');

input {
  caret-color: darkblue;
}

body {
  margin: 0;
  width: 100vw;
  height: 100vh;
  background: #ecf0f3;
  display: flex;
  align-items: center;
  text-align: center;
  justify-content: center;
  place-items: center;
  overflow: hidden;
  font-family: poppins;
  background-color: gray;
}

.container {
  position: relative;
  width: 350px;
  height: 500px;
  border-radius: 20px;
  padding: 40px;
  box-sizing: border-box;
  background: #ecf0f3;
  box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
}



.inputs {
  text-align: left;
  margin-top: 30px;
}

label, input, button {
  display: block;
  width: 100%;
  padding: 0;
  border: none;
  outline: none;
  box-sizing: border-box;
}

label {
  margin-bottom: 4px;
}

label:nth-of-type(2) {
  margin-top: 12px;
}

input::placeholder {
  color: gray;
}

input {
  background: #ecf0f3;
  padding: 10px;
  padding-left: 20px;
  height: 50px;
  font-size: 14px;
  border-radius: 50px;
  box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
}

button {
  color: white;
  margin-top: 20px;
  background: darkblue;
  height: 40px;
  border-radius: 20px;
  cursor: pointer;
  font-weight: 900;
  box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px white;
  transition: 0.5s;
}

button:hover {
  box-shadow: none;
}

a {
  position: absolute;
  font-size: 8px;
  bottom: 4px;
  right: 4px;
  text-decoration: none;
  color: black;
  background: yellow;
  border-radius: 10px;
  padding: 2px;
}

h1 {
 text-align: center;
}
      </style>
   </head>
   
   
<form action = "" method = "post">
  <h1>Admin Portal Login</h1>
  <div class="form-input-material">
   
    <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  
  </div>
  <div class="form-input-material">
    
    <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
  </div>
  <button type="submit" value="submit" class="btn btn-primary btn-ghost">Login</button>
</form>
</html>
