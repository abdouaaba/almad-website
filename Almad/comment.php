<?php
session_start();

    include("includes/connection.php");
    include("includes/functions.php");

    $user_data= check_login($con);

    if(isset($_GET['cd']) && isset($_GET['did'])) {
        $enc_class = mysqli_real_escape_string($con, $_GET['cd']);
        $enc_post_id = mysqli_real_escape_string($con, $_GET['did']);
    
        $class_code = decrypt($enc_class);
        $postID = decrypt($enc_post_id);

        echo $class_code;
    }

?>
<?php



$commentID = randomNum();

$comment = $_REQUEST['userInput'];
$time = date('Y-m-d H:i:s');
$username = $user_data['Fullname'];


$sql = "INSERT INTO comments VALUES ('$commentID', '$postID', 
    '$comment', '$time', '$username')";


if(mysqli_query($con, $sql)){
    header("Location: class.php?did=".urlencode($enc_class)."");
} else{
    echo "ERROR: Sorry $sql. " 
        . mysqli_error($con);
}




?>