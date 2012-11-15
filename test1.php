<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table id="customer_id">
<tr>
	<th><label>お名前</label></th>
	<td><input id="cus_name" type="text" name="cust_name"/></td>>
</tr>
<tr>
	<th><label>メール</label></th>
	<td><input id = "cust_mail1" type="text" name="cust_mail1" /></td>
</tr>
<tr>
	<th><label>メール確認</label></th>
	<td><input id="cust_mail2" type="text" name="cust_name2"/></td>
</tr>

<tr>
<th rowspan=2><label>都市</label></th>
<td>
	<input type="checkbox" name="Hcm" value="Hcm">ホーチミン <br>
	<input type="checkbox" name="Hanoi" value="Hanoi">ハノイ <br>
	<input type="checkbox" name="Hue" value="Hue">フェ <br>
	<input type="checkbox" name="Danang" value="Danang">ホイアン
</td>
</tr>
<tr>
	<input type="checkbox" name="Nhatrang" value="Nhatrang">ニャチャン <br>
	<input type="checkbox" name="Muine" value="Muine">ムイネー<br>
	<input type="checkbox" name="diff" value="diff">他
</tr>
<th><label>内容</label></th>
<td><textarea id="content" row=10 name="content"><textarea></td>
</tr>
</table>
</body>
</html>
