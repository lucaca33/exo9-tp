<?php
require(__DIR__."/../Model/pdo.php");

// vérifier que le formulaire a été soumis et les champs remplis
if (
    isset($_POST['nom']) && !empty($_POST['nom']) &&
    isset($_POST['prenom']) && !empty($_POST['prenom']) &&
    isset($_POST['Id_Classes']) && !empty($_POST['Id_Classes'])
) {
    $nom = htmlspecialchars($_POST['nom']); // éviter injections sql
    $prenom = htmlspecialchars($_POST['prenom']); // éviter injections sql
    $id_classes = (int) $_POST['Id_Classes']; // la même

    $res = $dbPDO->prepare("INSERT INTO eleves (nom, prenom, Id_Classes) VALUES (:nom, :prenom, :id_classes)");
    $res->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'id_classes' => $id_classes
    ]);

    echo "<br>Étudiant ajoutée !";
}
?>

<br>
<a href="../index.php">Retour</a>