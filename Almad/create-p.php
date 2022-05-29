<?php
session_start();

    include("includes/connection.php");
    include("includes/functions.php");

    $user_data= check_login($con);

    if(isset($_GET['did'])) {
        $enc_class = mysqli_real_escape_string($con, $_GET['did']);
        $class_code = decrypt($enc_class);
    }
?>
<?php

// Uploads files
if (isset($_POST['create'])) { // if save button on the form is clicked
    // name of the uploaded file

    $randPostID = randomNum();
    $title = $_REQUEST['title'];
    $descr = $_REQUEST['description'];
    $time = date('Y-m-d H:i:s');

    $sql1 = "INSERT INTO posts(id, class_code, title, description, time) VALUES ('$randPostID','$class_code','$title','$descr','$time')";
    if(!mysqli_query($con, $sql1)) {
        echo 'ERROR';
    }

    $countfiles = count($_FILES['myfile']['name']);

    if($_FILES['myfile']['name'][0]) {
        mysqli_query($con, "UPDATE posts SET attach = 1 WHERE id = $randPostID;");
        
        for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['myfile']['name'][$i];
            $filename = str_replace(' ', '_', $filename);
            $filesize = $_FILES['myfile']['size'][$i];
            $randFileID = randomNum();
            echo 'filenam'.$filename;

            if ($filesize > 10000000000) { // file shouldn't be larger than 10Megabyte
                echo "At least 1 file is too large!";
            } else {
                // move the uploaded (temporary) file to the specified destination
                if(!file_exists('uploads/'.$enc_class)){                
                    @mkdir('uploads/'.$enc_class.'/', 0666, true);  // Create non-executable upload folder(s) if needed.
                }
                

                if (move_uploaded_file($_FILES['myfile']['tmp_name'][$i],'uploads/'.$enc_class.'/'.$filename)) {
    
                    $sql2 = "INSERT INTO files(id,name,post_id,class_code) VALUES ('$randFileID','$filename','$randPostID','$class_code')";
                    if (mysqli_query($con, $sql2)) {
                        //echo "File uploaded successfully";
                        header("Location: class.php?did=".urlencode($enc_class)."");
                        
                    }
                } else {
                    echo "Failed to upload file.";
                    
                }
                
            }
        }
        
    } else {
        header("Location: class.php?did=".urlencode($enc_class)."");
    }
    
}