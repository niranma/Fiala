<html>

<body>
    
<?php
$con = mysqli_connect("localhost","kevin","kevin", "beer");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

echo "Database connected!". "<br><br><br><br>";

if(array_key_exists('view', $_POST)) {

  // button1 has been pressed 
  $sql = "SELECT id, name, price, Picture, description, Link  from menu;";

  $result=mysqli_query($con,$sql);
  
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {

          //   &emsp; is a 4 space escape char
          echo "ID: ". $row["name"] . "&emsp;name: " . $row["price"]. "&emsp;&emsp;price: " .$row["description"].  "<br>";
        }
    } else {
        echo "0 results";
    }
    echo "<br><br><br><br>";
}

else if(array_key_exists('add', $_POST)) {

    $sql = "INSERT INTO beer_names (name, price)
    VALUES ('ad', '82.9')";
    
    if ($con->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }

}


?>

<form method="post">
    <input style="margin-bottom: 50px;"type="submit" name="view" class="button" value="View data" />  

</form>

<form method="post">
    <h2>add new data</h2>
    <p style="display: inline;">id: </p>
    <input type="text" name="yourname"/>

    <p style="display: inline;">name: </p>
    <input type="text" name="yourname"/>

    <p style="display: inline;">price: </p>
    <input type="text" name="yourname"/>
    <input type="submit" name="add" class="button" value="add" />


    <h2 style="margin-bottom: 50px; margin-top: 100px;">remove data</h2>
    <p style="display: inline;">id: </p>
    <input type="text" name="yourname"/>    
    <input type="submit" name="remove" class="button" value="remove" />
    </form>

</body>

</html>