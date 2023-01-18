<?php

$check_skk = $_POST['check_skk'];

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$data", $username, $password);

    $sql = "SELECT * FROM skks WHERE nomor_skk = " . "'" . $check_skk .  "'";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

   if($result>0){
     return true;
   }else {
     return false;
   }

    $dbh = null;
    }
        catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>
