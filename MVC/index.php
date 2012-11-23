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


if(isset($_POST['submit'])){
    $required = array("cust_name","cust_add1","cust_add2","city","comment");
    $errors = array();
    $temp2 = array();

    foreach ($_POST as $field => $value){
        $temp = is_array($value) ? $value : trim($value);
        array_push($temp2,$temp);
        if (empty($temp) && in_array($field, $required)) {
            array_push($errors, $field);
        }
    }


    if (!in_array("cust_add1", $errors) && !in_array("cust_add2",$errors))
    {
      if( $_POST["cust_add1"]!=$_POST["cust_add2"])
          array_push($errors, "error_mail");
      else if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$_POST["cust_add1"]))
          array_push($errors, "error_mail");
      else if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$_POST["cust_add2"]))
          array_push($errors, "error_mail");
    }
    else
    {
        array_push($errors, "error_mail");
    }
    
    if (isset($_POST['city'])) {
         foreach ($_POST['city'] as $key => $val) {
             $checkedarr[] = $key;
         }
    }

    if(count($checkedarr) == 0) array_push($errors, "no_city");


    if (empty($errors)){
        require_once("done.php");
        exit();
    }
}

$dbconnect->closeConnection();
require("./views/index.html.php");

?>
