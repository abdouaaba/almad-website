<?php 
session_start();

    include("includes/connection.php");
	include("includes/functions.php");
 	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posteds
		$Full_name = ucwords(strtolower($_POST['Fullname']));
		$phone = $_POST['Phone'];
        $birth_date = $_POST['Birthdate'];
        $email = $_POST['Email'];
        $school = $_POST['School'];
        $password = $_POST['Password'];
        $gender = $_POST['gender'];
		if(!empty($email) && !empty($password) && !is_numeric($Full_name))
		{

			//save to database			
           $user_id =  (time()+ rand(1,1000));
         

            $query = "insert into user_ (user_id,Fullname,Phone,Birthdate,Email,School,Password,Gender) values ('$user_id','$Full_name','$phone','$birth_date','$email','$school','$password','$gender')";
			mysqli_query($con, $query);

			header("Location: index.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="css/signupstyle.css" rel="stylesheet">

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



                    <li><a href="login.php">Profile</a></li>

                    <li><a href="contact.php">Contact</a></li>
                </ul>

            </nav> <!-- end second-nav -->

        </div> <!-- end navbar -->
    </header>

    <div class="container">
        <div class="container_sign-up">
            <div class="left_side">
                <h4>Welcome!</h4>
                <img src="img/undraw_welcome_re_h3d9.svg" alt="welcoming">
            </div>
            <div class="right_side">
                <div class="titre">
                    <h4>Sign up</h4>
                </div>
                <form method="POST">
                    <div class="info">
                        <div class="set-info"><label class="labels"><span class="details">Full Name</span></label><input
                                name="Fullname" type="text" class="input-cls" placeholder="Enter your Full name"
                                required>
                        </div>
                        <div class="set-info"><label class="labels"><span class="details">Phone
                                    Number</span></label><input name="Phone" type="text" class="input-cls"
                                placeholder="Enter your Phone Number" required></div>
                        <div class="set-info"><label class="labels"><span class="details">Birth
                                    date</span></label><input name="Birthdate" type="date" id="bd" class="input-cls"
                                placeholder="Enter your Birth date" required></div>

                        <div class="set-info"><label class="labels"><span class="details">Email</span></label><input
                                name="Email" type="email" class="input-cls" placeholder="Enter your Email" required>
                        </div>
                        <div class="set-info"><label class="labels"><span class="details">School</span></label><input
                                name="School" type="text" class="input-cls" placeholder="Enter your School" required>
                        </div>

                        <div class="set-info"><label class="labels"><span class="details">Gender</span></label>
                            <div class="radio_g">
                                <label class="choice">
                                    <span>Male</span> <input class="input_rad" id="pb" type="radio" name="gender"
                                        value="Male" required>
                                </label>
                            </div>
                            <div class="radio_g">
                                <label class="choice">
                                    <span>Female</span><input class="input_rad" type="radio" name="gender"
                                        value="Female" id="prv">
                                </label>

                            </div>

                        </div>

                        <div class="set-info"><label class="labels"><span class="details">Password</span></label><input
                                name="Password" type="password" class="input-cls" id="mypswrd" placeholder="Password"
                                required>
                            <div class="show_hide_pswd">
                                <span id="sh_p" onclick="myFunction()">Show Password</span>
                                <span id="hi_p" onclick="myFunction2()">Hide Password</span>
                            </div>



                            <div class="sign_up">
                                <input id="button" type="submit" value="Sign up">
                            </div>
                        </div>
                </form>
                <div class="sign_in">
                    You already have an account? <a href="login.php"><span id="sign__in">Log in</span></a>
                </div>
            </div>

        </div>
    </div>

    <script>
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
                document.getElementById("hi_p").style.display = "inline";

            }
        );

        document.getElementById("hi_p").addEventListener("click",
            function () {
                document.getElementById("sh_p").style.display = "inline";
                document.getElementById("hi_p").style.display = "none";

            }
        );
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