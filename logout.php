<?php
   session_start();

   // remove all session variables
   session_unset();

   // destroy the session
   // session_destroy();
   if(session_destroy())
   {
      header("Location: login.php");
   }
?>