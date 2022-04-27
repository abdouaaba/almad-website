<?php
session_start();

    include("includes/connection.php");
    include("includes/functions.php");

    $user_data= check_login($con);

?>

<?php

if(isset($_GET['cd']) && $_GET['did']) {
    $enc_class = mysqli_real_escape_string($con, $_GET['cd']);
    $enc_post_id = mysqli_real_escape_string($con, $_GET['did']);

    $remove_post = decrypt($enc_post_id);
    $user_id = $user_data['User_ID'];
    mysqli_query($con, "SET FOREIGN_KEY_CHECKS=0;");
    $sql = mysqli_query($con, "delete from posts where id = '".$remove_post."';");
    mysqli_query($con, "SET FOREIGN_KEY_CHECKS=1;");
    if($sql) {
        //echo "<br/><br/><span>You left successfully...!!</span>";
        header("Location: class.php?did=".urlencode($enc_class)."");
    } else {
        echo "ERROR";
    }
}

?>