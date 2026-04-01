<?php
require(__DIR__."/../Model/pdo.php");

// vérifier que le formulaire a été soumis et les champs remplis
if (
    isset($_POST['nom_matiere']) && !empty($_POST['nom_matiere']) &&
    isset($_POST['id_prof']) && !empty($_POST['id_prof'])
) {
    $nom = htmlspecialchars($_POST['nom_matiere']); // éviter injections sql
    $id_prof = (int) $_POST['id_prof']; // la même

    $res = $dbPDO->prepare("INSERT INTO matières (Id_Prof, nom) VALUES (:id_prof, :nom)");
    $res->execute([
        'id_prof' => $id_prof,
        'nom' => $nom
    ]);

    echo "<br>Matière ajoutée !";
}
?>

<br>
<a href="../index.php">Retour</a>