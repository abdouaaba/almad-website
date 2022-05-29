<?php
session_start();

    include("includes/connection.php");
    include("includes/functions.php");

    $user_data= check_login($con);

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/classes.css">
        <title>Classes</title>
        <link rel="icon" type="image/svg+xml" href="img/favicon.svg">
        <link rel="icon" type="image/png" href="img/favicon.png">
    </head>

    <body>
        <style>
            #logout{
                display:flex;
            }
        </style>
        <header>
            <div class="navbar">

                <div class="logo">
                    <a href="index.php"><img src="img/almad.png" alt="logo" height="28px"></a>
                </div> <!-- end logo -->

                <img id="mobile-cta" class="mobile-menu" src="img/menu-icon.svg" alt="Open navbar" height="24px">


                <nav>
                    <img id="mobile-exit" class="mobile-menu-exit" src="img/close-icon.svg" alt="Close navbar" height="24px">

                    <ul class="main-nav">
                        <li class="bold"><a href="index.php">Home</a></li>
                        <li><a href="classes.php">Classes</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>

                    <?php
                    if (!empty($_SESSION['User_ID']))
                    {
                     echo'
                    <ul class="second-nav">
                    
                        <li class="rounded" id="logout"><a href="logout.php">Log out</a></li>
                    </ul>';
                    
                    }
                    else{
                        header("Location: login.php");
                    }
                    ?>
                </nav> <!-- end second-nav -->

            </div> <!-- end navbar -->
        </header>
        
        <main>
            <h1>Classes</h1>
            
            <div class="pictures">
                <img class="bg-picture1 bg-picture" src="img/pic-class1.svg" alt="">
                <img class="bg-picture2 bg-picture" src="img/pic-class2.svg" alt="">
                <img class="bg-picture3 bg-picture" src="img/pic-class3.svg" alt="">
            </div>
            <div class="container">
                
                <h2>Your classes</h2>
                <img id="add-cta" class="add-btn" onclick="showAdd()" src="img/plus-icon.svg" alt="Add or Join a Class Icon">
                <div id="add-box" style="display: none;">
                    <ul>
                        <li id="pop_up">Create Class</li>
                        <li onclick="showJoinBox()">Join Class</li>
                    </ul>
                    <form id="join-box" action="join.php" style="display: none;">
                        <label for="code">Enter Class Code :</label><br>
                        <input type="text" id="code" name="code" required><br>
                        <input type="submit" value="Join">
                    </form>

                    
                </div>

                <div id="bg-pop_up">
                    <div class="c-container">
                        <div class="top">
                            <h4>Create class</h4>
                            <div id="close-pop_up" class="close-img">+</div>
                        </div>
                        <form action="create-c.php" method="post">
                        <div class="set-info">
                                <div class="info">
                                    <label class="class-n-d">
                                        <span class="cls-n-d">Class name :</span>
                                        <input class="inpt-cls" type="text" name="title" placeholder="Enter class name" required>
                                    </label>
                                    <label  class="class-n-d">
                                        <span class="cls-n-d">Class description :</span>
                                        <input class="inpt-cls" type="text" name="description" placeholder="Enter class description" required>
                                    </label>
                                        <!--<div >
                                            <label class="choice">
                                                <input id="pb" type="radio" name="type" value="public" required><span>Unlimited</span>
                                            </label>
                                        </div>
                                        <div >
                                            <label class="choice">
                                                <input id="prv" type="radio" name="type" value="private"><span>Limited</span>
                                            </label>
                                        
                                        </div>
                                        <div class="nombre-std">
                                            <label >
                                                <span>
                                                    Enter maximum number of participents
                                                </span>
                                                <input id="max_std" class="inpt-cls" type="number" name="max_nb" >
                                            
                                            </label>
                                        </div>    -->                          
                            
                                </div>
                                <div class="sbm-holder">
                                    <button class="sbm-btn" type="submit">Create</button> 
                                </div>               
                        </div>    
                    

                        </form>
                    </div>
                </div>

            </div>

            <div id="no-classes" style="display: none;">
                <h2>No classes yet.</h2>
            </div>

            <div id="classes-area">
                
                <?php
                
                $x = 1;
                $user_id = $user_data['User_ID'];
                $records = mysqli_query($con,"select class_code, title, description, teacher from relations, classes where user_id = '".$user_id."' and relations.class_code = classes.code;");
                while($data = mysqli_fetch_array($records))
                {
                    $enc_class = encrypt($data['class_code']);
                ?>
                    <div id=<?php echo "box$x"; ?> class="class-box">
                        <h2><a href=<?php echo "class.php?did=".$enc_class.""; ?>><?php echo $data['title']; ?></a></h2>
                        <h5><?php echo $data['description']; ?></h5>
                        <h5><a href="#"><?php echo $data['teacher']; ?></a></h5>
                        <img id=<?php echo "more-cta$x"; ?> class="more" src="img/more-icon.svg" alt="More Icon">
                        <img class="teacher-profile" src="img/profile.png" alt="Teacher's Profile Picture">
                        <div id=<?php echo "more-box$x"; ?> class="more-box" style="display: none;">
                            <ul>
                                <a class="leave" href=<?php echo "leave.php?did=".$enc_class.""; ?>><li>Leave</li></a>
                            </ul>
                        </div>
                    </div>
                <?php
                $x++;
                }
                ?>
                
                <?php mysqli_close($con); ?>
                
            </div>
        </main>

        <script src="js/index.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
            ?>
            <script>
                Swal.fire({
                    title: "<?php echo $_SESSION['status']?>",
                    text: "<?php echo $_SESSION['status_text']?>",
                    icon: "<?php echo $_SESSION['status_code']?>",
                });
            </script>
            <?php
            unset($_SESSION['status']);
        }
        ?>

        <script>
            $('.leave').on('click', function(e) {
                e.preventDefault();
                var self = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, leave!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Left!',
                        'You left succefully.',
                        'success'
                        )
                        location.href = self.attr('href');
                    }
                })
            })
        </script>
    </body>
</html>