<?php
//echo "AAAAAAAAAAAAAAAA";
require_once("Model.php");

//echo "BBBBBBBBBBBBBBBBB";
/*if(isset($_POST['reply'])){
    foreach ($_POST['reply'] as $key => $val) {
        $mailId =  $key;
    }*/


//echo "BBCCCCCCCCCCCBBBB";
$dbconnect = new Model('localhost','mailform','root', 'root');
if (! isset($_GET['id'])) {
//    echo "no mail with id";
    exit();
}
$mailArr = $dbconnect->getMailById($_GET['id']);

//var_dump($mailArr);
if (! $mailArr) {
    echo "no mail with id";
    exit();
}

require_once("libs/TnkMail.php");
require_once('libs/aaa.php');
//echo "DDDDDDDDDDDBBBBBB";
//var_dump($mailArr);



//echo "tesdt";


function sendmail($from, $to, $subject, $message ){
        echo "aaaa";
        $tmail = new TnkMail('utf-8');
        $tmail->to = $to;
        $tmail->sender = $from;
        $tmail->subject = $subject;
        $tmail->message = $message;
        $tmail->send();
}


//var_dump($_POST);

if(isset($_POST['submit'])){
    $mail = $dbconnect->getMailById($_GET['id']);
    foreach($mail as $m=>$val)
        $to = $val['cust_add'];

    $message = $_POST['reply_content'];
    sendmail("ares7760@yahoo.com",$to,"Reply mail",$message);
  }


require("./views/sendmail.html.php");

