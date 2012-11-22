<?php
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
        $result = $this->conn->query($sql);
        var_dump($result);
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
        echo $sql;
        $result = $this->query($sql);
        var_dump($result);
        foreach($result as $row)
            return $row['mailID'];
    }
}
?>



