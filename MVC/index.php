<?php
var_dump($_POST["city"]);
if(isset($_POST['submitted'])&&($_POST['submitted']==1)){
    $expected = array("cust_name","cust_add1","cust_add2","city","comment");
    $required = array("cust_name","cust_add1","cust_add2","city","comment");
    $errors = array();
    $temp2 = array();


    foreach ($_POST as $field => $value){
        $temp = is_array($value) ? $value : trim($value);
        array_push($temp2,$temp);
        if (empty($temp) && in_array($field, $required)) {
            array_push($errors, $field);
        }
    }



    if (!in_array("cust_add1", $errors) && !in_array("cust_add2",$errors))
    {
      if( $_POST["cust_add1"]!=$_POST["cust_add2"]){
          array_push($errors, "not_match");
      }else if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$_POST["cust_add2"]))
          array_push($errors, "error_mail");
    }

     if (!in_array("cust_add1", $errors) && !in_array("cust_add2",$errors))
    {
      if( $_POST["cust_add1"]!=$_POST["cust_add2"]){
          array_push($errors, "not_match");
      }else if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$_POST["cust_add1"]))
          array_push($errors, "error_mail2");
    }

     $checkedarr = array();
     /*
     $count = count($_POST['city']);
     echo $count;
     for ($i = 0; $i < $count; $i++) {
         echo "---".$_POST['city'][$i];
        array_push($checkedarr, $_POST["city"][$i]);
     }
      */
     if ($_POST['city']) {
         foreach ($_POST['city'] as $key => $val) {
             $checkedarr[] = $key;
         }
     }

//    foreach($checkedarr as $ch){
//         echo $ch." ";
//     }


    if (empty($errors)){
        require_once("done.php");
        exit();
    }
}

function createCityChecks($cities, $checkedarr) {
    $html = array();
    $i = 0;
//    var_dump($cities);
//    var_dump($checkedarr);
    foreach ($cities as $key => $val) {
        $i++;
        $rtn = ($i == 5) ? "<br />" : "";
//        echo "$i" . "<br />";
//        echo '$i' . "<br />";
        if ($key !== null)
            $html[] = "<input id='city_{$val['cityID']}' name='city[{$val['cityID']}]' type='checkbox' val='{$val['cityID']}'";
//  echo $_POST["city"][$i];
//       if (in_array($_POST["city"][$i],$checkedarr)){

        var_dump($checkedarr);
        var_dump($val['cityID']);
       if (in_array($val['cityID'], $checkedarr)) {
           $html[] =" checked ";
        }

            $html[] ="/><label for='city_{$val['cityID']}'>{$val['cityName']}</label>{$rtn}";
    }
    return implode("\n", $html);
}


// Connection data (server_address, database, username, password)
$hostdb = 'localhost';
$namedb = 'testmail';
$userdb = 'root';
$passdb = 'root';

try {
  // Connect and create the PDO object
  $conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  $conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8

  // Define and perform the SQL SELECT query
  $sql = "select cityID, cityName from city ";
  $result = $conn->query($sql);
  $cityArr = array();
  // Parse returned data, and displays them
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      array_push($cityArr, $row); 
      //      echo $row['cityName'];
  }

  $conn = null;        // Disconnect
}
catch(PDOException $e) {
 echo $sql . "<br />";
  echo $e->getMessage();
}


require("./views/index.html.php");
require("Model.html.php");
$dbconnect = new Model('localhost','testmail','root', 'root');
$result = $dbconnect->getMail(5);
echo "hello world";
echo $result;

?>
