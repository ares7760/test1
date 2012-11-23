<?php
require_once("Model.php");

$dbconnect = new Model('localhost','mailform','root', 'root');
$cityArr = $dbconnect->getAllCity();

$checkedarr = array();

function createCityChecks($cities, $checkedarr) {
    $html = array();
    $i = 0;
    foreach ($cities as $key => $val) {
        $i++;
        $rtn = ($i == 5) ? "<br />" : "";
        if ($key !== null)
            $html[] = "<input id='city_{$val['city_id']}' name='city[{$val['city_id']}]' type='checkbox' val='{$val['city_id']}'";
        if (in_array($val['city_id'], $checkedarr)) {
           $html[] =" checked ";
        }
            $html[] ="/><label for='city_{$val['city_id']}'>{$val['city_name']}</label>{$rtn}";
    }
    return implode("\n", $html);
}



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


?>
