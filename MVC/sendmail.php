<?php

//require("TnkMail.php");

function sendmail($from, $to, $subject, $message ){
        echo "aaaa";
        $tmail = new TnkMail(BASE_CODE);
        $tmail->to = $to;
        $tmail->sender = $from;
        $tmail->subject = $subject;
        $tmail->message = $message;
        $tmail->send();
}

/*
if(isset($_POST['submit'])){
    if(sendmail("test@yahoo.com","ares7760@yahoo.com","test","This mail for test only"))
        echo "sucessfull";
    else
        echo "error";
}
 */


require("./views/sendmail.html.php");

?>
