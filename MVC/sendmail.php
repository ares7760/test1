<?php
require_once(dirname(__FILE__) . '/config.php');
require_once(dirname(__FILE__) . "/Model.php");
require_once(LIBS_DIR . "TnkMail.php");
require_once(LIBS_DIR . 'functions.php');

if (! isset($_GET['id'])) page_not_found();

$dbconnect = new Model(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$mailArr = $dbconnect->getMailById($_GET['id']);

if (! $mailArr) page_not_found();

if(isset($_POST['submit'])){
    foreach($mailArr as $m=>$val) {
        $to = $val['cust_add'];
    }
    $message = $_POST['reply_content'];
    sendmail(MAIL_SENDER, $to, "Reply mail", $message);
}


require(TEMPLATE_DIR . "sendmail.html.php");

