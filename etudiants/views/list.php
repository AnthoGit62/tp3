<div class="container mt-4">
    <h3>Liste des étudiants</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Diplôme</th>
                <th>Année</th>
                <th>TD</th>
                <th>TP</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Ville</th>
                <th>Identifiant</th>
                <th>Mot de passe</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students)): ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['id']) ?></td>
                        <td><?= htmlspecialchars($student['lastname']) ?></td>
                        <td><?= htmlspecialchars($student['firstname']) ?></td>
                        <td><?= htmlspecialchars($student['birthday']) ?></td>
                        <td><?= htmlspecialchars($student['diploma']) ?></td>
                        <td><?= htmlspecialchars($student['year']) ?></td>
                        <td><?= htmlspecialchars($student['td']) ?></td>
                        <td><?= htmlspecialchars($student['tp']) ?></td>
                        <td><?= htmlspecialchars($student['adress']) ?></td>
                        <td><?= htmlspecialchars($student['zipcode']) ?></td>
                        <td><?= htmlspecialchars($student['town']) ?></td>
                        <td><?= htmlspecialchars($student['username']) ?></td>
                        <td>Mot de passe sécurisé</td>
                        <td>
                            <form method="GET" action="/tp3/etudiants/controllers/card.php" class="d-inline-block">
                                <input type="hidden" name="edit_id" value="<?= htmlspecialchars($student['id']) ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                            </form>
                            <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet étudiant ?');" class="d-inline-block">
                                <input type="hidden" name="delete_id" value="<?= htmlspecialchars($student['id']) ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="14" class="text-center">Aucun étudiant trouvé.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
