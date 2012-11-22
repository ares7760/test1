<?php
require("Model.php");

$dbconnect = new Model('localhost','testmail','root', 'root');
$cityArr = $dbconnect->getAllCity();
//var_dump($cityArr);

function createCityChecks($cities, $checkedarr) {
    $html = array();
    $i = 0;
    foreach ($cities as $key => $val) {
        $i++;
        $rtn = ($i == 5) ? "<br />" : "";
        if ($key !== null)
            $html[] = "<input id='city_{$val['cityID']}' name='city[{$val['cityID']}]' type='checkbox' val='{$val['cityID']}'";
        if (in_array($val['cityID'], $checkedarr)) {
           $html[] =" checked ";
        }
            $html[] ="/><label for='city_{$val['cityID']}'>{$val['cityName']}</label>{$rtn}";
    }
    return implode("\n", $html);
}


//$cities = array(11,2);
$mailArr = $dbconnect->getAllMail();

if(isset($_POST['filter']))
{
//    var_dump();
    $checkedarr = array();
    if (isset($_POST['city'])) {
        foreach ($_POST['city'] as $key => $val) {
             $checkedarr[] = $key;
        } 
    }
    $mailArr = $dbconnect->getMailByCity($checkedarr);
}

if(isset($_POST['reply']))
{
    require_once("sendmail.php");
}
require_once("./views/admin.html.php");
require("./views/sen.html.php");


$dbconnect->closeConnection() ;

?>
