<?php
require(__DIR__."/../Model/pdo.php");

$id = (int)$_GET['id'];

// Récup élève
$res = $dbPDO->prepare("SELECT * FROM eleves WHERE Id_eleve = ?");
$res->execute([$id]);
$eleve = $res->fetch();

// Récup classes
$res2 = $dbPDO->prepare("SELECT * FROM classes");
$res2->execute();
$classes = $res2->fetchAll();

// Update
if (isset($_POST['valider'])) {
    $update = $dbPDO->prepare("UPDATE eleves SET nom = ?, prenom = ?, Id_classes = ? WHERE Id_eleve = ?");
    $update->execute([
        htmlspecialchars($_POST['nom']),
        htmlspecialchars($_POST['prenom']),
        $_POST['Id_classes'],
        $id
    ]);
}
?>

<form method="POST">
    <input type="text" name="nom" value="<?= htmlspecialchars($eleve['nom']) ?>" required>
    <input type="text" name="prenom" value="<?= htmlspecialchars($eleve['prenom']) ?>" required>

    <select name="Id_classes">
        <?php foreach ($classes as $c): ?>
            <option value="<?= $c['Id_Classes'] ?>" <?= $c['Id_Classes'] == $eleve['Id_classes'] ? 'selected' : '' ?>>
                <?= $c['nom'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" name="valider">Valider</button>
</form>

<br> <a href="../index.php">Retour</a>