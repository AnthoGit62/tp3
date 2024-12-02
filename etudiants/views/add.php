<div class="dtitle w3-container w3-teal">
    Création d'un nouvel étudiant
</div>
<div class="w3-container w3-card w3-padding">
    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post">
        <div class="w3-row-padding">
            <div class="w3-half">
                <label>Nom</label>
                <input class="w3-input w3-border" type="text" name="lastname" required>
            </div>
            <div class="w3-half">
                <label>Prénom</label>
                <input class="w3-input w3-border" type="text" name="firstname" required>
            </div>
        </div>

        <div class="w3-row-padding">
            <div class="w3-half">
                <label>Date d'anniversaire</label>
                <input class="w3-input w3-border" type="date" name="birthday" required>
            </div>
            <div class="w3-half">
                <label>Diplôme</label>
                <select class="w3-select w3-border" name="diploma">
                    <option value="di1">BUT</option>
                    <option value="di2">License</option>
                    <option value="di3">Master</option>
                </select>
            </div>
        </div>

        <div class="w3-row-padding">
            <div class="w3-third">
                <label>Année</label>
                <select class="w3-select w3-border" name="year">
                    <option value="1">Première année</option>
                    <option value="2">Deuxième année</option>
                    <option value="3">Troisième année</option>
                    <option value="4">Quatrième année</option>
                    <option value="5">Cinquième année</option>
                </select>
            </div>
            <div class="w3-third">
                <label>TD</label>
                <select class="w3-select w3-border" name="td">
                    <option value="td1">TD1</option>
                    <option value="td2">TD2</option>
                    <option value="td3">TD3</option>
                </select>
            </div>
            <div class="w3-third">
                <label>TP</label>
                <select class="w3-select w3-border" name="tp">
                    <option value="tpa">TPA</option>
                    <option value="tpb">TPB</option>
                    <option value="tpc">TPC</option>
                    <option value="tpd">TPD</option>
                </select>
            </div>
        </div>

        <div class="w3-row-padding">
            <div class="w3-third">
                <label>Adresse</label>
                <input class="w3-input w3-border" type="text" name="adress" required>
            </div>
            <div class="w3-third">
                <label>Code Postal</label>
                <input class="w3-input w3-border" type="text" name="zipcode" required>
            </div>
            <div class="w3-third">
                <label>Ville</label>
                <input class="w3-input w3-border" type="text" name="town" required>
            </div>
        </div>

        <div class="w3-row-padding">
            <div class="w3-half">
                <label>Identifiant</label>
                <input class="w3-input w3-border" type="text" name="username" required>
            </div>
            <div class="w3-half">
                <label>Mot de passe</label>
                <input class="w3-input w3-border" type="password" name="password" required>
            </div>
        </div>

        <div class="w3-center w3-padding-16">
            <button class="w3-button w3-teal w3-round" type="submit">Envoyer</button>
        </div>
    </form>
</div>
