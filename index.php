<html>
    <head>
       <title>GYM Management</title> 
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        
    </style>
    </head>
    <body>    
        <header>
            <nav class="na">
                <img src="logo.png" class="logo">
                <H1 class="stargym">STAR GYM</H1>
        <div class="hover">
        <ul>
            <li><a class="co" href ="index.php">Home</a></li>
            <li><a class="co" href="personaltraining.html">Personal Training</a></li>
            <li><a class="co" href="carrier.php">Carrier</a></li>
            <li><a class="co" href="membership.html">Membership</a></li>
            <li><a class="co" href="admin.html">Admin Login</a></li>
        </ul>
        </div>
        <div>
            <a href ="login.php" class="login">User Login</a>
        </div>
            </nav>
          
          </header> 
          <div class="bac"> 
          <div class="content">
           <h1>Welcome to STAR GYM</h1><br>
           <h2 style="color:white">Exceeding Your Fitness Expectations </h2>
           <p style="color:white">At STAR GYM, we believe in empowering you to achieve your fitness goals. Whether you’re a beginner or an experienced athlete, we have something for everyone.</p><br>
          <div class="mainpageinfo">
            <h2 style="color:white">JOIN STAR GYM TODAY</h2><br>
            <div class="register">
        <form action="register.php" method="POST">
            <input style= "color: black" type="text" name="name" width="5" height="3" placeholder="Name" required>
            <input style= "color: black" type="email" name="email"  size="20" placeholder="Email" required>
            <input style= "color: black" type="tel" name="phone" placeholder="Phone" required><br>
            <input type="submit" value="Register">
        </form>
        <?php
        session_start();
        if (isset($_SESSION['success_message'])) {
            echo '<p class="success">' . $_SESSION['success_message'] . '</p>';
            unset($_SESSION['success_message']);
        }
        ?>
    </div><br><br>
          </div>
          5 YEARS OF SERVICE
TO THE FITNESS & WELLNESS COMMUNITY.
        </div>
        </div> 
        <div class="mainpg2">
            <div class="mainpginfo">
                <h1>CERTIFIED PERSONAL TRAINERS</h1><BR></BR>
               <h2>Transform Your Fitness Journey with Star Gym</h2><br>
               <p>At Star Gym, we provide personalized training programs to help you achieve your fitness goals. Our certified trainers, state-of-the-art facilities, and customized workout plans cater to all fitness levels.</p><br>
               <center><button><a href="personaltraining.html">BOOK A FREE SESSION</a></button></center>
            <input type="button" required>
               <h2>Our Services</h2><br>
               <ul>
                <li>Personal Training: One-on-one sessions tailored to your goals.</li>
                <li>Group Training: Enjoy motivating and challenging group workouts.</li>
                <li>Online Coaching: Get expert guidance anytime, anywhere.</li>
                <li>Specialized Programs: Targeted training for weight loss, strength, endurance, and more</li>
               </ul>
            </div>
            <div class="mainpgimg">
                <div class="mainpgimg1">
                    <img src="images (2).jfif" alt="">
                </div>
                <div class="mainpgimg2">
                  <img src="images.jfif" alt="">
                </div>
            </div>
        </div>
        <div class="mainpg3whole">
            <div class="mainpg3">
                
                <div class="mainpg3container">
                    <center><h1>EXPERIENCE STAR GYM</h1><br>
                        Experience The Best Group Exercise <br><br><button><a href="personaltraining.html">BOOK A FREE CLASS</a></button></center>
                    <div class="movimg">
                        <div class="movimghol">
                            <div id="img1" class="image">
                                <div class="info">Weight Lifting</div>
                            </div>
                            <div id="img2" class="image">
                                <div class="info">Aerobics</div>
                            </div>
                            <div id="img3" class="image">
                                <div class="info">Zumba</div>
                            </div>
                            <div id="img4" class="image">
                                <div class="info">Yoga</div>
                            </div>
                            <div id="img5" class="image">
                                <div class="info">Cross Fitness</div>
                            </div>
                        </div>
                    </div>
                    <div class="button-holder">
                        <a href="#img1" class="button"></a>
                        <a href="#img2" class="button"></a>
                        <a href="#img3" class="button"></a>
                        <a href="#img4" class="button"></a>
                        <a href="#img5" class="button"></a>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="cont">
                <div class="footer-content">
                    <h3>Contact US</h3>
                    <p>Email:starfit@gmail.com</p>
                    <p>Phone: 9342962402</p>
                    <p>Address: No 4, Valluvar Colony, Reddiyarpatti Road,
                        Thirumal Nagar, Tirunelveli, 
                        Tamil Nadu 627007</p>
                </div>
                <div class="footer-content">
                    <h3>Quick Link</h3>
                    <ul class="footer-list">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="aboutus.html">About US</a></li>
                        <li><a href="membership.html">Members
                            hip</a></li>
                        <li><a href="carrier.php">Careers</a></li>
                        <li><a href="location.html">Location</a></li>
                        
                    </ul>
                </div>
                <div class="footer-content">
                    <h3>Follow US</h3>
                    <ul class="social-icons">
                    <li><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/accounts/login/?hl=en"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>
</html>
