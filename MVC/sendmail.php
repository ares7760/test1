<?php
require_once(dirname(_FILE_).'/config.php');
require_once(dirname(_FILE_).'/Model.php');
require_once(LIBS_DIR . '/TnkMail.php');
require_once(LIBS_DIR . '/functions.php');

if(! isset($_GET['id'])) page_not_found();

$dbconnect = new Model(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$mail = $dbconnect->getMailById($_GET['id']);

if(! $mail) page_not_found();

if(is_post()){
    $to = $mail['cust_add'];
    $message = $_POST['reply_content'];
    sendmail(MAIL_SENDER,$to,"Reply mail for $mail[cust_name]",$message);
}


require(TEMPLATE_DIR . '/sendmail.html.php');

 
