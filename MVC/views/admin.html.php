
<html>
</html>
<head>
</head>
<body>
<form action="" method="POST">
<table width="100%" border="0">
<tr><td><input name="filter" id="filter" type="submit" value="Filter"/></td>
<td>
<?php echo createCityChecks($cityArr, $checkedarr) ?>
</td>
</tr>
</table>
<table width="100%" border="1">
<tr>
<th>お名前</th>
<th>メールアドレス</th>
<th>内容</th>
<th>日付</th>
<th>返信</th>
</tr>
<?php  foreach ($mailArr as $key => $val) { ?>
    <tr><td><label for="cust_name" id="cust_name"><?php echo $val['cust_name'] ?></label></td>
    <td><label for="cust_add" id="cust_add"><?php echo $val['cust_add'] ?></label></td>
    <td><label for="comment" id="comment"><?php echo $val['comment'] ?></label></td>
    <td><label for="send_date" id="semd_date"><?php echo $val['send_date']?></label></td>
<!--    <td><input name='reply[<?php echo $val['mail_id'] ?>]' id='reply' type="submit" value="Reply"/></td> -->
    <td><a href="sendmail.php?id=<?php echo $val['mail_id'] ?>">reply</a></td>
    </tr>
<?php }?>
</table>
</form>
</body>

