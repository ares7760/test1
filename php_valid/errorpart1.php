<?php
if($_POST['submitted']==1){
    $errormsg="";
    if($_POST[title]){
        $title=$_POST[title];
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
    }else {
        require_once("result.php");
        exit();
    }
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="content">
<form action="" method="POST" enctype="multipart/form-data">
    <h2>Title</h2>
    <input class="formitem" type="text" name="title"/>
    <br/><br/>
    <h2>Content</h2>
    <textarea class="formitem" name ="textentry" rows="3"></textarea>
    <input type="hidden" name="submitted" value="1">
    <br/><br/>
    <input type="submit" value="Submit"/>


</form>
</div>
</body>
</html>
