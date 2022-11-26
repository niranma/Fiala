<?php
    // start session to keep track of who can log in
    session_start();

    // debug helper function
    function debug_to_console($data)
    {
        $output = $data;
        if (is_array($output))
        $output = implode(',', $output);
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
?>

<!-- logs user out after 500 amnt of seconds -->
<meta http-equiv="refresh" content="500;url=logout.php" />

<html>
    <body>
        <?php

            // if user not logged in redirect to logout page  
            if ($_SESSION['authenticated'] == False)
            {
                header("location: logout.php");
            }

            // if user is authenticated
            if (isset($_SESSION['authenticated']) and $_SESSION['authenticated'] == true)
            {
                // Database connection
                $con = mysqli_connect("localhost","kevin","kevin", "beer");

                // Check connection
                if (mysqli_connect_errno()) 
                {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }

                // successful connection to database
                echo "Database connected!". "<br><br><br><br>";

                // function to display database data in a table
                function viewData($con)
                {
                    // prepair SQL and get result
                    $sql = "SELECT id, name, price, picture, description from menu;";
                    $result=mysqli_query($con,$sql);
                    
                    // if result echo data into table
                    if ($result->num_rows > 0 and $_SESSION['authenticated'] == true)
                    {
                        // set up top of the table with names of column
                        echo "
                            <table style='padding-left: 5%; width: 95%;'> 
                                <tr style='border: 1px solid black;'>
                                    <th style='border: 1px solid black;'>ID</th>
                                    <th style='border: 1px solid black;'>Name</th>
                                    <th style='border: 1px solid black;'>Price</th>
                                    <th style='border: 1px solid black;'>Pciture</th>
                                    <th style='border: 1px solid black;'>Description</th>
                                </tr>";

                        // fill table with data 
                        while($row = $result->fetch_assoc()) 
                        {
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
                        
                        //else no results found 
                        } else 
                        {
                            echo "0 results";
                        }

                    // visual break 
                    echo "<br><br><br><br>";
                }

                // if 'view' button pressed and user is authentacted display the data 
                if(array_key_exists('view', $_POST) and $_SESSION['authenticated'] == true)
                {           
                    viewData($con);
                }


                // if edit button clicked and user is authentacted
                if(array_key_exists('edit', $_POST) and $_SESSION['authenticated'] == true) {
                    
                    // prepare the SQL string  
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

                    // check if connected to the DB and user is authenticated 
                    if ($con->query($sql) === TRUE and $_SESSION['authenticated'] == true)
                    {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $con->error;
                        echo "contact support";
                    }

                    // display data even if on error to show user what really happened 
                    viewData($con);
                }

                // if add button pressed and user authenticated insert the data 
                if(array_key_exists('add', $_POST) and $_SESSION['authenticated'] == true) {

                    // prepare the SQL for adding data
                    $data = $_POST["id"].",'".$_POST['name']."',".$_POST["price"].",'".$_POST["picture"]."','".$_POST["description"]."'";
                    $sql = "INSERT INTO menu (id, name, price, picture, description)
                    VALUES (". $data. ")";

                    // check if connected to the DB
                    if ($con->query($sql) === TRUE and $_SESSION['authenticated'] == true)
                    {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $con->error;
                        echo "contact support";
                    }
                    
                    // show data even on error to show user what the DB looks like
                    viewData($con);
                }

                // if remove button pressed and user isauthenticated, remove the data based on ID
                if(array_key_exists('remove', $_POST) and $_SESSION['authenticated'] == true)
                {

                    // prepare SQL to remove based on ID
                    $sql = "DELETE FROM `MENU` WHERE `id` = " .$_POST["id"]. ";";

                    // if result found and user is authenticated remove data
                    if ($result=mysqli_query($con,$sql) === TRUE and $_SESSION['authenticated'] == true)
                    {
                        echo "removed Item       ID: ".$_POST["id"];
                        echo "<br><br><br>";
                    } else 
                    {
                        echo "Error: " . $sql . "<br>" . $con->error;
                        echo "contact support";
                    }

                    // show data even on error to show user what the DB looks like
                    viewData($con);
                }

                // logout button clicked. redirect to logout page 
                if (array_key_exists('logout', $_POST))
                {
                    header("location: logout.php");
                    die();
                }
            } 
        ?>

        <form method="post">
        
            <!-- view data button -->
            <input style="margin-bottom: 50px;"type="submit" name="view" class="button" value="View data" />  
            
            <!-- logout button -->
            <button name="logout" style="align: right;" onclick="">logout</button>
        </form>

        
        <!-- edit data section       DO NOT CHANGE NAME FIELD IT WILL BREAK THE PHP-->
        <form method="post">
            <h2>Edit data </h2>
            <h3>you can edit any value except the ID. Use ID to select what row you want to change</h3>
            <p style="display: inline;">id: </p>
            <input type="number" name="id" placeholder="number's only"/>

            <p style="display: inline;">name: </p>
            <input type="text" name="name" placeholder="character's only "/>

            <p style="display: inline;">price: </p>
            <input type="number" step="0.01" name="price" placeholder="number or decimal only"/>
            
            <p style="display: inline;">upload Picture (WIP)</p>
            <input type="text" name="picture" placeholder="character's only "/>

            <p style="display: inline;">item description</p>
            <input type="text" name="description" placeholder="character's only "/>
            
            <input type="submit" name="edit" class="button" value="Change"/>
            <br><br><br><br>
        </form>

        <!-- add data section       DO NOT CHANGE NAME FIELD IT WILL BREAK THE PHP-->
        <form method="post">
            <h2>add new data</h2>
            <p style="display: inline;">id: </p>
            <input type="number" name="id" placeholder="number's only"/>

            <p style="display: inline;">name: </p>
            <input type="text" name="name" placeholder="character's only "/>

            <p style="display: inline;">price: </p>
            <input type="number" step="0.01" name="price" placeholder="number or decimal only"/>
            
            <p style="display: inline;">upload Picture (WIP)</p>
            <input type="text" name="picture" placeholder="character's only "/>

            <p style="display: inline;">item description</p>
            <input type="text" name="description" placeholder="character's only "/>

            <input type="submit" name="add" class="button" value="add"/>
        </form>

        <!-- remove data section       DO NOT CHANGE NAME FIELD IT WILL BREAK THE PHP-->
        <form method="post">
            <h2 style="margin-bottom: 50px; margin-top: 100px;">remove data</h2>
            <p style="display: inline;">id: </p>
            <input type="text" name="id" placeholder="number's only"/>    
            <input type="submit" name="remove" class="button" value="remove" />
        </form>
        
    </body>
</html>