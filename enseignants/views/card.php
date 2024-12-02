<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="w3-container w3-margin-top">
    <div class="w3-card-4">
        <header class="w3-container w3-teal">
            <h2>Modifier un enseignant</h2>
        </header>
        <div class="w3-container w3-light-grey">
            <h3>Modifier l'enseignant</h3>
            <?php if (isset($teacherToEdit)): ?>
                <form method="POST" class="w3-container">

                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label for="firstname">Prénom</label>
                            <input type="text" name="firstname" class="w3-input w3-border" value="<?= htmlspecialchars($teacherToEdit['firstname']) ?>" required>
                        </div>
                        <div class="w3-half">
                            <label for="lastname">Nom</label>
                            <input type="text" name="lastname" class="w3-input w3-border" value="<?= htmlspecialchars($teacherToEdit['lastname']) ?>" required>
                        </div>
                    </div>

                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label for="birthday">Date de naissance</label>
                            <input type="date" name="birthday" class="w3-input w3-border" value="<?= htmlspecialchars($teacherToEdit['birthday']) ?>" required>
                        </div>
                        <div class="w3-half">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" name="username" class="w3-input w3-border" value="<?= htmlspecialchars($teacherToEdit['username']) ?>" required>
                        </div>
                    </div>

                    <div class="w3-row-padding">
                        <div class="w3-third">
                            <label for="address">Adresse</label>
                            <input type="text" name="address" class="w3-input w3-border" value="<?= htmlspecialchars($teacherToEdit['address']) ?>" required>
                        </div>
                        <div class="w3-third">
                            <label for="zipcode">Code postal</label>
                            <input type="text" name="zipcode" class="w3-input w3-border" value="<?= htmlspecialchars($teacherToEdit['zipcode']) ?>" required>
                        </div>
                        <div class="w3-third">
                            <label for="town">Ville</label>
                            <input type="text" name="town" class="w3-input w3-border" value="<?= htmlspecialchars($teacherToEdit['town']) ?>" required>
                        </div>
                    </div>

                    <div class="w3-center w3-padding-16">
                        <button type="submit" name="update" class="w3-button w3-teal w3-round">Valider</button>
                        <button type="submit" name="cancel" class="w3-button w3-red w3-round">Annuler</button>
                    </div>
                </form>
            <?php else: ?>
                <p class="w3-text-red">Enseignant non trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
