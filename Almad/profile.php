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
    <title>Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profilestyle.css">

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

    <div class="user-container">
        <div class="user-card">
            <div class="con_img_name">

                <?php
              if($user_data['Gender'] == 'Female'){
                  echo' <div class="user-card-info"><img class="user-img" width="150px" src="img/female_pic.png"></div>';
              }
              else{
                   echo' <div class="user-card-info"><img class="user-img" width="150px" src="img/male_pic.png"></div>';
              }
              
            ?>

                <div class="name-mail">
                    <span class="name">
                        <?php echo $user_data['Fullname']; ?>
                    </span><br>
                    <span class="mail">
                        <?php echo $user_data['Email']; ?>
                    </span>
                </div>
            </div>

            <div class="about">
                <h5>About</h5>
                <p class="about_p">
                    <?php echo $user_data['About']; ?>
                </p>
            </div>

        </div>
        <div class="info-container">

            <div class="set">
                <span>Profile Settings</span>

            </div>
            <div class="save_btn">
                <a href="updateprofile.php"> <input class="save_b" type="submit" value="Edit"></a>
            </div>

            <div class="info">

                <form method="post">

                    <div class="colums_">

                        <div class="colums">
                            <div class="form__group field"><label class="form__label">Full Name</label><input
                                    type="text" class="form__field" value="<?php echo $user_data['Fullname']; ?>"
                                    readonly></div>
                            <div class="form__group field"><label class="form__label">Phone Number</label><input
                                    type="text" class="form__field" value="<?php echo $user_data['Phone']; ?>" readonly>
                            </div>
                            <div class="form__group field"><label class="form__label">Birth Date</label><input
                                    type="date" class="form__field" value="<?php echo $user_data['Birthdate']; ?>"
                                    readonly>
                            </div>


                        </div>
                        <div class="colums">


                            <div class="form__group field"><label class="form__label">E-mail</label><input type="mail"
                                    class="form__field" value="<?php echo $user_data['Email']; ?>" readonly></div>
                            <div class="form__group field"><label class="form__label">School</label><input type="text"
                                    class="form__field" value="<?php echo $user_data['School']; ?>" readonly></div>

                            <div class="form__group field"><label class="form__label">Password</label><input
                                    type="password" id="mypswrd" class="form__field"
                                    value="<?php echo $user_data['Password']; ?>" readonly>
                                <div class="show_hide_pswd">
                                    <span id="sh_p" onclick="myFunction()">Show Password</span>
                                    <span id="hi_p" onclick="myFunction2()">Hide Password</span>
                                </div>


                            </div>


                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>

    <script>

        const mobileBtn = document.getElementById('mobile-cta')
        nav = document.querySelector('nav')
        mobileBtnExit = document.getElementById('mobile-exit');

        mobileBtn.addEventListener('click', () => {
            nav.classList.add('menu-btn');
        })

        mobileBtnExit.addEventListener('click', () => {
            nav.classList.remove('menu-btn');
        })

        document.addEventListener('mouseup', function (e) {
            if (!e.target.matches('.menu-btn')) {
                nav.classList.remove('menu-btn')
            }
        });


        function myFunction() {
            var x = document.getElementById("mypswrd");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function myFunction2() {
            var x = document.getElementById("mypswrd");
            if (x.type === "text") {
                x.type = "password";
            } else {
                x.type = "text";
            }
        }

        document.getElementById("sh_p").addEventListener("click",
            function () {
                document.getElementById("sh_p").style.display = "none";
                document.getElementById("hi_p").style.display = "block";

            }
        );

        document.getElementById("hi_p").addEventListener("click",
            function () {
                document.getElementById("sh_p").style.display = "block";
                document.getElementById("hi_p").style.display = "none";

            }
        );



    </script>


</body>

</html>