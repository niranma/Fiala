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
    <head>
        <style>
            .spacer{
                width: 100%;
                height: 15%;
            }
            .button {
                display: inline-block;
                padding: 15px 25px;
                font-size: 24px;
                cursor: pointer;
                text-align: center;
                text-decoration: none;
                outline: none;
                color: #fff;
                background-color: #4CAF50;
                border: none;
                border-radius: 15px;
                box-shadow: 0 9px #999;
            }       

            .button:hover {
                background-color: gray;
            }
            .button:active {
                background-color: #3e8e41;
                box-shadow: 0 5px #666;
                transform: translateY(4px);
            }
            .button2{
                background-color: darkred;
            }
            .button3{
                background-color: darkred;
            }
            .button4{
                background-color: darkorange;
            }
            .button5{
                background-color: darkgreen;
            }
            .button6{
                background-color: darkred;
            }

            
            .form-style-6 h1{
                background: black;
                padding: 20px 0;
                font-size: 140%;
                font-weight: 300;
                text-align: center;
                color: #fff;
                margin: -16px -16px 16px -16px;
            }
            .form-style-6 h5{
                background: black;
                padding: 20px 0;
                font-size: 140%;
                font-weight: 300;
                text-align: center;
                color: #fff;
                margin: -16px -16px 16px -16px;
            }
            .form-style-6 h6{
                background: black;
                padding: 20px 0;
                font-size: 140%;
                font-weight: 300;
                text-align: center;
                color: #fff;
                margin: -16px -16px 16px -16px;
            }
            .form-style-6 input[type="text"],
            .form-style-6 input[type="date"],
            .form-style-6 input[type="datetime"],
            .form-style-6 input[type="email"],
            .form-style-6 input[type="number"],
            .form-style-6 input[type="search"],
            .form-style-6 input[type="time"],
            .form-style-6 input[type="url"],
            .form-style-6 textarea,
            .form-style-6 select 
            {
                
                outline: none;
                box-sizing: border-box;
               
                width: 100%;
                background: #fff;
                margin-bottom: 4%;
                border: 1px solid #ccc;
                padding: 3%;
                color: #555;
                font: 95% Arial, Helvetica, sans-serif;
            }
        </style>
    </head>
    <body style="background-color: #e7dfdf;">
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
                echo "<h1 style='text-align: lefft; font-size:120%;padding-top: 2%;'>Successful connection to the Database!</h1>";

                echo'
                        <form method="post" style="text-align: center;">
                            <!-- view data button -->
                            <button style="margin-bottom: 50px; font-size: 2vw; height: 3vw;"type="submit" name="view" class="button" >View data </button>  
                            <!-- close data button -->
                            <button style="margin-bottom: 50px; font-size: 2vw; height: 3vw;"type="submit" name="close" class="button button2" >Close data </button> 
                            <!-- logout button -->
                            <button name="logout" style="margin-bottom: 50px; margin-left:30%; font-size: 2vw; height: 3vw;" onclick=""class="button button3">Logout</button>
                        </form>
                    ';
                
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
                        <div><table style='padding-left: 5%; width: 95%;'> 
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
                                    <td style='border: 1px solid black;'>". $row["id"]."</td>
                                    <td style='border: 1px solid black;'>". $row["name"]. "</td>
                                    <td style='border: 1px solid black;'>" . $row["price"]."</td>
                                    <td style='border: 1px solid black;'>". $row["picture"]."</td>
                                    <td style='border: 1px solid black;'>". $row["description"]. "</td>
                                </tr>";
                        }
                        echo "<table></div>";
                        
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
        
        <!-- edit data section       DO NOT CHANGE NAME FIELD IT WILL BREAK THE PHP-->
        <div name="main" style=" font-size: 20px; background-color: #e7dfdf;">
          <div class="form-style-6">
            <form method="post">
                <div style=" text-align: center;">
                     <h1 style="text-align: center;">Edit Existing Data</h1>
                     <h2 style="text-align: center;">You can edit any value except the ID.</h2>
                     <h2 style="text-align: center;">Use the ID to select what item you want to change.</h2>

                        <table style="margin-left: 25%;width: 50%">
                            <tr>
                                <th><p style="display: inline; font-size: 20px">ID: </p></th>
                                <th><input style="margin-right: 8%;" type="number" name="id" placeholder="numbers only"/></th>
                            </tr>

                            <tr>
                                <th><p style="display: inline; font-size: 20px">Name: </p></th>
                                <th><input style="margin-right: 8%;" type="text" name="name" placeholder="characters only "/></th>
                            </tr>
                            
                            <tr>
                                <th><p style="display: inline; font-size: 20px">Price: </p></th>
                                <th><input  style="margin-right: 8%;" type="number" step="0.01" name="price" placeholder="number or decimal only"/></th>
                            </tr>
                            
                            <tr>
                                <th><p style="display: inline; font-size: 20px">Upload Picture (WIP)</p></th>
                                <th><input style="margin-right: 8%;" type="text" name="picture" placeholder="characters only "/></th>
                            </tr>
                            
                            <tr>
                                <th><p style="display: inline; font-size: 20px">Item Description</p></th>
                                <th><input style="margin-right: 8%;" type="text" name="description" placeholder="characters only "/></th>
                            </tr>
                        </table>
                    
                    <br>
                </div>
                <button style="margin-left: 35%;text-align: center; font-size: 2vw; height: 3vw; width: 30%;" type="submit" name="edit" class="button button4" value="Change">Make changes</button>
            </form>
            
            <div class="spacer"></div>
        <!-- add data section       DO NOT CHANGE NAME FIELD IT WILL BREAK THE PHP-->
        <form method="post">
            <div style="text-align: center;">

                <h5>Add new data</h5>
                <h2>Choose a unique ID number and fill in the following fields</h2>
                <table style="margin-left: 25%;width: 50%">
                    <tr>
                        <th><p style="display: inline; font-size: 20px">ID: </p></th>
                        <th><input type="number" name="id" placeholder="numbers only"/></th>
                    </tr>

                    <tr>
                        <th><p style="display: inline;  font-size: 20px">Name: </p></th>
                        <th><input type="text" name="name" placeholder="characters only "/></th>
                    </tr>

                    <tr>
                        <th><p style="display: inline; font-size: 20px">Price: </p></th>
                        <th><input type="number" step="0.01" name="price" placeholder="number or decimal only"/></th>
                    </tr>

                    <tr>
                        <th><p style="display: inline; font-size: 20px">Upload Picture (WIP)</p></th>
                        <th><input type="text" name="picture" placeholder="characters only "/></th>
                    </tr>

                    <tr>
                        <th><p style="display: inline; font-size: 20px">Item Description</p></th>
                        <th><input type="text" name="description" placeholder="characters only "/></th>
                    </tr>

                </table>
                <br>
                <button style="text-align: center; font-size: 2vw; height: 3vw; width: 30%;" type="submit" name="add" class="button button5" value="add">Add Data</button>
            </div>
        </form>

        <div class="spacer"></div>

        <!-- remove data section       DO NOT CHANGE NAME FIELD IT WILL BREAK THE PHP-->
        <form method="post">
            <div style="text-align: center;">

                <h6>Remove Data</h6>
                <h2>To remove an item enter the ID number into the field</h2>
                <table style="margin-left: 25%;width: 50%">
                    <tr>
                        <th><p style="display: inline; font-size: 20px">Item Description</p></th>
                        <th><input style="margin-right: -8%;" type="number" name="id" placeholder="numbers only "/></th>
                    </tr>
                </table>
                <br>
                <button style="text-align: center; font-size: 2vw; height: 3vw; width: 30%;" type="submit" name="remove" class="button button6" value="add">Remove Data</button>
            </div>
        </form>
        </div>
    </body>
</html>
