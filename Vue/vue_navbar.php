<nav class="navbar">
    <div>
        <h3>Le drive</h3>
    </div>
    <div>
        <div>
            <h5>
                <a href="index.php?uc=Acceuil">Acceuil</a>
            </h5>
        </div>
    </div>
    <div>
        <h5>
            <?php
                if (!isset($_SESSION['UserConnecte'])) {
                    ?>
                        <a href="index.php?uc=Connexion">Se connecter
                            <i class="fa-solid fa-user"></i>
                        </a>
                    <?php
                } else {
                    ?>
                        <a href="#">Bonjour, <?php echo $_SESSION['UserConnecte']->prenom.' '.$_SESSION['UserConnecte']->nom; ?>
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <a href="index.php?uc=Deconnexion"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                    <?php
                }
            ?>
       </h5>
    </div>
</nav>