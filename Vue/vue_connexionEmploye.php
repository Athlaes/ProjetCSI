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
    </div>
</section>