<?php
//echo "AAAAAAAAAAAAAAAA";
require_once(dirname(__FILE__) . '/config.php');
require_once(dirname(__FILE__) . "/Model.php");
require_once(dirname(__FILE__) . "/libs/TnkMail.php");
require_once(dirname(__FILE__) . '/libs/aaa.php');

//echo "BBBBBBBBBBBBBBBBB";
/*if(isset($_POST['reply'])){
    foreach ($_POST['reply'] as $key => $val) {
        $mailId =  $key;
    }*/


//echo "BBCCCCCCCCCCCBBBB";
if (! isset($_GET['id'])) {
//    echo "no mail with id";
    exit();
}

$dbconnect = new Model(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$mailArr = $dbconnect->getMailById($_GET['id']);

//var_dump($mailArr);
if (! $mailArr) {
    echo "no mail with id";
    exit();
}

//echo "DDDDDDDDDDDBBBBBB";
//var_dump($mailArr);



//echo "tesdt";



//var_dump($_POST);

if(isset($_POST['submit'])){
    $mail = $dbconnect->getMailById($_GET['id']);
    foreach($mail as $m=>$val)
        $to = $val['cust_add'];

    $message = $_POST['reply_content'];
    sendmail(MAIL_SENDER, $to, "Reply mail", $message);
  }


require("./views/sendmail.html.php");

