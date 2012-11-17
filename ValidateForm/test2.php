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

     $cityarr = array();
     $count = count($_POST['city']);
     for ($i = 0; $i < $count; $i++) {
        array_push($cityarr, $_POST['city'][$i]);
    }

    $dsn = 'mysql:dbname=testmail;host=127.0.0.1';
    $user = 'root';
    $password = 'root';

    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    
    try {
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $dbh->beginTransaction();
        $dbh->exec("insert into mail(cust_name,cust_add,comment)values('$_POST[cust_name]','$_POST[cust_add2]','$_POST[comment]')");
        $lastmailID = $dbh-> lastInsertId();
        if ($count != 0){
            foreach($cityarr as $c){
                $statement= $dbh->query("select cityID FROM city where cityName='$c'");
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()){
                 $t = $row[cityID];
                 echo $t;
                 }

                $dbh->exec("insert into mail_city(mailID,cityID) values($lastmailID,$t)");
            }
        }
        $dbh->commit();
    } catch (Exception $e) {
        $dbh->rollBack();
        echo "Failed: " . $e->getMessage();
    }

//    $dbh->exec("insert into mail_city(mail_id,mail_city)values('$_POST[cust_name]','$_POST[cust_add2]','$_POST[comment]')");

    /* Return number of rows that were deleted */
//    echo $lastmailID;
    $dbh = null;

?>
</body>
</html>
