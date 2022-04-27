<?php
session_start();

    include("includes/connection.php");
    include("includes/functions.php");

    $user_data= check_login($con);

?>

<?php

if(isset($_GET['cd']) && isset($_GET['did'])) {
    $enc_class = mysqli_real_escape_string($con, $_GET['cd']);
    $enc_std_id = mysqli_real_escape_string($con, $_GET['did']);

    $class_code = decrypt($enc_class);
    $remove_student = decrypt($enc_std_id);

    $user_id = $user_data['User_ID'];
    $sql = mysqli_query($con, "delete from relations where user_id = '".$remove_student."' and class_code = '".$class_code."';");
    if($sql) {
        //echo "<br/><br/><span>You left successfully...!!</span>";
        header("Location: class.php?did=".urlencode($enc_class)."");
    } else {
        echo "ERROR";
    }
}

?>