<?php

require(__DIR__."/Model/pdo.php");

$res = $dbPDO->prepare("SELECT * FROM eleves");
$res->execute();

//echo "<br><br>";

$clients = $res->fetchAll();

echo "<pre>";

//var_dump($clients);

foreach($clients as $client) {
    echo "<li>".$client['nom'];
}
/*
$rows = count($clients);

if ($rows > 0){
    echo "Il y a $rows client(s)";
} else {
    echo "Aucun client";
}*/

?>