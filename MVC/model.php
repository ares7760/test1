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

    function fetch($sql, $params){
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
        $sql = "select mail_id,cust_name,cust_add,comment,send_date from mails where mail_id = :mailId";
        $result = $this->fetch($sql, array(':mailId' => $mailId));
        return $result[0];
    }

    function getCity($cityId)
    {
        $sql = "select * from cities where city_id = $cityId";
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
        $sql = "select distinct mails.mail_id,mails.cust_name,mails.cust_add, mails.comment, mails.send_date from mails left join mail_city on mails.mail_id = mail_city.mail_id where mail_city.city_id in (".$city_str.")";
        echo $sql;
        $result = $this->query($sql);
        $mailArr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($mailArr, $row);
        }
        return $mailArr;
    }

    private function saveMailCity($mailId, $cityIds){
        $sql = "insert into mail_city(mail_id,city_id) values(:mailId,:cityId)";
        $sqlprep = $this->conn->prepare($sql);
        foreach($cityIds as $cityId){
            //if(! $this->getCity($cityId)) continue;
            $ar_val = array('mailId'=>$mailId, 'cityId'=>$cityId);
            $sqlprep->execute($ar_val);
        }
    }

    function saveData($custName,$custAdd,$comment,$cityArr,$date){
    try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "here4";
            $this->conn->beginTransaction();

            $sql = "insert into mails(cust_name,cust_add,comment,send_date) values(:cust_name,:cust_add,:comment,:send_date)";
            echo "here5";
            $sqlprep = $this->conn->prepare($sql);
            echo "here6";
            $ar_val = array('cust_name'=>$custName, 'cust_add'=>$custAdd,'comment'=>$comment,'send_date'=>$date);
            echo "here7";
            $sqlprep->execute($ar_val);
            echo "here8";

            $lastmailID = $this->conn->lastInsertId();
            echo "here9";

            if (count($cityArr) != 0)
            {
                $this->saveMailCity($lastmailID, $cityArr);
                echo "here10";

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


