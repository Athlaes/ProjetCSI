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
                $iPanier = 0;
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
                                <input type="hidden" name="iData" id="iData" value="<?php echo $iPanier;?>">
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
                    $iPanier++;
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
<section class="main-conteneur">
    <div class='total'>
        <div>
            <!-- Voici le total de votre panier : -->
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
            <form action="index.php?uc=ValiderCommande" method="post">
                <button class="btn btn-primary" type="submit" name="Action" id="Action" value="validerCommande">Valider la commande</button>
            </form>
        </div>
    </div>
</section>