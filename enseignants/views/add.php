<div class="dtitle w3-container w3-teal">
    Création d'un nouvel enseignant
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
        </div>

        <div class="w3-row-padding">
            <div class="w3-third">
                <label>Adresse </label>
                <input class="w3-input w3-border" type="text" name="address">
            </div>
            <div class="w3-third">
                <label>Code Postal </label>
                <input class="w3-input w3-border" type="text" name="zipcode">
            </div>
            <div class="w3-third">
                <label>Ville </label>
                <input class="w3-input w3-border" type="text" name="town">
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
