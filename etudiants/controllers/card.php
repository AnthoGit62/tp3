<?php
require_once(dirname(__FILE__) . '/../../lib/mypdo.php');
require_once(dirname(__FILE__) . '/../../class/etudiant.class.php');

$etudiant = new etudiants($db);

if (isset($_GET['edit_id'])) {
    $editId = intval($_GET['edit_id']);
    $studentToEdit = $etudiant->getStudentById($editId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update'])) {
            $data = [
                'edit_id' => $editId,
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'birthday' => $_POST['birthday'],
                'diploma' => $_POST['diploma'],
                'year' => $_POST['year'],
                'td' => $_POST['td'],
                'tp' => $_POST['tp'],
                'adress' => $_POST['adress'],
                'zipcode' => $_POST['zipcode'],
                'town' => $_POST['town']
            ];

            if ($etudiant->updateStudent($data)) {
                header("Location: /tp3/index.php?element=etudiants&action=list");
                exit;
            } else {
                $updateMessage = "Erreur lors de la mise à jour de l'étudiant.";
            }
        } elseif (isset($_POST['cancel'])) {
            header("Location: /tp3/index.php?element=etudiants&action=list");
            exit;
        }
    }

    if ($studentToEdit) {
        require_once '../views/card.php';
    } else {
        echo "Étudiant non trouvé.";
    }
} else {
    echo "ID de l'étudiant non spécifié.";
}
?>
