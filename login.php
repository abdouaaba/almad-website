<?php 

session_start();

	include("includes/connection.php");
	include("includes/functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_mail = $_POST['Email'];
		$password = $_POST['password'];

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
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
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
    <link href ="css/stylesignin.css"  rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="img/favicon.svg">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>
<body>
    <div class="bg">
        <div class="logo">
            <a href="index.php"><img src="img/almad.png" alt="logo" height="30px"></a>
        </div> <!-- end logo -->
        <div class="container">
            <div class="left">
                <h4>Glad to see you!</h4>
                <img src="img/undraw_welcoming_re_x0qo.svg" alt="Welcome">
            </div>
        
            <div class="right">
                    <h4>Hello!</h4>
                    <p>Log in to your account</p>
                    <form method="post">
                        <div class="info">
                            <div class="set_info">
                                <label class="mail">
                                    <input name="Email" type="email" placeholder="Enter your E-mail">
                                </label>
                            </div>
                            <div class="set_info">
                                <label class="password">
                                    <input name="password" type="password" placeholder="Enter your password"  id="show_password" >
                                    <div class="sh">
                                                <span class="pswrd" id="show_" onclick="myFunction()">show password</span>
                                                <span class="hidepswrd" id="hide_" onclick="myFunction2()">Hide password</span>
                                </div>
                            
                                </label>
                            </div>
                            <div class="set-info">
                                <input type="submit" value="Login">
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

           function myFunction() {
            var x = document.getElementById("show_password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            }
            
            function myFunction2() {
                    var x = document.getElementById("show_password");
                    if (x.type === "text") {
                        x.type = "password";
                    } else {
                        x.type = "text";
                    }
                }
            document.getElementById("show_").addEventListener("click",
            function (){
                document.getElementById("show_").style.display = "none";
                document.getElementById("hide_").style.display = "block";

            }
            );

            document.getElementById("hide_").addEventListener("click",
                    function () {
                        document.getElementById("show_").style.display = "block";
                        document.getElementById("hide_").style.display = "none";

                    }
            );

            
           
    </script>
</body>
</html>