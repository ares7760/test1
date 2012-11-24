<?php
require_once(dirname(__FILE__) . "config.php");
require_once(dirname(__FILE__) . "Model.php");
require_once(LIBS_DIR . 'functions.php');

$dbconnect = new Model(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$cityArr = $dbconnect->getAllCity();

$checkedarr = array();




$mailArr = $dbconnect->getAllMail();

if(isset($_POST['filter']))
{

    if (isset($_POST['city'])) {
        foreach ($_POST['city'] as $key => $val) {
             $checkedarr[] = $key;
        }
    }
    $mailArr = $dbconnect->getMailByCity($checkedarr);
}
//var_dump($mailArr);
if(isset($_POST['reply']))
{
    require_once("sendmail.php");
    exit();
}



$dbconnect->closeConnection() ;
require("./views/admin.html.php");

