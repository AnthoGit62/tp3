<?php
require_once(dirname(__FILE__) . '/../../lib/mypdo.php');
require_once(dirname(__FILE__) . '/../../class/enseignant.class.php');

$enseignant = new enseignants($db);

if (isset($_GET['edit_id'])) {
    $editId = intval($_GET['edit_id']);
    $teacherToEdit = $enseignant->getTeacherWithUsername($editId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update'])) {
            $data = [
                'edit_id'    => $editId,
                'firstname'  => $_POST['firstname'],
                'lastname'   => $_POST['lastname'],
                'birthday'   => $_POST['birthday'],
                'username'   => $_POST['username'], 
                'address'    => $_POST['address'],
                'zipcode'    => $_POST['zipcode'],
                'town'       => $_POST['town'],
            ];

            if ($enseignant->updateTeacher($data)) {
                header("Location: /tp3/index.php?element=enseignants&action=list");
                exit;
            } else {
                $updateMessage = "Erreur lors de la mise à jour de l'enseignant.";
            }
        } elseif (isset($_POST['cancel'])) {
            header("Location: /tp3/index.php?element=enseignants&action=list");
            exit;
        }
    }

    if ($teacherToEdit) {
        require_once '../views/card.php';
    } else {
        echo "Enseignant non trouvé.";
    }
} else {
    echo "ID de l'enseignant non spécifié.";
}
?>
