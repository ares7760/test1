<?php
     require_once(dirname(_FILE_).'/config.php');
     require_once(dirname(_FILE_).'/Model.php');
     echo "here1";
     $cityarr = array();
     $count = count($_POST['city']);
     foreach ($_POST['city'] as $key => $val)
     {
            $cityarr[] = $key;
     }
     echo "here2";
     $now = getdate();
     $currentDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];
     $dbconnect = new Model(DB_HOST,DB_NAME,DB_USER,DB_PASS);
     if(isset($_POST['cust_name']) && isset($_POST['cust_add2']) && isset($_POST['comment'])){
        $dbconnect->saveData($_POST['cust_name'],$_POST['cust_add2'],$_POST['comment'],$cityarr,$currentDate);
     }
     echo "here3";
     $dbconnect->closeConnection();
     require(TEMPLATE_DIR . '/done.html.php');

