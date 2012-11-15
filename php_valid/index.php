<?php
if($_POST['submitted']==1){
    $errormsg="";
    if($_POST[title]){
        $title=$_POST[titlte];
    }
    else{
        $errormsg="Please enter title";
    }
    if($_POST[textentry]){
        $textentry=$_POST[textentry];
    }
    else{
        if($errormsg){
            $errormsg=$errormsg." & content ";
        }else{
            $errormsg="Please enter content";
        }
    }
    if ($errormsg){ //If any errors display them
        echo "<div class=\"box red\">$errormsg</div>";
    }
}
?>
