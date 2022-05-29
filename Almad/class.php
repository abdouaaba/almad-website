<?php
session_start();

    include("includes/connection.php");
    include("includes/functions.php");

    $user_data= check_login($con);
    if(isset($_GET['did'])) {
        $enc_class = mysqli_real_escape_string($con, $_GET['did']);
        $class_code = decrypt($enc_class);
    }
    
    isclass($class_code, $con);
    isparticipant($_SESSION['User_ID'], $class_code, $con);
    
    $data = mysqli_fetch_array(mysqli_query($con,"select title, description from classes where code = '".$class_code."';"));
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/classstyle.css">
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
            </div> 
    
            <img id="mobile-cta" class="mobile-menu" src="img/menu-icon.svg" alt="Open navbar" height="24px">
    
    
            <nav>
                <img id="mobile-exit" class="mobile-menu-exit" src="img/close-icon.svg" alt="Close navbar" height="24px">
    
                <ul class="main-nav">
                    <li class="bold"><a href="index.php">Home</a></li>
                    <li><a href="classes.php">Classes</a></li>
                    <li><a href="profile.php">Profile</a></li>
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
                    else{
                        header("Location: login.php");
                    }
                ?>
                
            </nav>
    
        </div>
    </header>

     <div class="container">

        <div class ="class_card">
            <div class="classcard-bg">
                <img src="img/bg_classcard.svg" alt="">
            </div>
            <div class="class-infos">
                <h4><?php echo $data['title']; ?></h4>
                <p><?php echo $data['description']; ?></p>
            </div>
        </div> 
        <div class="main">
            <div class="bar">
                <ul>
                    <li id="show_teacher"> Teacher</li>
                    <li id="show_content" style="color:#6472F9; border-bottom: solid;">Content</li>
                    <li id="show_participants">Participants</li>
                </ul>
            </div>

          <div id="teacher">

                    <?php
                            $records = mysqli_query($con,"select classes.teacher_id, Fullname, Email, About from classes, user_ where classes.code = '".$class_code."' and classes.teacher_id = user_.User_ID;");
                            $data = mysqli_fetch_array($records)
                    ?>
             <div class="ContainerTeach">

                <div class="img-name-mail">
                    <div class="_img">
                        <img class="user-img" width="150px" src="img/user-avatar.png" alt="teacher image">
                    </div>
                    <div class="n_m">
                        <span class="name">
                            <?php echo $data['Fullname']; ?>
                        </span><br>
                        <span class="mail">
                            <?php echo $data['Email']; ?>
                        </span>
                    </div>
                </div>
                <div class="about">
                    <h5>About</h5>
                    <p>
                        <?php echo $data['About']; ?>
                    </p>
                </div>
            </div>
            <?php
                if( $_SESSION['User_ID'] == $data['teacher_id']){
                    echo ' <div class="ClassCode">
                    <span>Class Code :  </span> '.$class_code.'
                    </div>'
                    ;
                } 
            ?>
               
            </div>
            <div id="content" style="display: block;">

                <?php
                if($user_data['User_ID'] == $data['teacher_id']) {
                ?>
                    
                    <div class="create">
                        <span id="create_btn" onclick="showCreate()">Create</span>

                        <div id="bg-popup">
                            <div class="c-container">
                                <div class="top-create">Create a Post</div>
                                
                                <form action=<?php echo "create-p.php?did=".$enc_class.""; ?> method="POST" enctype="multipart/form-data">
                                    <div class="set-info">
                                        <div class="form-group">
                                            <label for="title">Title <span class="require">*</span></label>
                                            <input type="text" class="inpt-cls" name="title" placeholder="Enter Post Title" required/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="description">Description <span class="require">*</span></label>
                                            <textarea rows="5" class="form-control" name="description" placeholder="Enter Post Description" required></textarea>
                                        </div>
                                        
                                        <div class="file-upload">
                                            <label for="myfile" class="f-u">Upload</label>
                                            <input type="file" id="myFile" name="myfile[]" multiple="multiple">
                                        </div>
                                        
                                        <div class="form-group">
                                            <p><span class="require">*</span> - required fields</p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <button type="submit" name="create">
                                                Create
                                            </button>
                                            <button onclick="hideCreate()" name="cancel">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

                <div id="no-posts" style="display: none;">
                    <h2>No posts yet.</h2>
                </div>

                <?php
                
                $x = 1;
                $records = mysqli_query($con,"select class_code, id, title, description, time, attach from posts where class_code = '".$class_code."' order by time desc;");

                $teacherID = mysqli_fetch_array((mysqli_query($con,"select teacher_id from classes where classes.code = '".$class_code."';")));

                while($data = mysqli_fetch_array($records))
                {
                    $enc_post_id = encrypt($data['id']);
                ?>

                    <div id=<?php echo "post$x"; ?> class="post">
                        <form action="">
                            <div class="top_post">  
                                <div class="title_date">
                                    <!--
                                    <h4><input type="text" class="input_info" value="<?php echo $data['title']; ?>" readonly><br/><span><?php echo time_elapsed_string($data['time']); ?></span></h4>
                                    -->
                                    <h4><?php echo $data['title']; ?><span><?php echo time_elapsed_string($data['time']); ?></span></h4>
                                </div>
                                
                                <div class="edit">

                                    <?php
                                    if($user_data['User_ID'] == $teacherID['teacher_id']) {
                                    ?>
                                    <img id=<?php echo "show_options$x"; ?> class="show_options" src="img/3-vertical-dots.svg" alt="options">

                                    <ul id=<?php echo "e_r$x"; ?> class="e_r">
                                        <li><span class="e">Edit</span></li>
                                        <li><a class="r" href=<?php echo "remove-post.php?cd=".urlencode($enc_class)."&did=".urlencode($enc_post_id).""; ?>>Remove</a></li>
                                    </ul>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div style="clear:both;"></div>
                                
                            </div>
                            <div class="post_content">
                                    <div class="post_descr">
                                        <!--
                                        <blockquote><textarea class="input_info" name="description" readonly><?php echo htmlspecialchars($data['description']); ?></textarea></blockquote>
                                        -->
                                        <blockquote><?php echo htmlspecialchars($data['description']); ?></blockquote>
                                    </div>
                                    
                                    <?php
                                    if($data['attach']) {
                                        $recs = mysqli_query($con,"select name from files where class_code = '".$class_code."' and post_id = '".$data['id']."';");
                                        while($files = mysqli_fetch_array($recs)) {
                                    ?>

                                        <div class="attach">
                                            <span>
                                                <a href=<?php echo "uploads/".$enc_class.'/'.$files['name']; ?>><?php echo $files['name']; ?></a>
                                            </span>
                                        </div>

                                    <?php
                                        }
                                    }
                                    ?>
                                    
                            </div>
                        </form>
                        
                        <form class="commentaire" action=<?php echo "comment.php?cd=".urlencode($enc_class)."&did=".urlencode($enc_post_id).""; ?> method="POST" >
                            <div class="comm">
                                <input type='text' id='userInput' name='userInput' placeholder="Write your comment">
                                <input type="image" class="comment-button" name="submit" src="img/send.png" alt="Submit" style="height: 2em; width: 2em;" />
                            </div>
                        </form>

                        <div id=<?php echo "comments$x"; ?> class="comments">
                            <?php
                            $y=1;
                            $comments = mysqli_query($con,"select * from comments where post_id = '".$data['id']."' order by time desc;");
                            while($comment = mysqli_fetch_array($comments))
                            {
                            ?>

                            <div id=<?php echo "comment$x$y"; ?> class="comment">
                                <div>
                                    <h3 class="name"><?php echo htmlspecialchars($comment['name'], ENT_QUOTES); ?></h3>
                                    <span class="date"><?php echo time_elapsed_string($comment['time']); ?></span>
                                </div>
                                <div>
                                    <p class="content"><?php echo nl2br(htmlspecialchars($comment['content'], ENT_QUOTES));?></p>
                                </div>
                            </div>


                            <?php
                            $y++;
                            }
                            ?>
                            
                            <a href="" id=<?php echo "see-more$x"; ?>  class="see-more">Show all comments</a>

                        
                        </div>

                    </div>

                <?php
                $x++;
                }
                ?>
                
            </div>

            <div id="participants">
                
                <?php
                $x = 1;
                $records = mysqli_query($con,"select Fullname, user_.user_id from relations, user_ where relations.class_code = '".$class_code."' and relations.user_id = user_.User_ID and relations.role = 'student' order by Fullname;");
                while($data = mysqli_fetch_array($records))
                {
                    $enc_std_id = encrypt($data['user_id']);
                ?>

                    <div id=<?php echo "student$x"; ?> class="student">
                        <div class="info">
                            <span class="pic">
                                <img src="img/user-avatar.png" alt="profile_pic">
                            </span>
                            <span class="name">
                                <h3><?php echo $data['Fullname']; ?></h3>
                            </span>
                        </div>
                        <div class="edit_student">
                            <?php
                            if($user_data['User_ID'] == $teacherID['teacher_id']) {
                            ?>
                            <img id=<?php echo "edit_std$x"; ?> class="edit_std" src="img/more-icon.svg" alt="options" height="30px" width="30px">

                            <ul id=<?php echo "remove$x"; ?> class="remove">
                                <a class="r" href=<?php echo "remove-student.php?cd=".urlencode($enc_class)."&did=".urlencode($enc_std_id).""; ?>><li>Remove</li></a>
                            </ul>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                <?php
                $x++;
                }
                ?>
                
                <?php mysqli_close($con); ?>

            </div>
            
         </div>
        
     </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/class.js"></script>

    <script>
        $('.r').on('click', function(e) {
            e.preventDefault();
            var self = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Removed!',
                    'Removed succefully.',
                    'success'
                    )
                    location.href = self.attr('href');
                }
            })
        })
    </script>
</body>
</html>