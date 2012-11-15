<?php
if($_POST['submitted']==1){
    $errormsg="";
    if($_POST[cust_name]){
        $cust_name=$_POST[cust_name];
    }
    else{
        $errormsg="お名前を入力してください";
    }
    if($_POST[cust_add1] && $_POST[cust_add2]){
        $cust_add1=$_POST[cust_add1];
        $cust_add2=$_POST[cust_add2];
        if ($cust_add1 != $cust_add2)
             $errormsg="メールを確認してください";

    }
    else{
        if($errormsg){
            $errormsg=" メール ＆".$errormsg;
        }else{
            $errormsg="メールを確認してください";
        }
    }
    if($_POST[comment]){
        $comment=$_POST[comment];
    }
     else{
        if($errormsg){
            $errormsg=" 内容 ＆ ".$errormsg;
        }else{
            $errormsg="内容を入力してください";
        }
     }
    if (count($_POST["city"]) > 0) {
        $cities=array();
        foreach ($_POST["city"] as $citi) {
            $cities[]=$citi;
        }
    }
    else{
        if($errormsg){
            $errormsg=" 都市 ＆ ".$errormsg;
        }else{
            $errormsg="都市を選んでください";
        }
     }


    if ($errormsg){ //If any errors display them
        echo $errormsg;
    } else {
        require_once("test3.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
.ok{
    text-decoration : blind;
    color : black;
}
.er{
    text-decoration : underline ;
    color : red;
}
</style>
</head>
<body>
<form action="" method="post" id="inquiry_form" >
<table id="customer_info" style="text-align:left;">
	<tr><th><label for="cust_name">お名前</label></th>
    <td><input id="cust_name" type="text" name="cust_name" value="<?php echo $_POST['cust_name'] ?>" style="width:350px" />

            <input type="hidden" name="type" value="inquiry" /></td>
    </tr>
	<tr><th><label for="cust_add1">メールアドレス</label></th>
        <td>
            <input id="cust_add1" style="ime-mode:disabled;width:350px;" type="text" name="cust_add1"  value="<?php echo $_POST['cust_add1'] ?>"/>
        </td>
    </tr>
	<tr><th><label for="cust_add2">メールアドレス(確認用)</label></th>
        <td><input id="cust_add2" style="ime-mode:disabled;width:350px;" type="text" name="cust_add2"  value="<?php echo $_POST['cust_add2'] ?>"/></td>
    </tr>
  	<tr><th>滞在都市(複数選択可)</th>
    <td>
        <input type="checkbox" name="city[]" value="Hcm">ホーチミン 
        <input type="checkbox" name="city[]" value="Hanoi">ハノイ 
        <input type="checkbox" name="city[]" value="Hue">フェ 
        <input type="checkbox" name="city[]" value="Danang">ホイアン
    </td>
    </tr>
 

    <tr><th>
          <?php if ($errormsg) { ?>
            <label for="comment" class="er">お問い合わせ内容</label></th>
          <?php } else { ?>
            <label for="comment" class="ok">お問い合わせ内容</label></th>
          <?php } ?>
    </label></th>
    <td>
        <textarea id="comment" name="comment" rows="10" style="width:350px" value="<?php echo $_POST['comment']?>" ></textarea>
    </td>
    </tr>
    <tr><th></th><td>再度内容をご確認の上、送信ボタンを押してください。</td>
    </tr>
    <input type="hidden" name="submitted" value="1">
    <tr><td colspan="2" align="right">
        <input type="submit" value="submit">
    </td>
    </tr>
</table>


</form>
</body>
</html>
