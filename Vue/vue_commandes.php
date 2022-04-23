<?php
    foreach ($tbCommandes as $commande) {
        ?>
            <section class="main-conteneur"> 
                <div class="centree flex">
                    <div style="display: flex; justify-content: space-between;">
                        <h3>Commande n°<?php echo $commande['Commande']->idcommande.' - '.$commande['Commande']->statutcommande; ?></h3>
                        <h3>
                            <?php
                                if (isset($commande['Commande']->quai)) {
                                    echo 'Quai : '.$commande['Commande']->quai;
                                }
                            ?>
                        </h3>
                    </div>
                    <div style="display: flex; justify-content: flex-start; flex-flow : column nowrap; color: white;">
                        <h6>Commande passé le : <?php echo $commande['Commande']->heurecommande;?> à <?php echo $commande['Commande']->heurecommande;?></h6>
                        <?php
                        if (isset($commande['Commande']->datelivraison) && isset($commande['Commande']->heurelivraison)) {
                            ?>
                            <h6>Livrée le : <?php echo $commande['Commande']->datelivraison;?> à <?php echo $commande['Commande']->heurelivraison;?></h6>
                            <?php
                        }
                        ?>
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
                                    <button class="btn btn-danger" type="submit" name="Action" id="Action" value="supprimerCommande" disabled>Annuler sa commande</button>
                                </form>
                                <?php
                            }
                        if ($commande['Commande']->statutcommande != 'Livree' && $commande['Commande']->statutcommande != 'Echouee' && $commande['Commande']->statutcommande != 'passee') {
                          ?>
                            <h6 class="alignend">Quand voulez vous retirer votre commande ?
                                <form action="" method="post">
                                    <p>
                                        <input type="hidden" name="idData" id="idData" value="<?php echo $commande['Commande']->idcommande; ?>">
                                        <input type="date" name="dateLivraison" id="dateLivraison" <?php if(isset($commande['Commande']->datelivraison)) { echo 'value="'.$commande['Commande']->datelivraison.'"'; } ?>>
                                        <input type="time" name="hLivraison" id="hLivraison" <?php if(isset($commande['Commande']->heurelivraison)) { echo 'value="'.$commande['Commande']->heurelivraison.'"'; } ?>>
                                        <?php
                                            if ($commande['Commande']->datelivraison && isset($commande['Commande']->heurelivraison)) {
                                                ?>
                                                <i class="fa-solid fa-check"></i>
                                                <?php
                                            }
                                        ?>
                                    </p>
                                    <button class="btn btn-danger" type="submit" name="Action" id="Action" value="confirmerDHLivraison">Confirmer la livraison</button>
                                </form>
                            </h6>
                          <?php
                        }
                        ?>
                        <h3 class='alignend'>Total : <?php echo $commande['Commande']->montantpaiement; ?></h3>
                    </div>
                </div>
            </section>
        <?php
    }