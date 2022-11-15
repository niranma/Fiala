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
        $sql = "SELECT id, name, price, picture, description from menu;";
        $result=mysqli_query($con,$sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            echo "
                <table style='padding-left: 5%; width: 95%;'> 
                    <tr style='border: 1px solid black;'>
                        <th style='border: 1px solid black;'>ID</th>
                        <th style='border: 1px solid black;'>Name</th>
                        <th style='border: 1px solid black;'>Price</th>
                        <th style='border: 1px solid black;'>Pciture</th>
                        <th style='border: 1px solid black;'>Description</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {

            echo "
                    <tr style='border: 1px solid black;'>
                        <td style='border: 1px solid black;'>ID: ". $row["id"]."</td>
                        <td style='border: 1px solid black;'>name: ". $row["name"]. "</td>
                        <td style='border: 1px solid black;'>price: " . $row["price"]."</td>
                        <td style='border: 1px solid black;'>picture:". $row["picture"]."</td>
                        <td style='border: 1px solid black;'>Description: ". $row["description"]. "</td>
                    </tr>";
                }
                echo "<table>";
        } else {
            echo "0 results";
        }
        echo "<br><br><br><br>";
    }

    // if view button pressed view the data 
    if(array_key_exists('view', $_POST)) {

    viewData($con);
    }


    // if eddit button clicked
    if(array_key_exists('edit', $_POST)) {

        // i know this is bad, but it works so....
        $sql = "UPDATE menu SET Name = '";
        $sql .= $_POST["name"];
        $sql .= "', price='";
        $sql .= $_POST["price"];
        $sql .= "', picture='";
        $sql .= $_POST["picture"];
        $sql .= "', description='";
        $sql .= $_POST["description"];
        $sql .= "' WHERE id = ";
        $sql .= $_POST["id"];

        // check if connected to the DB
        if ($con->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $con->error;
        }

        // pull and display data from the DB 
        viewData($con);
    }



    // if add button pressed insert the data 
    if(array_key_exists('add', $_POST)) {

        $data = $_POST["id"].",'".$_POST['name']."',".$_POST["price"].",'".$_POST["picture"]."','".$_POST["description"]."'";

        $sql = "INSERT INTO menu (id, name, price, picture, description)
        VALUES (". $data. ")";

        // check if connected to the DB
        if ($con->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $con->error;
        }
        
        // echo the newly added data, this is DEBUG info
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

    // if remove button pressed remove the data based on ID
    if(array_key_exists('remove', $_POST)) {

    $sql = "DELETE FROM `MENU` WHERE `id` = " .$_POST["id"]. ";";

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
    
    <h2>Edit data </h2>
    <h3>you can edit any value except the ID. Use ID to select what row you want to change</h3>
    <p style="display: inline;">id: </p>
    <input type="number" name="id" placeholder="number's only"/>

    <p style="display: inline;">name: </p>
    <input type="text" name="name" placeholder="character's only "/>

    <p style="display: inline;">price: </p>
    <input type="number" step="0.01" name="price" placeholder="number or decimal only"/>
    
    <p style="display: inline;">Picture (file name)</p>
    <input type="text" name="picture" placeholder="character's only "/>

    <p style="display: inline;">item description</p>
    <input type="text" name="description" placeholder="character's only "/>
    
    <input type="submit" name="edit" class="button" value="Change"/>
    <br>
    <br>
    <br>
    <br>
</form>


<form method="post">

    <h2>add new data</h2>
    <p style="display: inline;">id: </p>
    <input type="number" name="id" placeholder="number's only"/>

    <p style="display: inline;">name: </p>
    <input type="text" name="name" placeholder="character's only "/>

    <p style="display: inline;">price: </p>
    <input type="number" step="0.01" name="price" placeholder="number or decimal only"/>
    
    <p style="display: inline;">Picture (file name)</p>
    <input type="text" name="picture" placeholder="character's only "/>

    <p style="display: inline;">item description</p>
    <input type="text" name="description" placeholder="character's only "/>

    <input type="submit" name="add" class="button" value="add"/>
</form>

<form method="post">
    <h2 style="margin-bottom: 50px; margin-top: 100px;">remove data</h2>
    <p style="display: inline;">id: </p>
    <input type="text" name="id" placeholder="number's only"/>    
    <input type="submit" name="remove" class="button" value="remove" />
    </form>

</body>

</html>