<section class="main-conteneur"> 
    <div class="centree">
        <table class="table table-dark">
            <thead>
                <tr> 
                   <th scope="col">Libelle</th><th scope="col">En stock</th><th scope="col">Quantité</th scope="col"><th scope="col">Prix unitaire</th><th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($_SESSION['Panier'] as $produit) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $produit->libelle;?>
                        </td>
                        <td>
                            <?php echo $produit->qteactuelle;?>
                        </td>
                        <td>
                            <form action="index.php?uc=Panier" method="post">
                                <input type="hidden" name="idData" id="idData" value="<?php echo $produit->idproduit;?>">
                                <input style="max-width:50px;" type="number" name="nbProduit" id="nbProduit" value="<?php echo $produit->qte; ?>">
                                <button class="btn btn-primary" type="submit" name="Action" id="Action" value="modifQuantite">Valider les quantités</button>
                                <button class="btn btn-danger" type="submit" name="Action" id="Action" value="supprimerProduit">Supprimer article</button>
                            </form>
                        </td>
                        <td>
                            <?php echo $produit->prixunitaire; ?>
                        </td>
                        <td>
                            <?php echo (double)$produit->prixunitaire*$produit->qte; ?> €
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
<section class="main-conteneur">
    <form class="total" action="index.php?uc=Commandes" method="post">
        <div>
            <h5 for="nbPoint">Souhaitez-vous utiliser des points ?</h5>
            <input type="number" name="txtNbPoint" id="txtNbPoint" max="<?php echo $_SESSION['UserConnecte']->nbpointfidelite; ?>" value=0>
            <p style="display: inline; font-size: 14pt;"> / <?php echo $_SESSION['UserConnecte']->nbpointfidelite; ?> pts MAX</p>
        </div>
        <div>
            <h5>Total : 
                <?php
                $total = 0;
                foreach ($_SESSION['Panier'] as $produit) {
                    $total+= (double)$produit->prixunitaire*$produit->qte;
                }
                echo $total.' €';
                ?>
            </h5>
            <input type="hidden" name="montantData" id="montantData" value="<?php echo $total;?>">
            <button class="btn btn-primary" type="submit" name="Action" id="Action" value="validerCommande">Valider la commande</button>
        </div>
    </form>
</section>