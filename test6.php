<?php
 $expected = array("cust_name","cust_add1","cust_add2","Array","comment");
 $required = array("cust_name","cust_add1","cust_add2","Array","comment");

 $errors = array();
 $post = array("Griffin"=>array
  (
  "Peter",
  "Lois",
  "Megan"
  ),"cust_name"=> "qrt", "cust_add1"=>"ares7760@yahoo.com", "cust_add2"=>"ares7760@yahoo.com");

 foreach ($post as $field => $value){
        $temp = is_array($value) ? $value : trim($value);
        if (empty($temp) && in_array($field, $required)) {
            array_push($errors, $field);
         }
         echo $temp;

    }

 foreach ($errors as $e){
    echo $e;
 }


?>
