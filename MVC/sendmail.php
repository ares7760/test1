<?php
require_once(dirname(__FILE__) . '/config.php');
require_once(dirname(__FILE__) . "/Model.php");
require_once(dirname(__FILE__) . "/libs/TnkMail.php");
require_once(dirname(__FILE__) . '/libs/functions.php');

if (! isset($_GET['id'])) {
//    echo "no mail with id";
    exit();
}

$dbconnect = new Model(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$mailArr = $dbconnect->getMailById($_GET['id']);

if (! $mailArr) {
    echo "no mail with id";
    exit();
}

if(isset($_POST['submit'])){
    $mail = $dbconnect->getMailById($_GET['id']);
    foreach($mail as $m=>$val)
        $to = $val['cust_add'];

    $message = $_POST['reply_content'];
    sendmail(MAIL_SENDER, $to, "Reply mail", $message);
  }


require("./views/sendmail.html.php");

