<?php
//    var_dump($_POST['city']);
     require_once("Model.php");

     $cityarr = array();
     $count = count($_POST['city']);
//     echo $count;
     foreach ($_POST['city'] as $key => $val)
     {
            $cityarr[] = $key;
     }

     $now = getdate(); 
     $currentDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];
//     echo $currentDate;
	
     $dbconnect = new Model('localhost','mailform','root', 'root');
     if(isset($_POST['cust_name']) && isset($_POST['cust_add2']) && isset($_POST['comment'])){
	     $dbconnect->saveData($_POST['cust_name'],$_POST['cust_add2'],$_POST['comment'],$cityarr,$currentDate);
     }
     $dbconnect->closeConnection();
    require("./views/done.html.php");
    
?>

