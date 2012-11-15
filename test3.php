<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
    foreach($field as $i)
        echo $i;
    echo "<table style='text-align:left;width:80%;'><tr colspan=2><label text-align='center'>ありがとうございます！</label></tr>";
    echo "<tr><th><label>お名前</label></th><td><label>".$_POST['cust_name']."</label></td></tr>";
    echo "<tr><th><label>メール</label></th><td><label>".$field[1]."</label></td></tr>";
    echo "<tr><th><label>都市</label></th><td><label>";
    foreach($cities as $citi){
        echo $citi." , ";
    }
    echo "</label></td></tr>";

    echo "<tr><th><label>内容</label></th><td><label>". preg_replace("/\n/", "<br />", $comment)."</label></td></tr>";
    echo "</table>";
?>
</body>
</html>
