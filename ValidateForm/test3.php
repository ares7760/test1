<?php

    $dsn = 'mysql:dbname=testmail;host=127.0.0.1';
    $user = 'root';
    $password = 'root';

    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    echo '<input name="filter" id="filter" type="submit" value="Filter"/><input type="checkbox" name="city[]" value="Hcm">ホーチミン';
    echo '<input type="checkbox" name="city[]" value="Hanoi">ハノイ';
    echo '<input type="checkbox" name="city[]" value="Hue">フエ';
    echo '<input type="checkbox" name="city[]" value="Hoian">ホイアン';
//    echo '<table width="100%" border="0"><tr>';
//    echo '<td width="20px"></td>';
//    echo '<td align="left"><strong>Title</strong></td>';
//    echo '<td align="center" width="125px"><strong>Posted</strong></td>';

//    $sql    = "select cust_name, cust_add, comment from mail";
//    $rows   = $dbh->fetch_array($sql);
    echo '<form action="test4.php" method="post">';
    echo '<table width="100%" border="1">';
    $statement= $dbh->query("select cust_name, cust_add, comment from mail");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $statement->fetch()){
        echo "<tr>";
        echo "<td>".$row[cust_name]."</td>";
        echo "<td>".$row[cust_add]."</td>";
        echo "<td>".$row[comment]."</td>";
        echo '<td><input name="submit" id="submit" type="submit" value="Reply"/></td>';
        echo "</tr>";
//        echo $row[cust_name]."::::".$row[cust_add]."::::".$row[comment];
    }
    echo '</table></form>';
    $dbh = null;

    
//    foreach($rows as $key=>$record) {
//        echo $rows[cust_name]."::::".$rows[cust_add]."::::"$rows[comment]."::::";
/*    echo <tr bgcolor="#AEDEFF" >' : '<tr>';
    echo '<td align="left">/td>';
    echo '<td align="left"</td>';
    echo '<td align="center">'</td></tr>'; */
//}
//echo '</table>';
?>

