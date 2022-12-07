<html>

    <head>
        <title>About Us!</title>
    </head>

    <body>
    <!-- css sheets -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
<!-- css sheets -->
    <link rel="stylesheet" href="style.css">
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        

   <!-- navigation bar -->
   <header>
      <img class="logo" src="img/FialaLogo.png" width="70" height="50" alt="logo">
      <nav>
        <ul class="nav__links">
          <li><a href="index.html" >Home</a></li>
          <li><a href="food.php" >Order food & drinks</a></li>
          <li><a href="index.html#about_us">About us</a></li>
        </ul>
      </nav>
      <a class="cta" href="mailto:fialabros@gmail.com"><button>Contact</button></a>
    </header>

    <!--ordering food section-->
    <div id="food_section" >
      <div class="order_food">
        <h2 style="padding-top: 3%; background-color: #474e5d">Current Menu!</h2>
      </div>
          <div class="order_drinks">
            <div style="z-index: 0; background-color: #ed#b7b6b6eded; width: 100%; height: 100%; text-align: center;">
              <div style="padding:1.5%"></div>  
              <div class="drink_menu">
                  
                <!-- testing php -->
                <?php
                    $con = mysqli_connect("localhost","root","", "beer");

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
                              if ($row["Picture"] == " " || !$row["Picture"]){
                                $row["Picture"] = "no-image.png";
                              }
                              echo '<div class="row food_item">';
                              echo '    <div class="food_img" style="padding-top: 15;">';
                              echo '      <img src= "img/';
                              echo $row["Picture"];
                              echo '"alt="no img found" style="width:90% ; height:90%;">';
                              echo '      <p style="width: 100%; border:0;  padding-top: 15;   font-size: 20px;">';
                              echo $row["name"]. "<br/>$ ". $row["price"]. '</p>';
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

          <!-- <div class="soicalMedia">
            <h1>Stay up to date with us on our social media </h1>
            <p><a href="https://www.facebook.com/fialabrothers/">Facebook</a></p>
            <p><a href="https://www.instagram.com/fialabros/">Instagram</a></p>
            <p><a href="https://untappd.com/v/fiala-brothers-brewery-beer-hall/11508670">Untapped</a></p>
          </div> -->

 <!--ordering food section-->
        <div id="food_section" style="display: block; align-items: center;justify-content: center; text-align: center; width:100%">
          <div style="width: 49%; display: inline-block;">
          <table>
              <tr>
                <a  href="https://www.toasttab.com/fialabrothers/v3" target="_blank">
                  <h1 style="color: #474e5d; font-size: 4vw;">Order </h1>
                </a>
              </tr>
              <tr>
                <a  href="https://www.toasttab.com/fialabrothers/v3" target="_blank">
                  <img src="img/Toast_logo.png" alt="toast" style="width: 50%">
                </a>
              </tr>
              <tr>
                <a  href="https://www.toasttab.com/fialabrothers/v3" target="_blank">
                  <br><br>
                  <h1 style="color: #474e5d; font-size: 4vw;">food here!</h1>
                </a>
              </tr>
            </table>
          </div>



          <div style="height: 10%"></div>
         
          <div style="height: 10%"></div>
      <div style="width: 80%; margin-left: 10%;">
        <h1 style="text-align:center; font-size: 5vw;">Meet our Team</h1>
      <div style="height: 5%"></div>
        <div class="row">
          <div class="column">
            <div class="card">
              <img src="img/Fialas2.jpg" alt="Mike" style="width:100%" height="45%">
              <div class="container">
                <h2>Doug Fiala</h2>
                <p class="title">CEO & Founder</p>
                <p>I am Doug Fiala and I am the CEO and founder of Fiala Brothers. It has always been my dream to own a bar.</p>
                <a  class="button" href="mailto:Mike@FialaBrothers.com" target="_blank">
                    Contact             
                </a>
              </div>
            </div>
          </div>
          
          <div class="column">
            <div class="card">
              <img src="img/barback.webp" alt="Bob" style="width:100%">
              <div class="container">
                <h2>Bob Ross</h2>
                <p class="title">CFO</p>
                <p>I am the CFO of Fiala Brothers. I manage all the money or whatever a CFO does.</p>
                <a  class="button" href="mailto:Bob@FialaBrothers.com" target="_blank">
                  Contact             
              </a>
              </div>
            </div>
          </div>
          
          <div class="column">
            <div class="card">
              <img src="img/designer.webp" alt="John" style="width:100%">
              <div class="container">
                <h2>Jane Smith</h2>
                <p class="title">Lead Designer</p>
                <p>I have be desinging products for many people and businesses, I have been doing this for 17 years.</p>
                
                <a  class="button" href="mailto:Jane@FialaBrothers.com" target="_blank">
                  Contact             
              </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div style="height: 10%"></div>
      <div style="text-align: center;">
        <a href="tel:309-808-2221" target="_self">(309) 808 2221</a>
        <h1><a href="mailto:fialabros@gmail.com" target="_self">fialabros@gmail.com</a></h1>
        <h1>Hours</h1>
        <h1>Sun 11am-10pm</h1>
        <h1>Mon 5pm-10pm</h1>
        <h1>Tues-Sat 11am-12am</h1>
      
      <!-- Add font awesome icons -->
      <a href="https://www.facebook.com/fialabrothers/" target="_blank" class="fa fa-facebook"></a>
      <a href="https://www.instagram.com/fialabros/" target="_blank" class="fa fa-instagram"></a>

	</div>
    </body>

</html>
