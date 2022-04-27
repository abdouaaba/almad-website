<?php 
session_start();

    include("includes/connection.php");
	include("includes/functions.php");
 	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$Full_name = $_POST['Fullname'];
		$phone = $_POST['Phone'];
        $birth_date = $_POST['Birthdate'];
		$address = $_POST['Address'];	
        $email = $_POST['Email'];
        $school = $_POST['School'];
        $password = $_POST['Password'];

		if(!empty($email) && !empty($password) && !is_numeric($Full_name))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into user_ (user_id,Fullname,Phone,Birthdate,Address,Email,School,Password) values ('$user_id','$Full_name','$phone','$birth_date ','$address','$email','$school','$password')";

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
    <link href="css/stylesignup.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="img/favicon.svg">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>

<body>
   
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
                          name="Fullname"  type="text" class="input-cls" placeholder="Enter your Full name">
                    </div>
                    <div class="set-info"><label class="labels"><span class="details">Phone Number</span></label><input
                         name="Phone" type="text" class="input-cls" placeholder="Enter your Phone Number"></div>
                    <div class="set-info"><label class="labels"><span class="details">Birth Date</span></label><input
                         name="Birthdate"   type="text" class="input-cls" placeholder="YYYY-MM-DD"></div>
                    <div class="set-info"><label class="labels"><span class="details">Address</span></label><input
                         name="Address"   type="text" class="input-cls" placeholder="Enter your Address"></div>
                    <div class="set-info"><label class="labels"><span class="details">E-mail</span></label><input
                          name="Email"  type="text" class="input-cls" placeholder="Enter your E-mail"></div>
                    <div class="set-info"><label class="labels"><span class="details">School</span></label><input
                          name="School"  type="text" class="input-cls" placeholder="Enter your School "></div>
                    <div class="set-info"><label class="labels"><span class="details">Password</span></label><input
                          name="Password" type="password" class="input-cls" id="mypswrd_" placeholder="password"></div>
                    <div class="sh">
                        <span class="pswrd" id="show__" onclick="myFunction3()">show password</span>
                        <span class="hidepswrd" id="hide__" onclick="myFunction4()">Hide password</span>
                    </div>
                    <div class="sign_up">
                        <input id="button" type="submit" value="Signup">
                    </div>
                </div>
            </form>
            <div class="sign_in">
                You already have an account? <a href="login.php"><span id="sign__in">SIGN IN</span></a>
            </div>
        </div>

    </div>
    <script>

        
        function myFunction3() {
            var x = document.getElementById("mypswrd_");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function myFunction4() {
            var x = document.getElementById("mypswrd_");
            if (x.type === "text") {
                x.type = "password";
            } else {
                x.type = "text";
            }
        }
        document.getElementById("show__").addEventListener("click",
            function () {
                document.getElementById("show__").style.display = "none";
                document.getElementById("hide__").style.display = "block";

            }
        );

        document.getElementById("hide__").addEventListener("click",
            function () {
                document.getElementById("show__").style.display = "block";
                document.getElementById("hide__").style.display = "none";

            }
        );
       
    </script>
</body>

</html>