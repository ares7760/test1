<?php
 $expected = array('data1','data2','data3','data4');
 $required = array('data1','data2','data3');
 $errors = array();
 if (in_array($expected, $required)){
     echo "aaaa";
 }else echo "cccc";
?>
