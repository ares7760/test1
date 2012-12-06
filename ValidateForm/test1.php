<?php
//var_dump($_POST);
if(isset($_POST['submitted'])&&($_POST['submitted']==1)){
    $expected = array("cust_name","cust_add1","cust_add2","city","comment");
    $required = array("cust_name","cust_add1","cust_add2","city","comment");
    $errors = array();
    $temp2 = array();


    foreach ($_POST as $field => $value){
        $temp = is_array($value) ? $value : trim($value);
        array_push($temp2,$temp);
        if (empty($temp) && in_array($field, $required)) {
            array_push($errors, $field);
        }
    }



    if (!in_array("cust_add1", $errors) && !in_array("cust_add2",$errors))
    {
      if( $_POST["cust_add1"]!=$_POST["cust_add2"]){
          array_push($errors, "not_match");
      }else if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$_POST["cust_add2"]))
          array_push($errors, "error_mail");
    }

     if (!in_array("cust_add1", $errors) && !in_array("cust_add2",$errors))
    {
      if( $_POST["cust_add1"]!=$_POST["cust_add2"]){
          array_push($errors, "not_match");
      }else if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$_POST["cust_add1"]))
          array_push($errors, "error_mail2");
    }

     $checkedarr = array();
     $count = count($_POST['city']);
     for ($i = 0; $i < $count; $i++) {
//      echo $_POST['city'][$i];
        array_push($checkedarr, $_POST['city'][$i]);
    }

     foreach($checkedarr as $ch){
         echo $ch." ";
     }

//     if(in_array("Hue",$checkedarr))
//         echo"ok aaa";

    if (empty($errors)){
        require_once("test2.php");
        exit();
    }
}

?>


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
        <td>
        <input type="checkbox" name="city[]" value="Hcm" <?php if(in_array("Hcm",$checkedarr)) echo "checked"?>>ホーチミン 
            <input type="checkbox" name="city[]" value="Hanoi" <?php if(in_array("Hanoi",$checkedarr)) echo "checked"?>>ハノイ 
            <input type="checkbox" name="city[]" value="Hue" <?php if(in_array("Hue",$checkedarr)) echo "checked"?>>フェ 
            <input type="checkbox" name="city[]" value="Hoian" <?php if(in_array("Hoian",$checkedarr)) echo "checked"?>>ホイアン

    </td></tr>
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
</body>
</html>
