<section class="main-conteneur c-connexion"> 
    <div class="centree">
        <div>
            <form action="index.php?uc=ConnexionEmploye" method="post">
                <div>
                    <h2>Connexion</h2>
                </div>
                <div>
                    <label for="txtMatricule">Matricule</label>
                    <input type="text" name="txtMatricule" id="txtMatricule">
                </div>
                <?php
                if (isset($mauvaisMatricule)) {
                    if ($mauvaisMatricule == true) {
                        ?>
                        <div class="danger">
                            Vous vous êtes trompé de matricule !
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