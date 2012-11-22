<?php
include "Model.php";

class City
{
    private $cityId;
    private $cityName;

//    function City($cityName){
//      $this->cityName = $cityName;
//    }

    function getCity($cityId)
    {
        $dbconnect = new Model('localhost','testmail','root', 'root');
        $sql = "select * from city where cityID = $cityId";
        echo $sql;
        var_dump($dbconnect);
        var_dump($result);
        $result = $dbconnect->query($sql);
        foreach($result as $row)
            return $row['cityID'];
    }
}
?>

<?php
    $myCity = new City();
    $my_result = $myCity->getCity(2);
    echo $my_result;
?>

