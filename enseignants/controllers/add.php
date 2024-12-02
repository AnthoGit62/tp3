<?php

$db = require_once(dirname(__FILE__) . '/../../lib/mypdo.php');
require_once(dirname(__FILE__) . '/../../class/enseignant.class.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enseignant = new enseignants($db);

    $required_fields = [
        'firstname', 'lastname', 'birthday', 'username', 'password'
    ];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Le champ $field est obligatoire.";
        }
    }

    if (!empty($_POST['zipcode']) && !filter_var($_POST['zipcode'], FILTER_VALIDATE_INT)) {
        $errors[] = "Le champ Code Postal doit être un entier.";
    }

    if (empty($errors)) {
        $enseignant->setFirstname($_POST['firstname']);
        $enseignant->setLastname($_POST['lastname']);
        $enseignant->setBirthday($_POST['birthday']);
        $enseignant->setAddress($_POST['address'] ?? null);
        $enseignant->setZipcode($_POST['zipcode'] ?? null);
        $enseignant->setTown($_POST['town'] ?? null);
        $enseignant->setUsername($_POST['username']);
        $enseignant->setPassword($_POST['password']);

        try {
            $enseignant->create();
            header('Location: /tp3/index.php?element=enseignants&action=add');
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
