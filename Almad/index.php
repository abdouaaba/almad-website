<?php 
session_start();

	include("includes/connection.php");
	include("includes/functions.php");

	$user_data = check_login($con);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/svg+xml" href="img/favicon.svg">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <title>Almad E-Learning</title>
</head>

<body>
    
    <header>
        <div class="navbar">

            <div class="logo">
                <a href="index.php"><img src="img/almad.png" alt="logo" height="28px"></a>
            </div> <!-- end logo -->


            <?php
                    if (!empty($_SESSION['User_ID']))
                    {                
                        $nom = $user_data['Fullname'];
                        echo'<h3 class="user_name_mob">Hello! <span class="UN">'. $nom .'</span></h3>'; }
             ?>
            <img id="mobile-cta" class="mobile-menu" src="img/menu-icon.svg" alt="Open navbar" height="24px">


            <nav>
                <img id="mobile-exit" class="mobile-menu-exit" src="img/close-icon.svg" alt="Close navbar"
                    height="24px">


                <ul class="main-nav">

                    <li class="bold"><a href="index.php">Home</a></li>
                    <li><a href="classes.php">Classes</a></li>


                    <?php
                    
                    if (!empty($_SESSION['User_ID']))
                    {
                        
                     echo'
                    <li><a href="profile.php">Profile</a></li>';
                    
                    }
                    else
                    { echo'
                          <li><a href="login.php">Profile</a></li>';
                    }
                    ?>

                    <li><a href="contact.php">Contact</a></li>
                </ul>

                <?php
                    
                    if (!empty($_SESSION['User_ID']))
                    {
                        $nom = $user_data['Fullname'];
                     echo'
                    <ul class="second-nav">
                      
                        <li  class="user_name" >Hello!<span class="UN" > '. $nom .'</span></li>
                        
                        <li class="rounded" id="logout"><a href="logout.php">Log out</a></li>
                    </ul>';
                    
                    }
                    else
                    { echo'
                         <ul class="second-nav">
                            <li><a href="login.php" id="login">Log in</a></li>
                            <li class="rounded" id="signup"><a href="signup.php">Sign up</a></li>
                         </ul>';
                    }
                    ?>

            </nav> <!-- end second-nav -->

        </div> <!-- end navbar -->
    </header>

    <section id="hero">
        <div class="container">
            <div class="hero-info ">
                <h1 class="hero-title">ALMAD E-LEARNING</h1>
                <h2 class="hero-descr">Online Learning Platform</h2>
            </div>

            <div class="hero-img">
                <img src="img/hero-img.svg" alt="Illustration">
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="about-title">
                <h2>Who are we ?</h2>
            </div>
            <div class="about-text">
                <p>
                  Almad is a platform for online learning that gives students and teachers the ability to share learning materials and communicate with each other. Create or join a class and share information with your students/classmates
                </p>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="itemleft item">
                <h3>Developed by</h3>
                <ul>
                    <li><a href="#">AA</a></li>
                    <li><a href="#">AMa</a></li>
                    <li><a href="#">AMo</a></li>
                </ul>
            </div>
            <div class="itemright item text">
                <h3>Contact us</h3>
                <p>yourmail@gmail.com</p>
            </div>
            <div style="clear:both;"></div>
            <p class="copyright">Almad E-Learning © 2022</p>
        </div>
    </footer>

    <script>

        const mobileBtn = document.getElementById('mobile-cta')
        nav = document.querySelector('nav')
        mobileBtnExit = document.getElementById('mobile-exit');

        mobileBtn.addEventListener('click', () => {
            nav.classList.add('menu-btn')
        })

        mobileBtnExit.addEventListener('click', () => {
            nav.classList.remove('menu-btn')
        })

        document.addEventListener('mouseup', function (e) {
            if (!e.target.matches('.menu-btn')) {
                nav.classList.remove('menu-btn')
            }
        });

    </script>

</body>

</html>