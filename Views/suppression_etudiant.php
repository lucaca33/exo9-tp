<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require(__DIR__."/../Model/pdo.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "Aucun ID reçu";
    exit; // quitter
}

$res = $dbPDO->prepare("SELECT * FROM eleves WHERE Id_eleve = :id");
$res->execute(['id' => $id]);

$etudiant = $res->fetch();

if (!$etudiant) {
    echo "Étudiant introuvable";
    exit;// quitter
}

$del = $dbPDO->prepare("DELETE FROM eleves WHERE Id_eleve = ?");
$id_int = (int)$id; // sinon ca casse
$del->bindParam(1, $id_int);
$del->execute();

echo "Suppression de l'étudiant réussie";

?>
<br> <a href="../index.php">Retour</a>