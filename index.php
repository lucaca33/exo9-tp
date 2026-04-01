<?php

    require(__DIR__."/Model/pdo.php");

    $res = $dbPDO->prepare("SELECT * FROM eleves");
    $res->execute();
    $clients = $res->fetchAll();

    //echo "<pre>";
    //var_dump($clients);

    echo "Voici les noms qui sont présents dans la classe :<br><br>";
    foreach($clients as $e) {
        echo "<li>".$e['nom']." ".$e['prenom']." ";
        echo' <a href="./Views/modif_etudiant.php?id='.$e['Id_eleve'].'">Modifier</a>';
    }
    

    echo "<br>";

    $res = $dbPDO->prepare("SELECT * FROM classes");
    $res->execute();
    $clients = $res->fetchAll();

    echo "<br>Voici la liste de toute les classes :<br><br>";

    // pour ajout étudiant
    $classes = [];

    foreach($clients as $e) {
        echo "<li>".$e['nom'];
        $classes[$e['Id_Classes']] = $e['nom'];
    }

    $res = $dbPDO->prepare("SELECT * FROM prof");
    $res->execute();
    $clients = $res->fetchAll();

    echo "<br><br>Voici la liste de tout les profs :<br><br>";

    foreach($clients as $e) {
        echo "<li>".$e['nom']." ".$e['prenom'];
    }

    $res = $dbPDO->prepare("SELECT p.nom AS nomProf, p.prenom AS prenomProf, c.nom AS nomClasse, m.nom AS nomMatiere FROM prof as p JOIN asso_3 AS a ON a.Id_Prof = p.Id_Prof JOIN classes AS c ON c.Id_Classes = a.Id_Classes JOIN matières AS m ON m.Id_Prof = p.Id_Prof;");
    $res->execute();
    $clients = $res->fetchAll();

    echo "<br><br>Voici la liste de tout les profs et de leur classes et matières:<br><br>";

    foreach($clients as $e) {
        echo "<li>".$e['nomProf']." ".$e['prenomProf']." prof de ".$e['nomMatiere']." pour la classe de ".$e['nomClasse'];
    }


    // partie 3 : ajouter des données
?>
<h2>Ajouter une matière</h2>

<form action="Views/nouvelle_matiere.php" method="POST">
    <input type="text" name="nom_matiere" placeholder="Nom de la matière" required>
    <input type="number" name="id_prof" placeholder="ID du prof" required>
    <button type="submit">Valider</button>
</form>


<h2>Ajouter un étudiant</h2>

<form action="Views/nouvel_eudiant.php" method="POST">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prenom" required>
    <?php
    echo'<select name="Id_Classes">';
    echo'<option value="">--Veuillez choisir une classe--</option>';
    foreach ($classes as $id => $nom) {
        echo'<option value="'.$id.'">'.$nom.'</option>';
    }
    echo'</select>';
    ?>
    <button type="submit">Valider</button>
</form>