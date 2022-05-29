<?php 
session_start();

	include("includes/connection.php");
	include("includes/functions.php");

	$user_data = check_login($con);


    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $emailfrom = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $mailTo = "almadelearning@gmail.com";
        $headers = "From: ".$emailfrom;
        $txt = "You have received an e-mail from ".$emailfrom."\n\n".$name.",\n\n".$message;

        mail($mailTo,$subject,$txt,$headers);
        header("index.php");
    }

    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/contactstyle.css">
    <link rel="icon" type="image/svg+xml" href="img/favicon.svg">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <title>Contact us</title>
</head>

<body>
 

    <header>
        <div class="navbar">

            <div class="logo">
                <a href="index.php"><img src="img/almad.png" alt="logo" height="28px"></a>
            </div> <!-- end logo -->


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

    <div class="contact1">
        <div class="container-contact1">
            <div id="img-cont" class="contact1-pic js-tilt" data-tilt>
                <img src="img/contact_us.svg" alt="IMG">
            </div>

            <form class="contact1-form validate-form" method="POST">
                <span class="contact1-form-title">
                    Get in touch
                </span>

                <div class="wrap-input1 validate-input" data-validate="Name is required">
                    <input class="input1" type="text" name="name" placeholder="Name">
                    <span class="shadow-input1"></span>
                </div>

                <div class="wrap-input1 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input1" type="email" name="email" placeholder="Email">
                    <span class="shadow-input1"></span>
                </div>

                <div class="wrap-input1 validate-input" data-validate="Subject is required">
                    <input class="input1" type="text" name="subject" placeholder="Subject">
                    <span class="shadow-input1"></span>
                </div>

                <div class="wrap-input1 validate-input" data-validate="Message is required">
                    <textarea class="input1" name="message" placeholder="Message"></textarea>
                    <span class="shadow-input1"></span>
                </div>

                <div class="container-contact1-form-btn">
                    <button class="contact1-form-btn" name="submit">
                        <span>
                            Send Email
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');




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

    <!--===============================================================================================-->
    <script src="js/contact.js"></script>
</body>

</html>