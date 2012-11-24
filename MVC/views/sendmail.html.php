<html>
<head>
</head>
<body>

<form action="" method="POST">

<table id="customer_info" style="text-align:left;">
    <tr>
    <th><label for="cust_name">お名前</label></th>
    <td><input id="cust_name" type="text" name="cust_name" style="width:350px" value="<?php echo $mail['cust_name'] ?>" disabled="disabled"/></td>
    </tr>

    <tr>
    <th><label for="cust_add">メールアドレス</label></th>
    <td><input id="cust_add" style="ime-mode:disabled;width:350px;" type="text" name="cust_add" value= "<?php echo $mail['cust_add'] ?>" disabled="disabled" /></td>
    </tr>


    <tr>
    <th><label for="comment">お問い合わせ内容</label></th>
    <td><textarea id="comment" name="comment" rows="10" style="width:350px" value="<?php echo $mail['comment'] ?>" disabled="disabled"><?php echo $mail['comment'] ?></textarea></td>
    </tr>

    <tr>
    <th><label for="reply">回答</label></th>
    <td><textarea id="reply_content" name="reply_content" rows="10" cols="30" style="width:350px"></textarea></td>
    </tr>


    <tr><td colspan="2"  align="right">
    <input name="submit" id="submit" type="submit" value="送信する" /></td>
    </tr>

  </table>
</form>


</body>
</html>
