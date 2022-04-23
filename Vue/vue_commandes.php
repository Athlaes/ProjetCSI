<?php
    foreach ($tbCommandes as $commande) {
        ?>
            <section class="main-conteneur"> 
                <div class="centree flex">
                    <div>
                        <h3>Commande n°<?php echo $commande['Commande']->idcommande.' - '.$commande['Commande']->statutcommande; ?>
                        </h3>
                    </div>
                    <table class="table table-dark">
                        <thead>
                            <tr> 
                            <th scope="col">Libelle</th><th scope="col">En stock</th><th scope="col">Description</th scope="col"><th scope="col">Prix unitaire</th><th>Quantité</th><th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($commande['Produits'] as $produit) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $produit->libelle;?>
                                </td>
                                <td>
                                    <?php echo $produit->qteactuelle;?>
                                </td>
                                <td>
                                    <?php echo $produit->prixunitaire; ?>
                                </td>
                                <td>
                                    <?php echo (double)$produit->prixunitaire*$produit->qteproduit; ?> €
                                </td>
                                <td>
                                    <?php echo $produit->qteproduit; ?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div>
                        <?php
                            if ($commande['Commande']->statutcommande == 'passee') {
                                ?>
                                <form action="index.php?uc=Commandes" method="post">
                                    <input type="hidden" name="idData" id="idData" value="<?php echo $commande['Commande']->idcommande; ?>">
                                    <button class="btn btn-primary" type="submit" name="Action" id="Action" value="payerCommande">Payer sa commande</button>
                                    <button class="btn btn-warning" type="submit" name="Action" id="Action" value="modifCommande">Modifier sa commande</button>
                                    <button class="btn btn-danger" type="submit" name="Action" id="Action" value="supprimerCommande">Annuler sa commande</button>
                                </form>
                                <?php
                            }else {
                                ?>
                                <form action="index.php?uc=Panier" method="post">
                                    <button class="btn btn-primary" type="submit" name="Action" id="Action" value="modifQuantite" disabled>Payer sa commande</button>
                                    <button class="btn btn-warning" type="submit" name="Action" id="Action" value="modifCommande" disabled>Modifier sa commande</button>
                                    <button class="btn btn-danger" type="submit" name="Action" id="Action" value="supprimerProduit" disabled>Annuler sa commande</button>
                                </form>
                                <?php
                            }
                            ?>
                        <h3 class='alignend'>Total : <?php echo $commande['Commande']->montantpaiement; ?></h3>
                    </div>
                </div>
            </section>
        <?php
    }