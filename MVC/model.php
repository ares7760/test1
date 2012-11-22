<?php
class Model{
    var $conn;
    var $tblCity;
    var $tblMail;
    var $tblMailCity;
    var $debug = true;
    function Model($hostdb,$dbname,$username,$password)
    {
        try
        {
            $this->conn =new PDO("mysql:host=$hostdb; dbname=$dbname", $username, $password);
//            if ($this->debug) echo "successful connection";
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
    }

    function query($sql)
    {
        $result = $this->conn->query($sql);
        return $result;
    }

    function fetch($sql) {
          $data = ARRAY();
          $result = $this->query($sql);
 
          WHILE($row = MYSQL_FETCH_ASSOC($result)) {
               $data[] = $row;
          }
               RETURN $data;
    }

    function getAllMail()
    {
        $sql = "select cust_name,cust_add,comment from mail";
        $result = $this->query($sql);
        $mailArr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($mailArr, $row);
        }
        return $mailArr;
    }

    function getCity($cityId)
    {
        $sql = "select * from city where cityID = $cityId";
//        echo $sql;
//        var_dump($dbconnect);
//        var_dump($result);
        $result = $thist->query($sql);
        foreach($result as $row)
            return $row['cityID'];
    }

    function getAllCity(){
        $sql = "select cityID,cityName from city ";
        $result = $this->query($sql);
        $cityArr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($cityArr, $row);
        }
        return $cityArr;
    }

    function getMailByCity($city){
        $city_str = implode(',', $city);
//        echo $city_str;
        $sql = "select mail.cust_name,mail.cust_add, mail.comment from mail left join mail_city on mail.mailID = mail_city.mailID where mail_city.cityID in (".$city_str.")";
//        echo $sql;
        $result = $this->query($sql);
        $mailArr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($mailArr, $row);
        }
        return $mailArr;
    }

    function saveData($custName,$custAdd,$comment,$cityArr){
    try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->beginTransaction();

            $sql = "insert into mail(cust_name,cust_add,comment) values(:cust_name,:cust_add,:comment)";
            echo $sql;
            $sqlprep = $this->conn->prepare($sql);
            $ar_val = array('cust_name'=>$custName, 'cust_add'=>$custAdd,'comment'=>$comment);
            var_dump($sqlprep->execute($ar_val));

            $lastmailID = $this->conn->lastInsertId();
            echo $lastmailID;
            var_dump($lastmailID);
            var_dump($this->conn);
            if ($count != 0)
            {
                foreach($cityArr as $c)
                {
                    $sql = "select cityID from city where cityID='$c'";
                    $statement= $this->conn->query($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    while($row = $statement->fetch())
                    {
                        $t = $row[cityID];
                        echo $t;
                    }
                    $sql = "insert into mail_city(mailID,cityID) values(:lastmailid,:t)";
                    $sqlprep = $this->conn->prepare($sql);
                    $ar_val = array('lastmailid'=>$lastmailID,'t'=>$t);
                    $sqlprep->execute($ar_val );
                    $this->conn->exec("insert into mail_city(mailID,cityID) values($lastmailID,$t)");
                }
            }
            $this->conn->commit();
        } catch (Exception $e)
        {
            echo $sql;
            echo "Failed: " . $e->getMessage();
            $this->conn->rollBack();
        }

    }

    function closeConnection(){
        $this->conn = null;
    }
}

?>

