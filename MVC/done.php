<?php
//    var_dump($_POST['city']);
     $cityarr = array();
     $count = count($_POST['city']);
     echo $count;
     foreach ($_POST['city'] as $key => $val)
     {
            $cityarr[] = $key;
     }

    require_once("Model.php");

    $dbconnect = new Model('localhost','testmail','root', 'root');
    $dbconnect->saveData($_POST[cust_name],$_POST[cust_add2],$_POST[comment],$cityarr);
    $dbconnect->closeConnection();
    require("./views/done.html.php");
    
?>

