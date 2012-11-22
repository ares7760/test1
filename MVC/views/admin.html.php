
<html>
</html>
<head>
</head>
<body>
<form action="" method="POST">
<table width="100%" border="1">
<tr><input name="filter" id="filter" type="submit" value="Filter"/>
<?php echo createCityChecks($cityArr, $checkedarr) ?>
</tr>
<?php  foreach ($mailArr as $key => $val) { ?>
    <tr><td><label for="cust_name" id="cust_name"><?php echo $val['cust_name'] ?></label></td>
    <td><label for="cust_add" id="cust_add"><?php echo $val['cust_add'] ?></label></td>
    <td><label for="comment" id="comment"><?php echo $val['comment'] ?><label>i</td>
    <td><input name="reply" id="reply" type="submit" value="Reply"/></td>
    </tr>
<?php }?>
</table>
</form>
</body>

