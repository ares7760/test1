<?php
     $cityarr = array();
     $count = count($_POST['city']);
     foreach ($_POST['city'] as $key => $val)
     {
            $cityarr[] = $key;
     }

    // Connection data (server_address, database, username, password)
    $hostdb = 'localhost';
    $namedb = 'testmail';
    $userdb = 'root';
    $passdb = 'root';

    try {
            $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();

            $sql = "insert into mail(cust_name,cust_add,comment) values(:cust_name,:cust_add,:comment)";
            $sqlprep = $dbh->prepare($sql);
            $ar_val = array('cust_name'=>$_POST[cust_name], 'cust_add'=>$_POST[cust_add2],'comment'=>$_POST[comment]);
            $sqlprep->execute($ar_val );

            $lastmailID = $dbh-> lastInsertId();
            if ($count != 0)
            {
                foreach($cityarr as $c)
                {
                    $sql = "select cityID from city where cityID='$c'";
                    $statement= $dbh->query($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    while($row = $statement->fetch())
                    {
                        $t = $row[cityID];
                        echo $t;
                    }
                    $sql = "insert into mail_city(mailID,cityID) values(:lastmailid,:t)";
                    $sqlprep = $dbh->prepare($sql);
                    $ar_val = array('lastmailid'=>$lastmailID,'t'=>$t);
                    $sqlprep->execute($ar_val );
 //                 $dbh->exec("insert into mail_city(mailID,cityID) values($lastmailID,$t)");
                }
            }
            $dbh->commit();
        } catch (Exception $e)
        {
            $dbh->rollBack();
            echo $sql;
            echo "Failed: " . $e->getMessage();
        }

        $dbh = null;
        require("./views/done.html.php");

?>

