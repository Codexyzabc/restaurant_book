<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header("location: ./pages/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="./pages/css/index.css">
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <ul>
                    <li style="float: left;"><a href="">EasyDiner</a></li>
                    <?php    
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                            echo '<li><a href="./pages/logout.php">Logout</a></li>';
                        }
                        else {
                            echo '<li><a href="./pages/signup.php">Sign up</a></li>';
                            echo '<li><a href="./pages/login.php">Log in</a></li>';
                        }
                    ?>
                    <li><a href="#restu">Book Table</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="" id="show-img">Sitemap</a></li>  
                    <!-- <li><a href="../admin/admin_login.php">Admin Login</a></li> -->
                </ul>
            </nav>
        </header>

        <!-- <img id="myImg" src="./pages/assets/f1.jpg" alt="Snow" style="width:100%;max-width:300px"> -->
        <!-- Floating Image Overlay -->
        <div class="image-overlay" id="image-overlay">
            <button class="close-btn" id="close-btn">&times;</button>
            <img src="./pages/assets/sitemap.png" alt="Floating Image">
        </div>

        <section class="about" id="about">
            <div class="about_image">
              <img src="./pages/assets/img5.jpg" alt="about" />
            </div>
            <div class="about_content">
              <p class="header">ABOUT US</p>
              <h2 class="sub_header">Welcome to EasyDiner</h2>
              <p class="description">
              Located in the heart of Kolkata, we pride ourselves on offering a delightful blend of ambiance, 
              exquisite cuisine, and top-notch service. Whether you're planning a family gathering, 
              a romantic evening, or a business lunch, our team is dedicated to making your time with us truly exceptional.
              </p>
              <p class="description">
              At EasyDiner, we believe in creating memorable dining moments. 
              We look forward to welcoming you and giving you a taste of our unique culinary offerings. 
              Thank you for choosing EasyDiner — where great food, ambiance, and service come together.
              </p>
            </div>
        </section>

        <section class="restu" id="restu">
            <div class="restu_content">
                <h2 class="sub_header">Book Table</h2>
                <p class="header">Book your table now and treat yourself to the finest cuisine in town</p>
                <?php
                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        echo '<a href="./pages/user_panel.php" style="background-color: #fd6585; color: black; padding: 15px; 
                        font-size: larger; border-radius: 4px; display:inline-block; margin-top: 15px;
                        box-shadow: 5px 5px 18px #888888; text-decoration: none;">Book Table</a>';
                        // echo $_SESSION['email'];
                    }
                    else {
                        echo '<p class="header"><a href="./pages/login.php" style="color: red">Log in</a> now to book your table</p>';
                    }
                ?>
            </div>
            <div class="food_images">
                <img src="./pages/assets/f1.jpg" alt="food">
                <img src="./pages/assets/f2.jpg" alt="food">
                <img src="./pages/assets/f3.jpg" alt="food">
                <img src="./pages/assets/f4.jpeg" alt="food">
                <img src="./pages/assets/f5.jfif" alt="food">
                <img src="./pages/assets/f6.jpg" alt="food">
                <img src="./pages/assets/f7.jpg" alt="food">
            </div>
        </section>

        <footer class="footer" id="footer">
            <div class="footer_container">
                <div class="footer_col">
                    <p class="footer_header">ABOUT EASYDINER</p>
                    <ul class="footer_links">
                        <li><a href="#">Who We Are</a></li>
                        <li><a href="#">Special Offers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer_col">
                    <p class="footer_header">FOR RESTAURANTS</p>
                    <ul class="footer_links">
                        <li><a href="#">Partner With Us</a></li>
                        <li><a href="#">Apps For You</a></li>
                    </ul>
                </div>
                <div class="footer_col">
                    <p class="footer_header">LEARN MORE</p>
                    <ul class="footer_links">
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Security</a></li>
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Sitemap</a></li>
                    </ul>
                </div>
                <div class="footer_col">
                    <p class="footer_header">SOCIAL LINKS</p>
                    <ul class="footer_links">
                        <li><a href="#">easydiner@gmail.com</a></li>    
                        <li><a>+91 7439642785</a></li>
                    </ul>
                    <div class="footer_socials">
                        <a href="#"><img src="./pages/assets/facebook.png" alt="facebook" /></a>
                        <a href="#"><img src="./pages/assets/instagram.png" alt="instagram" /></a>
                        <a href="#"><img src="./pages/assets/youtube.png" alt="youtube" /></a>
                        <a href="#"><img src="./pages/assets/twitter.png" alt="twitter" /></a>
                    </div>
                </div>
                
            </div>
            <div class="footer_bar">
                Copyright © 2024 Sougota Saha. All rights reserved.
            </div>
        </footer>
        
    </div>

    <script>
        // Get elements
        const showImageLink = document.getElementById('show-img');
        const imageOverlay = document.getElementById('image-overlay');
        const closeBtn = document.getElementById('close-btn');

        // Show the image overlay
        showImageLink.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            imageOverlay.style.display = 'flex';
        });

        // Close the image overlay
        closeBtn.addEventListener('click', function() {
            imageOverlay.style.display = 'none';
        });

        // Close overlay on clicking outside the image
        imageOverlay.addEventListener('click', function(event) {
            if (event.target === imageOverlay) {
                imageOverlay.style.display = 'none';
            }
        });
    </script>
</body>
</html>