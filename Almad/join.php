<?php
session_start();

    include("includes/connection.php");
    include("includes/functions.php");

    $user_data= check_login($con);

?>
<?php

$class_code = $_REQUEST['code'];
$user_id = $user_data['User_ID'];

$sql = "INSERT INTO relations VALUES ('student', '$user_id', '$class_code')";

if(check_code($class_code, $con)) {
    if(mysqli_query($con, $sql)){
        //echo "<h3>joined successfully."; 
        $_SESSION['status'] = 'Joined class succefully';
        $_SESSION['status_text'] = "";
        $_SESSION['status_code'] = 'success';
        header("Location: classes.php");
    } else{
        echo "ERROR: Sorry $sql. "
            . mysqli_error($con);
    }
} else {

    $_SESSION['status'] = 'Error';
    $_SESSION['status_text'] = "Class not found";
    $_SESSION['status_code'] = 'error';
    header("Location: classes.php");
}

mysqli_close($con);

?>