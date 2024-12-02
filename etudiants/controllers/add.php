<?php


$db = require_once(dirname(__FILE__) . '/../../lib/mypdo.php');
require_once(dirname(__FILE__) . '/../../class/etudiant.class.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $etudiant = new etudiants($db);

    $required_fields = [
        'firstname', 'lastname', 'birthday', 'diploma', 'year', 
        'td', 'tp', 'adress', 'zipcode', 'town', 'username', 'password'
    ];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Le champ $field est obligatoire.";
        }
    }

    if (!empty($_POST['zipcode']) && !filter_var($_POST['zipcode'], FILTER_VALIDATE_INT)) {
        $errors[] = "Le champ ZipCode doit être un entier.";
    }

    if (empty($errors)) {
        $etudiant->setFirstname($_POST['firstname']);
        $etudiant->setLastname($_POST['lastname']);
        $etudiant->setBirthday($_POST['birthday']);
        $etudiant->setDiploma($_POST['diploma']);
        $etudiant->setYear($_POST['year']);
        $etudiant->setTd($_POST['td']);
        $etudiant->setTp($_POST['tp']);
        $etudiant->setAdress($_POST['adress']);
        $etudiant->setZipcode($_POST['zipcode']);
        $etudiant->setTown($_POST['town']);
        $etudiant->setUsername($_POST['username']);
        $etudiant->setPassword($_POST['password']);
        
        try {
            $etudiant->create();
            header('Location: /tp3/index.php?element=etudiants&action=add');
            exit;
        } catch (Exception $e) {
            $errors[] = "Erreur : " . $e->getMessage();
        }
    }
}
?>

<?php if (!empty($errors)): ?>
    <div class="error-messages">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li style="color: red;"><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
    
<?php endif; ?>
