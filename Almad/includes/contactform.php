<?php

    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $emailfrom = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $mailTo = "almadelearning@gmail.com";
        $headers = "From: ".$emailfrom;
        $txt = "You have received an e-mail from ".$name.".\n\n".$message;

        mail($mailTo,$subject,$txt,$headers);
        header(dirname("index.php") );
    }

    

?>