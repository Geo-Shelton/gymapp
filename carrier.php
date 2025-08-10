<html>
    <head>
       <title>Carrier</title> 
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        
.aboutus{
    margin: 5px;
    padding: 10px;
    }
.first-aboutus{
    font-size: 20px;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    font-weight: bolder;
    color: #ffffff;
    background: url(boy.jpg) no-repeat center center/cover;
    width: 100%;
    height: 300px;
    text-align: center;
    padding: 3em 0 2em 0;
    }
.ad{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    margin-top: 0px;
    padding: 20px;
}
.content-aboutus{
    width: 90%;
    padding: 30px;
    margin-left: 5px;
    color: black;
}
.ad p,b,h1,h4{
    color: black;
    font-size: 17px;

}

.right-container{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-evenly;
    
}
.map h3{
    color: black;
}
.map{
    margin-top: 60px;
    justify-content: center;
}



.form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 8cm;
            height: 13cm;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
            color: black;
                }
        .form-container h1 {
            margin-bottom: 15px;
            color: #333;
            font-size: 1.2em;
            text-align: center;
        }
        .form-row {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin-bottom: 10px;
            color: black;
        }
        .form-row input[type="text"], 
        .form-row input[type="number"], 
        .form-row select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            color: black;
        }
        .form-row input[type="radio"] {
            margin: 0 5px;
            color: black;
        }
        .form-row .radio-group {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            color: black;
        }
        .form-row .radio-group label {
            margin-right: 10px;
            color: black;
        }
        .form-row .option-list {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: black;
        }
        .form-row option{
            color: black;
        }
        .form-row .option-list label {
            margin: 5px 0;
            color: black;
        }
        .form-container .message {
            margin-top: 15px;
            color: green;
            text-align: center;
            color: black;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function handleSubmit(event) {
            event.preventDefault(); // Prevent the default form submission

            var form = event.target;
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "process_registration.php", true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('message').innerText = "Registration successful!";
                    form.reset(); // Clear the form fields
                } else {
                    document.getElementById('message').innerText = "Error occurred. Please try again.";
                }
            };
            xhr.send(formData);
        }
    </script>
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
            <li><a class="co" href="membership.html">membership</a></li>
            <li><a class="co" href="admin.html">Admin Login</a></li>
        </ul>
        </div>
        <div>
            <a href ="login.php" class="login">User Login</a>
        </div>
            </nav>
          </header>
          <div class="aboutus">
          <div class="first-aboutus">
          <h1 style="color: white;font-size:30px;">Careers at Star Gym</h1><br>
          <h4 style="color: white;font-size:20px;">Embark on an exciting fitness career at Star Gym in Tirunelveli.<br>
           Experience a culture of growth and excellence in a supportive,<br>
            dynamic team environment.</h4>
          </div>
    
          <div class="ad">
            <div class="content-aboutus">
              <b>
                <h1 style="font-size: 25px;color: #810400;">Join the Star Gym Team – Where Fitness and Career Goals Align</h1>
              </b>
              <br>
              <h4>Discover Your Path at Mumbai’s Premier Fitness Destination</h4> 
        <br>
        <p>At Star Gym, we’re not just about fitness; we’re about fostering careers. Located in the vibrant heart of Mumbai, Andheri West, our 10,000 Sq Ft facility is more than a gym – it’s a launchpad for professional growth in the fitness industry.</p><br>
        <p><b>Why Star Gym?</b></p> <br>
        <ul>
        <li><p><b>Culture of Growth:</b>We thrive on openness, learning, and empowerment. Here, you’re not just an employee; you’re an integral part of a team dedicated to excellence.</p></li> 
        <li><p><b>Dedication to Fitness:</b>As one of Mumbai’s most respected fitness destinations, we’re committed to making our city fitter and stronger.</p></li>
        <li><p><b>Continuous Learning:</b> We invest in our team. From exercise instructors to front-of-house staff, we ensure everyone is equipped with the latest international certifications and training.</p></li>
        <li><p><b>Inclusivity and Perseverance: </b> We champion these values, encouraging our team to push boundaries and excel in their roles.</p></li>
        <li><p><b>Supportive Work Environment:</b> Our management’s open-door policy means your ideas are heard, valued, and often implemented, reflecting our core values of hard work, determination, and excellence.</p></li>
        </ul>  
        <br>
        <b>We’re Looking For:</b>
        <ul>
            <li><p>Passionate individuals eager to make an impact in the fitness industry.</p></li>
            <li><p>Team players who value hard work and determination.</p></li>
            <li><p>Dynamic personalities ready to contribute to a fun and energetic environment.
</p></li>

        </ul><br>
        <b>Your Opportunity:</b>
        <ul>
            <li><p>Be part of a young, vibrant team poised to make waves in Mumbai’s fitness scene.</p></li>
            <li><p>Work in an environment where your growth is our priority.</p></li>
            <li><p>Embark on a fulfilling career path with endless possibilities for personal and professional development.</p></li>
        </ul>
        <br><p><b>Ready to Join Us?</b>Submit your resume below and take the first step towards a rewarding career at Star Gym, where every day is an opportunity to excel.</p>
    </div>
              <div class="form-container">
                
            <div class="right-container">
            <div class="form-container">
        <h1>APPLY NOW</h1>
        <form onsubmit="handleSubmit(event)">
            <div class="form-row">
                <input type="text" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="form-row">
                <input type="text" id="phone" name="phone" placeholder="Phone Number" required maxlength="10" pattern="\d{10}">
            </div>
            <div class="form-row">
                <div class="radio-group">
                    <label><input type="radio" id="male" name="gender" value="Male" required> Male</label>
                    <label><input type="radio" id="female" name="gender" value="Female" required> Female</label>
                </div>
            </div>
            <div class="form-row">
                <select id="field" name="field" required>
                    <option value="Aerobics Trainer">Aerobics Trainer</option>
                    <option value="Zumba Trainer">Zumba Trainer</option>
                    <option value="Yoga Trainer">Yoga Trainer</option>
                    <option value="Cross Fitness">Cross Fitness</option>
                    <option value="Gymnastics Trainer">Gymnastics Trainer</option>
                </select>
            </div>
            <div class="form-row">
                <input type="number" id="experience" name="experience" placeholder="Year of Experience" min="0" required>
            </div>
            <div class="form-row">
                <input type="number" id="age" name="age" placeholder="Age" min="0" required>
            </div>
            <div class="form-row">
                <select id="time" name="time" required>
                    <option value="Part Time">Part Time</option>
                    <option value="Full Time">Full Time</option>
                </select>
            </div>
            <div class="form-row">
                <input type="submit" value="Submit">
            </div>
            <div id="message" class="message"></div>
        </form>
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