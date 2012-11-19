<?php
    $dsn = 'mysql:dbname=testmail;host=127.0.0.1';
    $user = 'root';
    $password = 'root';

    try {
        $dbh = new PDO($dsn, $user, $password);
    }catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    $result = $dbh->exec("insert into city(cityName) values('Hanoi')");
    $sql = 'select * from city';
    foreach ($dbh->query($sql) as $row) {
        print $row['cityID'] . "\t";
        print $row['cityName'] . "\t";
    }
?>
