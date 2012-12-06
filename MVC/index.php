<?php

require_once(dirname(_FILE_).'/config.php');
require_once(dirname(_FILE_).'/Model.php');
require_once(LIBS_DIR . '/TnkMail.php');
require_once(LIBS_DIR . '/functions.php');
//require('test.shtml');

$dbconnect = new Model(DB_HOST,DB_NAME,DB_USER,DB_PASS);

$cityArr = $dbconnect->getAllCity();

$checkedarr = array();

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
        $name = $_POST['cust_name'];
        $add = $_POST['cust_add2'];
        $comt = $_POST['comment'];
        send_enq($name,$add,$comt);
        send_conf($name,$add,$comt);
        require_once(dirname(_FILE_).'/done.php');

        exit();
    }
}

$dbconnect->closeConnection();
require(TEMPLATE_DIR . '/index.html.php');


