<div class="container mt-4">
    <h3>Liste des enseignants</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Ville</th>
                <th>Identifiant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($teachers)): ?>
                <?php foreach ($teachers as $teacher): ?>
                    <tr>
                        <td><?= htmlspecialchars($teacher['id']) ?></td>
                        <td><?= htmlspecialchars($teacher['lastname']) ?></td>
                        <td><?= htmlspecialchars($teacher['firstname']) ?></td>
                        <td><?= htmlspecialchars($teacher['birthday']) ?></td>
                        <td><?= htmlspecialchars($teacher['address'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($teacher['zipcode'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($teacher['town'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($teacher['username']) ?></td>
                        <td>
                            <form method="GET" action="/tp3/enseignants/controllers/card.php" class="d-inline-block">
                                <input type="hidden" name="edit_id" value="<?= htmlspecialchars($teacher['id']) ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                            </form>
                            <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet enseignant ?');" class="d-inline-block">
                                <input type="hidden" name="delete_id" value="<?= htmlspecialchars($teacher['id']) ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="10" class="text-center">Aucun enseignant trouvé.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
