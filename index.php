<?php

    require(__DIR__."/Model/pdo.php");

    $res = $dbPDO->prepare("SELECT * FROM eleves");

    $res ->execute();

    $eleves = $resultat->fetchAll(PDO::FETCH_CLASS);

    foreach($eleves as $e) {
        echo $e->nom."aazeae";
    }

?>