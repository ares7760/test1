<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css"></head>
<body>
<form action="" method="post" id="inquiry_form">
<table id="customer_info" style="text-align:left;">
    <tr><th><label for="cust_name">お名前</label></th>
        <td><input id="cust_name" type="text" name="cust_name" style="width:350px" value="<?php if(isset($_POST['cust_name'])) echo $_POST['cust_name']?>"/>
    </td></tr>
    <tr><th></th><td><?php if (isset($errors) && in_array('cust_name', $errors)){?>
    <div class="red">Please enter name</div>
    <?php } ?> </td>
</tr>
    <tr><th><label for="cust_add1">メールアドレス</label></th>
        <td>
            <input id="cust_add1" style="ime-mode:disabled;width:350px;" type="text" name="cust_add1" value="<?php if(isset($_POST['cust_add1'])) echo $_POST['cust_add1']?>" />
    </td></tr>
    <tr><th></th><td><?php if (isset($errors) && in_array('cust_add1', $errors)){?>
    <div class="red">Please enter email address</div>
    <?php } ?> </td></tr>
    <tr><th></th><td><?php if (isset($errors) && in_array('error_mail', $errors)){?>
    <div class="red">Email pattern not valid</div>
    <?php } ?> </td></tr>


    <tr><th><label for="cust_add2">メールアドレス(確認用)</label></th>
    <td><input id="cust_add2" style="ime-mode:disabled;width:350px;" type="text" name="cust_add2" value="<?php if(isset($_POST['cust_add2'])) echo $_POST['cust_add2']?>" /></td></tr>
    <tr><th></th><td><?php if (isset($errors) && in_array('cust_add2', $errors)){?>
    <div class="red">Please enter email address</div>
    <?php } ?> </td></tr>

     <tr><th></th><td><?php if (isset($errors) && in_array('error_mail2', $errors)){?>
    <div class="red">Email pattern not valid</div>
    <?php } ?> </td></tr>


    <tr><th></th><td><?php if (isset($errors) && in_array('not_match', $errors)){?>
    <div class="red">Please review email address</div>
    <?php } ?> </td></tr>

    <tr><th>滞在都市(複数選択可)</th>
        <td><?php echo createCityChecks($cityArr, $checkedarr) ?></td></tr>
        
    <tr><th></th><td><?php if (isset($errors) && in_array('no_city', $errors)){?>
    <div class="red">Please select cities</div>
    <?php } ?> </td></tr>

    <tr><th><label for="comment">お問い合わせ内容</label></th>
        <td>
            <textarea id="comment" name="comment" rows="10" style="width:350px" value="<?php if(isset($_POST['comment'])) echo $_POST['comment']?>"><?php if(isset($_POST['comment'])) echo $_POST['comment']?></textarea>
    </td></tr>
    <tr><th></th><td>	<?php if (isset($errors) && in_array('comment', $errors)){?>
    <div class="red">Please enter comment</div>
    <?php } ?> </td></tr>
    <tr><th></th><td>再度内容をご確認の上、送信ボタンを押してください。</td></tr>
        <input type="hidden" name="submitted" value=1>
    <tr><td colspan="2"  align="right">
    <input name="submit" id="submit" type="submit" value="Submit" />
        </td></tr>
</table>
</form>
<?php
require("Model.html.php");
$dbconnect = new Model('localhost','testmail','root', 'root');
$result = $dbconnect->getMail(5);
echo "hello world";
echo $result;
?>
</body>
</html>
