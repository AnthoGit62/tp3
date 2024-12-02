<?php

$db = require_once(dirname(__FILE__) . '/../../lib/mypdo.php');
require_once(dirname(__FILE__) . '/../../class/enseignant.class.php');

$enseignant = new enseignants($db);
$message = '';
$errors = [];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        if ($enseignant->delete((int)$_POST['delete_id'])) {
            $message = "Enseignant supprimé avec succès.";
        } else {
            $message = "Erreur lors de la suppression de l'enseignant.";
        }
    }

    $teachers = $enseignant->getAllTeachers();
    if (empty($teachers)) $errors[] = "Aucun enseignant trouvé.";
} catch (Exception $e) {
    $errors[] = "Erreur : " . $e->getMessage();
    $teachers = [];
}

echo $message;
foreach ($errors as $error) echo $error . "<br>";
?>
