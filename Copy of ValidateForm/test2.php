<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
    echo "<table style='text-align:left;width:80%;'><tr colspan=2><label text-align='center'>ありがとうございます！</label></tr>";
    echo "<tr><th><label>お名前</label></th><td><label>".$_POST['cust_name']."</label></td></tr>";
    echo "<tr><th><label>メール</label></th><td><label>".$_POST['cust_add1']."</label></td></tr>";
    echo "<tr><th><label>都市</label></th><td><label>";
    foreach($_POST['city'] as $ct){
        echo $ct." ";
    }
    echo "</label></td></tr>";

    echo "<tr><th><label>内容</label></th><td><label>". preg_replace("/\n/", "<br />", $_POST['comment'])."</label></td></tr>";
    echo "</table>";

    $email_to = "xxxxx@yahoo.com";
    $email_subject = "test";

    $name = $_POST['cust_name']; // required
    $email_from = $_POST['cust_add2']; // required
    $comments = $_POST['comment']; // required

    $email_message .= "First Name: ".clean_string($cust_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Comment: ".clean_string($comments)."\n";
    mail($email_to, $email_subject, $email_message);

  ?>
?>
</body>
</html>
