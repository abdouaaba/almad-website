<?php
session_start();

    include("includes/connection.php");
    include("includes/functions.php");

    $user_data= check_login($con);

?>
<?php

$code = randomCode();
$title =  $_REQUEST['title'];
$description = $_REQUEST['description'];
$teacher = $user_data['Fullname'];
$teacher_id = $user_data['User_ID'];
$type =  $_REQUEST['type'];
$max_nb = NULL;
if ($type == "private") {
    $max_nb = $_REQUEST['max_nb'];
}

$sql = "INSERT INTO classes  VALUES ('$code', '$title', 
    '$description', '$teacher', '$teacher_id', '$type', '$max_nb')";

$sql2 = "INSERT INTO relations  VALUES ('teacher', '$teacher_id', 
    '$code')";

if(mysqli_query($con, $sql) && mysqli_query($con, $sql2)){
    echo "<h3>data stored in a database successfully. Here's your code : $code"; 
    $_SESSION['status'] = 'Class created succefully';
    $_SESSION['status_text'] = "Class code: $code";
    $_SESSION['status_code'] = 'success';
    header("Location: classes.php");
} else{
    echo "ERROR: Sorry $sql. " 
        . mysqli_error($con);
}

mysqli_close($con);

?>