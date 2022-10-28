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


function viewData($con){
    $sql = "SELECT id, name, price from menu;";
    $result=mysqli_query($con,$sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
  
            //   &emsp; is a 4 space escape char
            echo "ID: ". $row["id"] . "&emsp;name: " . $row["name"]. "&emsp;&emsp;price: " .$row["price"]. "<br>";
          }
      } else {
          echo "0 results";
      }
      echo "<br><br><br><br>";
}

if(array_key_exists('view', $_POST)) {

  // button1 has been pressed 
  viewData($con);
}

if(array_key_exists('add', $_POST)) {

    $data = $_POST["id"].",'".$_POST['name']."',".$_POST["price"];

    echo $data;

    $sql = "INSERT INTO menu (id, name,price)
    VALUES (". $data. ")";

    echo $sql;

    if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
    
    if (isset($_POST["add"])) {
        echo "<div> <h2>added data: </h2><h3>";
        echo "ID: ";
        echo $_POST["id"];
        echo "<br>";
        echo "Name: ";
        echo $_POST["name"];
        echo "<br>";
        echo "Price: ";
        echo $_POST["price"];
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "</h3></div>";
    }
    viewData($con);

}

if(array_key_exists('remove', $_POST)) {

   // button1 has been pressed 
  $sql = "DELETE FROM `MENU` WHERE `id` = " .$_POST["id"]. ";";
//   $result=mysqli_query($con,$sql);

  if ($result=mysqli_query($con,$sql) === TRUE) {
    echo "removed Item       ID: ".$_POST["id"];
    echo "<br><br><br>";
    viewData($con);
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
    <input type="number" name="id" placeholder="number's only"/>

    <p style="display: inline;">name: </p>
    <input type="text" name="name" placeholder="character's only "/>

    <p style="display: inline;">price: </p>
    <input type="number" step="0.01" name="price" placeholder="number or decimal only"/>
    <input type="submit" name="add" class="button" value="add"/>
</form>

<form method="post">
    <h2 style="margin-bottom: 50px; margin-top: 100px;">remove data</h2>
    <p style="display: inline;">id: </p>
    <input type="text" name="id"/>    
    <input type="submit" name="remove" class="button" value="remove" />
    </form>

</body>

</html>