<?php
    foreach ($tbCommandes as $commande) {
        ?>
            <section class="main-conteneur"> 
                <div class="centree">
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
                    <?php
                        if ($commande['Commande']->statutcommande == 'passee') {
                            ?>
                            <form action="index.php?uc=Panier" method="post">
                                <button class="btn btn-primary" type="submit" name="Action" id="Action" value="modifQuantite">Payer sa commande</button>
                                <button class="btn btn-danger" type="submit" name="Action" id="Action" value="supprimerProduit">Annuler sa commande</button>
                            </form>
                            <?php
                        }else {
                            ?>
                            <form action="index.php?uc=Panier" method="post">
                                <button class="btn btn-primary" type="submit" name="Action" id="Action" value="modifQuantite" disabled>Payer sa commande</button>
                                <button class="btn btn-danger" type="submit" name="Action" id="Action" value="supprimerProduit" disabled>Annuler sa commande</button>
                            </form>
                            <?php
                        }
                    ?>
                </div>
            </section>
        <?php
    }