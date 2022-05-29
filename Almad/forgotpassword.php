<?php


            session_start();

            include("includes/connection.php");
            if(isset($_POST) & !empty($_POST)){
            $email = $_POST['email'];
            $sql= "select * from user_ where Email ='$email' limit 1";
            $res = mysqli_query($con, $sql);
          
            if($res){
                if($res && mysqli_num_rows($res) > 0)
				{
                    echo "Send email to user with password";
                }else{
                    echo "User name does not exist in database";
                    }
            
                }
          
            $r = mysqli_fetch_assoc($res);
            $password = $r['Password'];
            $to = $r['Email'];
            $subject = "Your Recovered Password";
            
            $message = "Please use this password to login " . $password;

            $headers = "From : almadelearning@gmail.com";
            mail($to, $subject, $message, $headers);
            
         
		
        }
  

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
        <link rel="stylesheet" href="css/style.css">

    <link href="css/forgotpasswordstyle.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="img/favicon.svg">
    <link rel="icon" type="image/png" href="img/favicon.png">
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

                    <li><a href="profile.php">Profile</a></li>

                    <li><a href="login.php">Profile</a></li>

                    <li><a href="contact.php">Contact</a></li>
                </ul>

            </nav> <!-- end second-nav -->

        </div> <!-- end navbar -->
    </header>



    <div class="container">
        <div class="container_sign-in">


            <div class="right">
                <h4>Recover your Password</h4>

                <form method="post">
                    <div class="info">
                        <div class="set_info"><label class="label"><span class="detail">Email</span></label><input
                                name="email" type="email" class="inputcls" placeholder="Enter your Email"></div>

                        <div class="login">
                            <input id="button1" type="submit" value="Confrim">
                        </div>
                    </div>
                </form>
                <div class="create-acc">
                    Don't have an account? <a href="signup.php"><span id="sign__up">Create</span></a>
                </div>

            </div>

        </div>
    </div>
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