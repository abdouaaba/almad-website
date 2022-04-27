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
    <link rel="stylesheet" href="css/styleprofile.css">
    <link rel="icon" type="image/svg+xml" href="img/favicon.svg">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>

<body>
    <header>
        <div class="navbar">

            <div class="logo">
                <a href="index.php"><img src="img/almad.png" alt="logo" height="28px"></a>
            </div>

            <img id="mobile-cta" class="mobile-menu" src="img/menu-icon.svg" alt="Open navbar" height="24px">


            <nav>
                <img id="mobile-exit" class="mobile-menu-exit" src="img/close-icon.svg" alt="Close navbar"
                    height="24px">

                <ul class="main-nav">
                    <li class="bold"><a href="index.php">Home</a></li>
                    <li><a href="classes.php">Classes</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>

                <ul class="second-nav">
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </nav>
        </div>

    </header>

    <div class="user-container">
        <div class="user-card">
            <div class="user-card-info"><img class="user-img" width="150px" src="img/user-avatar.png"></div>
            <div class="name-mail">
                <span class="name"><?php echo $user_data['Fullname']; ?></span><br>
                <span class="mail"><?php echo $user_data['Email']; ?></span>
            </div>
            <div class="about">
                <h5>About</h5>
                <p><?php echo $user_data['About']; ?></p>
            </div>
        </div>
        <div class="info-container">
            <div class="set-edit">
                <span> Profile Settings</span>
                <button id="edit-btn" type="submit" class="btn"><span class="edit">Edit</span></button>
                <button id="save-btn" class="btn" type="submit"><span class="edit">Save</span></button>

            </div>

            <div class="info">
              <form method="post">
                <div class="div_info"><label class="labels"><span class="details">Full Name</span></label><input
                        type="text" class="input_info" value="<?php echo $user_data['Fullname']; ?>" readonly></div>
                <div class="div_info"><label class="labels"><span class="details">Phone Number</span></label><input
                        type="text" class="input_info"  value="<?php echo $user_data['Phone']; ?>" readonly></div>
                <div class="div_info"><label class="labels"><span class="details">Birth Date</span></label><input
                        type="text" class="input_infosss" value="<?php echo $user_data['Birthdate']; ?>" readonly></div>
                <div class="div_info"><label class="labels"><span class="details">Address</span></label><input
                        type="text" class="input_info"  value="<?php echo $user_data['Address']; ?>" readonly></div>
                <div class="div_info"><label class="labels"><span class="details">E-mail</span></label><input
                        type="text" class="input_info"  value="<?php echo $user_data['Email']; ?>" readonly></div>
                <div class="div_info"><label class="labels"><span class="details">School</span></label><input
                        type="text" class="input_info"  value="<?php echo $user_data['School']; ?>" readonly></div>
                <div class="div_info"><label class="labels"><span class="details">Password</span></label><input
                        type="password" class="input_info"  value="<?php echo $user_data['Password']; ?>" readonly></div>
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

        document.addEventListener('mouseup', function(e) {
            if (!e.target.matches('.menu-btn')) {
                nav.classList.remove('menu-btn')
            }
        });

    

        document.getElementById("edit-btn").addEventListener("click",
            function () {
                document.getElementById("save-btn").style.display = "block";
                document.getElementById("edit-btn").style.display = "none";


            }
        );
    </script>


</body>

</html>