<?php 

session_start();

	include("includes/connection.php");
	include("includes/functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_mail = $_POST['Email'];
		$password = $_POST['Password'];

		if(!empty($user_mail) && !empty($password) )
		{

			//read from database
			$query = "select * from user_ where Email = '$user_mail' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['Password'] === $password)
					{

						$_SESSION['User_ID'] = $user_data['User_ID'];
						header("Location: index.php");
						die;
					}
                    else
                    {
                        echo "wrong username or password!";
                    }   
				}
			}
	
		}
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/loginstyle.css" rel="stylesheet">

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
        <div class="container_sign-in">
            <div class="left">
                <h4>Glad to see you!</h4>
                <img src="img/undraw_welcoming_re_x0qo.svg" alt="Welcome">

            </div>

            <div class="right">
                <h4>Hello!</h4>
                <p>Log in to your account</p>
                <form method="post">
                    <div class="info">
                        <div class="set_info"><label class="label"><span class="detail">Email</span></label><input
                                name="Email" type="email" class="inputcls" placeholder="Enter your Email"></div>
                        <div class="set_info"><label class="label"><span class="detail">Password</span></label><input
                                name="Password" type="password" class="inputcls" id="mypswrd1" placeholder="Password">
                            <div class="show_hide_pswd">
                                <span id="sh_p1" onclick="myFunction3()">Show Password</span>
                                <span id="hi_p1" onclick="myFunction4()">Hide Password</span>
                            </div>
                        </div>
                        <div class="login">
                            <input id="button1" type="submit" value="Login">
                        </div>
                        <p>
                            <a href="forgotpassword.php">Forgot Password?</a>
                        </p>
                    </div>
                </form>
                <div class="create-acc">
                    Don't have an account? <a href="signup.php"><span id="sign__up">Create</span></a>
                </div>

            </div>

        </div>
    </div>
    <script>
        function myFunction3() {
            var x = document.getElementById("mypswrd1");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function myFunction4() {
            var x = document.getElementById("mypswrd1");
            if (x.type === "text") {
                x.type = "password";
            } else {
                x.type = "text";
            }
        }
        document.getElementById("sh_p1").addEventListener("click",
            function () {
                document.getElementById("sh_p1").style.display = "none";
                document.getElementById("hi_p1").style.display = "inline";

            }
        );

        document.getElementById("hi_p1").addEventListener("click",
            function () {
                document.getElementById("sh_p1").style.display = "inline";
                document.getElementById("hi_p1").style.display = "none";

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