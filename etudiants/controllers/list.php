<?php

$db = require_once(dirname(__FILE__) . '/../../lib/mypdo.php');
require_once(dirname(__FILE__) . '/../../class/etudiant.class.php');

$etudiant = new etudiants($db);
$message = '';
$errors = [];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        if ($etudiant->delete((int)$_POST['delete_id'])) {
            $message = "Étudiant supprimé avec succès.";
        } else {
            $message = "Erreur lors de la suppression de l'étudiant.";
        }
    }
    

    $students = $etudiant->getAllStudents();
    if (empty($students)) $errors[] = "Aucun étudiant trouvé.";
} catch (Exception $e) {
    $errors[] = "Erreur : " . $e->getMessage();
    $students = [];
}

echo $message;
foreach ($errors as $error) echo $error . "<br>";
?>
