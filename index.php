<?php

    require(__DIR__."/Model/pdo.php");

    $res = $dbPDO->prepare("SELECT * FROM eleves");
    $res->execute();
    $clients = $res->fetchAll();

    //echo "<pre>";
    //var_dump($clients);

    echo "Voici les noms qui sont présents dans la classe :<br><br>";
    foreach($clients as $e) {
        echo "<li>".$e['nom']." ".$e['prenom'];
    }

    echo "<br>";

    $res = $dbPDO->prepare("SELECT * FROM classes");
    $res->execute();
    $clients = $res->fetchAll();

    echo "<br>Voici la liste de toute les classes :<br><br>";

    foreach($clients as $e) {
        echo "<li>".$e['nom'];
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

<form method="POST">
    <input type="text" name="nom_matiere" placeholder="Nom de la matière" required>
    <input type="number" name="id_prof" placeholder="ID du prof" required>
    <button type="submit">Valider</button>
</form>

<?php

if (isset($_POST['nom_matiere']) && !empty($_POST['nom_matiere']) && isset($_POST['id_prof']) && !empty($_POST['id_prof'])) { // faire les checks

    $nom = htmlspecialchars($_POST['nom_matiere']);
    $id_prof = (int) $_POST['id_prof'];

    $res = $dbPDO->prepare("INSERT INTO matières (Id_Prof, nom) VALUES (:id_prof, :nom)");

    $res->execute([
        'id_prof' => $id_prof,
        'nom' => $nom
    ]);

    echo "<br>Matière ajoutée !";
}
?>