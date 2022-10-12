<html>

    <head>
        <title>About Us!</title>
    </head>

    <body>
    <!-- css sheets -->
    <link rel="stylesheet" href="style.css">
        
    <!-- navigation bar -->
      <div class="topnav">
        <a href="#main_section" >Home</a>
        <a href="#food_section" >Order food & drinks</a>
        <a href="#about_us">About us</a>
      </div>

    <!--ordering food section-->
    <div id="food_section">
      <div class="order_food">
        <h2>our menu!</h2>
      </div>
          <div class="order_drinks">
            <div style="z-index: 0; background-color: #ededed; width: 100%; height: 100%; text-align: center;">
              <div style="padding:1.5%"></div>  
              <div class="drink_menu">
                  
                <!-- testing php -->
                <?php
                    $con = mysqli_connect("localhost","kevin","kevin", "beer");

                    // Check connection
                    if (mysqli_connect_errno()) {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      exit();
                    }

                    // echo "Database connected!". "<br><br><br><br>";

                      // button1 has been pressed 
                      $sql = "SELECT id, name, price, Picture, description, Link  from menu;";
                      $result=mysqli_query($con,$sql);
                      
                      if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                              // echo $row['picture'];
                              //   &emsp; is a 4 space escape char
                              echo '<div class="row food_item">';
                              echo '    <div class="food_img" style="padding-top: 15;">';
                              echo '      <img src= "';
                              echo $row["Picture"];
                              echo '"alt="no img found" style="width:90% ; height:90%;">';
                              echo '      <p style="width: 100%; border:0;  padding-top: 15;   font-size: 20px;">';
                              echo $row["name"]. "<br/>$ ". $row["price"]. '</p>';

                              // echo '      <p style="width: 100%; border:0;font-size: 20px;">';
                              // echo $row["price"].'</p>';

                              echo ' <p>' .$row["description"].'</p>';
                              echo '    </div>';
                              echo '</div>';
                              
                            }
                        } else
                        {
                          echo "<h1>more coming soon!</h1>";
                        }
                        echo "<br><br><br><br>";
                    
                  ?>
              </div>
            </div>
        </div>
      </div>

          <h1>social media links?</h1>

      <h2 style="text-align:center">Our Team</h2>
      <div class="row">
        <div class="column">
          <div class="card">
            <img src="Fialas2.jpg" alt="Jane" style="width:100%">
            <div class="container">
              <h2>Jane Doe</h2>
              <p class="title">CEO & Founder</p>
              <p>Some text that describes me lorem ipsum ipsum lorem.</p>
              <p>jane@example.com</p>
              <p><button class="button">Contact</button></p>
            </div>
          </div>
        </div>
      
        <div class="column">
          <div class="card">
            <img src="Fialas3.jpg" alt="Mike" style="width:100%">
            <div class="container">
              <h2>Bob Ross</h2>
              <p class="title">Art Director</p>
              <p>Some text that describes me lorem ipsum ipsum lorem.</p>
              <p>mike@example.com</p>
              <p><button class="button">Contact</button></p>
            </div>
          </div>
        </div>
      
        <div class="column">
          <div class="card">
            <img src="Fialas4.jpg" alt="John" style="width:100%">
            <div class="container">
              <h2>John Doe</h2>
              <p class="title">Designer</p>
              <p>Some text that describes me lorem ipsum ipsum lorem.</p>
              <p>john@example.com</p>
              <p><button class="button">Contact</button></p>
            </div>
          </div>
        </div>
      </div>
    </body>

</html>