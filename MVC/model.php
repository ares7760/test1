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

    function fetch($sql, $params) {
        $sth = $this->conn->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll();
    }

    function getAllMail()
    {
        $sql = "select mail_id,cust_name,cust_add,comment,send_date from mails";
        $result = $this->query($sql);
        $mailArr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($mailArr, $row);
        }
        return $mailArr;
    }

    function getMailById($mailId)
    {
        $sql = "select mail_id,cust_name,cust_add,comment,send_date from mails where mail_id = ".$mailId;
        $result = $this->query($sql);
        $mailArr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($mailArr, $row);
        }
        return $mailArr[0];
    }

    function getCity($cityId)
    {
        $sql = "select * from cities where city_id = $cityId";
//        echo $sql;
//        var_dump($dbconnect);
//        var_dump($result);
        $result = $thist->query($sql);
        foreach($result as $row)
            return $row['cityID'];
    }

    function getAllCity(){
        $sql = "select city_id,city_name from cities ";
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
        $sql = "select distinct mails.mail_id,mails.cust_name,mails.cust_add, mails.comment, mails.send_date from mails left join mail_city on mails.mail_id = mail_city.mail_id where mail_city.city_id in (".$city_str.")";
        echo $sql;
        $result = $this->query($sql);
        $mailArr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($mailArr, $row);
        }
        return $mailArr;
//        var_dump($mailArr);
    }

    function saveData($custName,$custAdd,$comment,$cityArr,$date){
    try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->beginTransaction();

            $sql = "insert into mails(cust_name,cust_add,comment,send_date) values(:cust_name,:cust_add,:comment,:send_date)";
 //           echo $sql;
            $sqlprep = $this->conn->prepare($sql);
            $ar_val = array('cust_name'=>$custName, 'cust_add'=>$custAdd,'comment'=>$comment,'send_date'=>$date);
            $sqlprep->execute($ar_val);

            $lastmailID = $this->conn->lastInsertId();
//	    echo $lastmailID;
	    $count = count($cityArr);
//            var_dump($lastmailID);
//            var_dump($this->conn);
            if ($count != 0)
            {
                foreach($cityArr as $c)
                {
                    $sql = "select city_id from cities where city_id='$c'";
                    $statement= $this->conn->query($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    while($row = $statement->fetch())
                    {
                        $t = $row['city_id'];
//                        echo $t;
                    }
                    $sql = "insert into mail_city(mail_id,city_id) values(:lastmailid,:t)";
                    $sqlprep = $this->conn->prepare($sql);
                    $ar_val = array('lastmailid'=>$lastmailID,'t'=>$t);
                    $sqlprep->execute($ar_val );
             
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

