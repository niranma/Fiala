<?php
   ini_set ('error_reporting', E_ALL); ini_set ('display_errors', 1); ini_set ('display_startup_errors', 1);

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
    $img_path = "nulls";
            function check_img(){
                $target_dir = "img/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                $img_path = basename($_FILES["fileToUpload"]["name"]);

                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                    }
                }
                    
                // // Check if file already exists
                // if (file_exists($target_file)) {
                //     echo "<h1 style='text-align: center; font-size: 100px;'>Sorry, file already exists. Please try again with a new name</h1>";
                //     $uploadOk = 0;
                // }
                
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000)  {
                    echo "<h1 style='text-align: center; font-size: 100px;'>Sorry, file is to big. Please again with samller file.</h1>";
                    $uploadOk = 0;
                }
                
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "") {
                    echo "<h1 style='text-align: center; font-size: 100px;'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h1>";
                    $uploadOk = 0;
                }
                
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0 ) {
                    echo "<h1 style='text-align: center; font-size: 100px;'>Sorry, your file was not uploaded.</h1>";
                    return(-1);

                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $img_path =  htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
                    } else {
                        if (isset($_POST["submit"])){
                            echo "<h1 style='text-align: center; font-size: 100px;'>Sorry, there was an error uploading your file.</h1>";
                        }
                    }
                }
                return($img_path);
            }
            



            function check_imgADD(){
                $target_dir = "img/";
                $target_file = $target_dir . basename($_FILES["fileToUploadADD"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                $img_path = basename($_FILES["fileToUploadADD"]["name"]);

                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUploadADD"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                    }
                }
                    
                // // Check if file already exists
                // if (file_exists($target_file)) {
                //     echo "<h1 style='text-align: center; font-size: 100px;'>Sorry, file already exists. Please try again with a new name</h1>";
                //     $uploadOk = 0;
                // }
                
                // Check file size
                if ($_FILES["fileToUploadADD"]["size"] > 500000)  {
                    echo "<h1 style='text-align: center; font-size: 100px;'>Sorry, file is to big. Please again with samller file.</h1>";
                    $uploadOk = 0;
                }
                
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                    echo "<h1 style='text-align: center; font-size: 100px;'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h1>";
                    $uploadOk = 0;
                }
                
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0 ) {
                    echo "<h1 style='text-align: center; font-size: 100px;'>Sorry, your file was not uploaded.</h1>";
                    return(-1);

                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUploadADD"]["tmp_name"], $target_file)) {
                        $img_path =  htmlspecialchars( basename( $_FILES["fileToUploadADD"]["name"]));
                    } else {
                        if (isset($_POST["submit"])){
                            echo "<h1 style='text-align: center; font-size: 100px;'>Sorry, there was an error uploading your file.</h1>";
                        }
                    }
                }
                return($img_path);
            }



            
            // if user not logged in redirect to logout page  
            if ($_SESSION['authenticated'] == False)
            {
                header("location: logout.php");
            }
            
            // if user is authenticated
            if (isset($_SESSION['authenticated']) and $_SESSION['authenticated'] == true)
            {
                // Database connection
                $con = mysqli_connect("localhost","root","", "beer");
                
                // Check connection
                if (mysqli_connect_errno()) 
                {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }
                
                // successful connection to database
                echo "<h1 style='text-align: center; font-size:40px;padding-top: 2%;'>Successful connection to the Database!</h1>";
                echo "<br><br><br><br>";

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
                    $img_path = check_img();

                    if ($img_path == -1){
                        $img_path = "no-image.png";
                    }

                    // if name field does not exist. aka empty/ null1
                    if (! $_POST["name"]){
                        $_POST["name"] = " ";
                    }

                    // if name field does not exist. aka empty/ null1
                    if (! $_POST["price"]){
                        $_POST["price"] = " ";
                    }

                    // if name field does not exist. aka empty/ null1
                    if (! $_POST["description"]){
                        $_POST["description"] = " ";
                    }

                                                            // if name field does not exist. aka empty/ null1
                    if (! $_POST["id"]){
                        echo "<h1 style='text-align: center; font-size: 100px;'>Error: No ID supplied. Try again.</h1>";
                    } else{

                        $sql = "UPDATE menu SET Name = '";
                        $sql .= $_POST["name"];
                        $sql .= "', price='";
                        $sql .= $_POST["price"];
                        $sql .= "', picture='";
                        $sql .= $img_path;
                        $sql .= "', description='";
                        $sql .= $_POST["description"];
                        $sql .= "' WHERE id = ";
                        $sql .= $_POST["id"];
    
    
                        // check if connected to the DB and user is authenticated 
                        if ($con->query($sql) === TRUE and $_SESSION['authenticated'] == true)
                        {
                            echo "<h1 style='text-align: center; font-size: 100px;'>Record edit was successful</h1>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $con->error;
                            echo "contact support";
                        }
                    }

                    // display data even if on error to show user what really happened 
                    viewData($con);
                }

                // if add button pressed and user authenticated insert the data 
                if(array_key_exists('add', $_POST) and $_SESSION['authenticated'] == true) {

                    // prepare the SQL for adding data
                    $img_path = check_img();

                    $data = $_POST["id"].",'".$_POST['name']."',".$_POST['name'].",'".$img_path."','".$_POST["description"]."'";
                    $sql = "INSERT INTO menu (id, name, price, picture, description)
                    VALUES (". $data. ")";

                    if (!$_POST["id"] || !$_POST['name'] || !$_POST['name'] || !$_POST["description"] || $img_path == -1){
                        echo "<h1 style='text-align: center; font-size: 100px;'>Error: Some or all fields not filled in.</h1>";
                    }else {
                        // check if connected to the DB
                        if ($_SESSION['authenticated'] === true)
                        { 
                            try{
                                $result = $con->query($sql);
                                echo "<h1 style='text-align: center; font-size: 100px;'>New record created successfully</h1>";
                            } catch (Exception $e){
                                if(mysqli_errno($con) == 1062){
                                    echo "<h1 style='text-align: center; font-size: 100px;'>Error: Duplicate ID.</h1>";
                                }else{
                                     echo "<h1 style='text-align: center; font-size: 100px;'>";
                                     echo "Error: " . $sql . "<br>" . $con->error;
                                     echo "contact support";
                                     echo "</h1>";
                                 }
                            }
                        }
                    }
                    
                    // show data even on error to show user what the DB looks like
                    viewData($con);
                }

                // if remove button pressed and user isauthenticated, remove the data based on ID
                if(array_key_exists('remove', $_POST) and $_SESSION['authenticated'] == true)
                {

                    if (!$_POST["id"]){
                        echo "<h1 style='text-align: center; font-size: 100px;'>Error: No ID provided.</h1>";
                    } else{
                        // prepare SQL to remove based on ID
                        $sql = "DELETE FROM `menu` WHERE `id` = " .$_POST["id"]. ";";
    
                        // if result found and user is authenticated remove data
                        if ($result=mysqli_query($con,$sql) === TRUE and $_SESSION['authenticated'] == true)
                        {
                            echo "<h1 style='text-align: center; font-size: 100px;'>removed Item       ID: ".$_POST["id"]. "</h1>";
                            echo "<br><br><br>";
                        } else 
                        {
                            echo "<h1 style='text-align: center; font-size: 100px;'>";
                            echo "Error: " . $sql . "<br>" . $con->error;
                            echo "contact support";
                            echo "</h1>";
                        }
                    }


                    // show data even on error to show user what the DB looks like
                    viewData($con);
                }

                // logout button clicked. redirect to logout page 
                if (array_key_exists('logout', $_POST))
                {
                    // errors for some reason
                    header("location: logout.php");
                    // the echo fixes the error and loggs user out
                    echo "<script type='text/javascript'>window.top.location='logout.php';</script>"; exit;

                    exit;
                }
            } 
        ?>
        <!-- edit data section       DO NOT CHANGE NAME FIELD IT WILL BREAK THE PHP-->
        <div name="main" style=" font-size: 20px; background-color: #e7dfdf;">
          <div class="form-style-6">
            <form method="post" enctype="multipart/form-data">
                <div style=" text-align: center;">
                     <h1 style="text-align: center;  font-size: 52px;">Edit Existing Data</h1>
                     <h2 style="text-align: center; font-size: 40px;">You can edit any value except the ID.</h2>
                     <h2 style="text-align: center;  font-size: 40px;">Use the ID to select what item you want to change.</h2>

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
                                <th><p style="display: inline; font-size: 20px">Upload Picture</p></th>
                                <th><input style="margin-right: 8%;" type="file" name="fileToUpload" id="fileToUpload" placeholder="characters only "/></th>
                            </tr>
                            
                            <tr>
                                <th><p style="display: inline; font-size: 20px">Item Description</p></th>
                                <th><input style="margin-right: 8%;" type="text" name="description" placeholder="characters only "/></th>
                            </tr>
                        </table>
                    
                    <br>
                </div>
                <button style="margin-left: 35%;text-align: center; font-size: 2vw; height: 3vw; width: 30%;" type="submit" name="edit" name="submit" class="button button4" value="Change">Make changes</button>
            </form>
            
            <div class="spacer"></div>
        <!-- add data section       DO NOT CHANGE NAME FIELD IT WILL BREAK THE PHP-->
        <form method="post" enctype="multipart/form-data">
            <div style="text-align: center;">

                <h1 style="text-align: center;  font-size: 52px;">Add new data</h1>
                <h2 style="text-align: center;  font-size: 40px;">Choose a unique ID number and fill in the following fields</h2>
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
                    <th>
                        <p style="display: inline; font-size: 20px">Upload Picture (WIP)</p></th>
                        <th><input style="margin-right: 8%;" type="file" name="fileToUpload" id="fileToUpload" placeholder="characters only "/></th>
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
        <form method="post" >
            <div style="text-align: center;">

                <h1 style="text-align: center;  font-size: 52px;">Remove Data</h1>
                <h2 style="text-align: center;  font-size: 40px;">To remove an item enter the ID number into the field</h2>
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
