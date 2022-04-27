<?php
session_start();

    include("includes/connection.php");
    include("includes/functions.php");

    $user_data= check_login($con);

?>

<?php

if(isset($_GET['did'])) {
    $enc_class = mysqli_real_escape_string($con, $_GET['did']);
    $leave_class = decrypt($enc_class);
    
    $user_id = $user_data['User_ID'];
    $sql = mysqli_query($con, "delete from relations where class_code = '".$leave_class."' and user_id = '".$user_id."'");


    if(isteacher($leave_class, $user_id, $con)){
        mysqli_query($con, "SET FOREIGN_KEY_CHECKS=0;");
        $sql2 = mysqli_query($con, "delete from classes where code = '".$leave_class."'");
        mysqli_query($con, "SET FOREIGN_KEY_CHECKS=1;");

    }


    if($sql) {
        //echo "<br/><br/><span>You left successfully...!!</span>";
        header("Location: classes.php");
    } else {
        echo "ERROR";
    }
}

?>