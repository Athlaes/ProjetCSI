<section class="main-conteneur c-connexion"> 
    <div class="connexion">
        <div>
            <form action="index.php?uc=Connexion" method="post">
                <div>
                    <h2>Connexion</h2>
                </div>
                <div>
                    <label for="txtEmail">E-mail</label>
                    <input type="email" name="txtEmail" id="txtEmail">
                </div>
                <div>
                    <label for="txtPwd">Mot de passe</label>
                    <input type="password" name="txtPwd" id="txtPwd">
                </div>
                <?php
                if (isset($mauvaisMdp)) {
                    if ($mauvaisMdp == true) {
                        ?>
                        <div class="danger">
                            Vous vous êtes trompé de mot de passe ou d'email !
                    </div>
                        <?php
                    }
                }
                ?>
                <button class="btn btn-primary" name='Action' id='Action' type="submit" value="seConnecter">Se connecter</button>
            </form>
        </div>
        <div>
            <form action="index.php?uc=Connexion" method="post">
                <div>
                    <h2>Inscription</h2>
                </div>
                <div>
                    <label for="txtEmail">E-mail</label>
                    <input type="email" name="txtEmail" id="txtEmail"> 
                </div>
                <div>
                    <label for="txtIdentifiant">Identifiant</label>
                    <input type="text" name="txtIdentifiant" id="txtIdentifiant">
                </div>
                <div>
                    <label for="txtPassword">Mot de passe</label>
                    <input type="password" name="txtPassword" id="txtPassword">
                </div>
                <div>
                    <label for="tel">Numéro de téléphone</label>
                    <input type="tel" name="tel" id="tel">
                </div>
                <div>
                    <label for="txtNom">Nom</label>
                    <input type="text" name="txtNom" id="txtNom">
                    <label for="txtPrenom">Prenom</label>
                    <input type="text" name="txtPrenom" id="txtPrenom">
                </div>
                <div>
                    <label for="txtRue">Rue</label>
                    <input type="text" name="txtRue" id="txtRue">
                </div>
                <div>
                    <label for="txtVille">Ville</label>
                    <input type="text" name="txtVille" id="txtVille">
                    <label for="nbCP">Code postal</label>
                    <input type="number" name="nbCP" id="nbCP">
                </div>
                <button class="btn btn-primary" type="submit" id="Action" name="Action" value="sinscrire">S'inscrire</button>
            </form>
        </div>
    </div>
</section>