<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'kevin');
   define('DB_PASSWORD', 'kevin');
   define('DB_DATABASE', 'beer');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>