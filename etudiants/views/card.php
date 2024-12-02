<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="w3-container w3-margin-top">
    <div class="w3-card-4">
        <header class="w3-container w3-teal">
            <h2>Modifier un étudiant</h2>
        </header>
        <div class="w3-container w3-light-grey">
            <h3>Modifier l'étudiant</h3>
            <?php if (isset($studentToEdit)): ?>
                <form method="POST" class="w3-container">

                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label for="firstname">Prénom</label>
                            <input type="text" name="firstname" class="w3-input w3-border" value="<?= htmlspecialchars($studentToEdit['firstname']) ?>" required>
                        </div>
                        <div class="w3-half">
                            <label for="lastname">Nom</label>
                            <input type="text" name="lastname" class="w3-input w3-border" value="<?= htmlspecialchars($studentToEdit['lastname']) ?>" required>
                        </div>
                    </div>

                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label for="birthday">Date de naissance</label>
                            <input type="date" name="birthday" class="w3-input w3-border" value="<?= htmlspecialchars($studentToEdit['birthday']) ?>" required>
                        </div>
                        <div class="w3-half">
                            <label for="diploma">Diplôme</label>
                            <select class="w3-select w3-border" name="diploma">
                                <option value="di1" <?= $studentToEdit['diploma'] === 'di1' ? 'selected' : '' ?>>BUT</option>
                                <option value="di2" <?= $studentToEdit['diploma'] === 'di2' ? 'selected' : '' ?>>License</option>
                                <option value="di3" <?= $studentToEdit['diploma'] === 'di3' ? 'selected' : '' ?>>Master</option>
                            </select>
                        </div>
                    </div>

                    <div class="w3-row-padding">
                        <div class="w3-third">
                            <label for="year">Année</label>
                            <select class="w3-select w3-border" name="year">
                                <option value="1" <?= $studentToEdit['year'] == '1' ? 'selected' : '' ?>>Première année</option>
                                <option value="2" <?= $studentToEdit['year'] == '2' ? 'selected' : '' ?>>Deuxième année</option>
                                <option value="3" <?= $studentToEdit['year'] == '3' ? 'selected' : '' ?>>Troisième année</option>
                                <option value="4" <?= $studentToEdit['year'] == '4' ? 'selected' : '' ?>>Quatrième année</option>
                                <option value="5" <?= $studentToEdit['year'] == '5' ? 'selected' : '' ?>>Cinquième année</option>
                            </select>
                        </div>
                        <div class="w3-third">
                            <label for="td">TD</label>
                            <select class="w3-select w3-border" name="td">
                                <option value="td1" <?= $studentToEdit['td'] === 'td1' ? 'selected' : '' ?>>TD1</option>
                                <option value="td2" <?= $studentToEdit['td'] === 'td2' ? 'selected' : '' ?>>TD2</option>
                                <option value="td3" <?= $studentToEdit['td'] === 'td3' ? 'selected' : '' ?>>TD3</option>
                            </select>
                        </div>
                        <div class="w3-third">
                            <label for="tp">TP</label>
                            <select class="w3-select w3-border" name="tp">
                                <option value="tpa" <?= $studentToEdit['tp'] === 'tpa' ? 'selected' : '' ?>>TPA</option>
                                <option value="tpb" <?= $studentToEdit['tp'] === 'tpb' ? 'selected' : '' ?>>TPB</option>
                                <option value="tpc" <?= $studentToEdit['tp'] === 'tpc' ? 'selected' : '' ?>>TPC</option>
                                <option value="tpd" <?= $studentToEdit['tp'] === 'tpd' ? 'selected' : '' ?>>TPD</option>
                            </select>
                        </div>
                    </div>

                    <div class="w3-row-padding">
                        <div class="w3-third">
                            <label for="adress">Adresse</label>
                            <input type="text" name="adress" class="w3-input w3-border" value="<?= htmlspecialchars($studentToEdit['adress']) ?>" required>
                        </div>
                        <div class="w3-third">
                            <label for="zipcode">Code postal</label>
                            <input type="text" name="zipcode" class="w3-input w3-border" value="<?= htmlspecialchars($studentToEdit['zipcode']) ?>" required>
                        </div>
                        <div class="w3-third">
                            <label for="town">Ville</label>
                            <input type="text" name="town" class="w3-input w3-border" value="<?= htmlspecialchars($studentToEdit['town']) ?>" required>
                        </div>
                    </div>

                    <div class="w3-center w3-padding-16">
                        <button type="submit" name="update" class="w3-button w3-teal w3-round">Valider</button>
                        <button type="submit" name="cancel" class="w3-button w3-red w3-round">Annuler</button>
                    </div>
                </form>
            <?php else: ?>
                <p class="w3-text-red">Étudiant non trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
