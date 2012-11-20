<?php

echo "Here-------------------------------";
class Model{
    var $conn;
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
        $result = $conn->query($sql);
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

    function getMail($mailId)
    {
        $sql = "select * from mail where mailID = $mailId";
        $result = $this->query($sql);
        foreach($result as $row)
            return $row['mailID'];
    }
    
?>


<?php
$dbconnect = new Model('localhost','testmail','root', 'root');
$result = $dbconnect->getMail(5);
echo $result;
?>
