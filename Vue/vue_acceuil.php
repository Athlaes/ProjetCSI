<section class="main-conteneur"> 
    <div class="centree">
        <table class="table table-dark">
            <thead>
                <tr> 
                   <th scope="col">Libelle</th><th scope="col">En stock</th><th scope="col">Description</th><th scope="col">Prix unitaire</th><th scope="col">Panier</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($tbProduits as $produit) {
                ?>
                <tr>
                    <td>
                        <?php echo $produit->libelle;?>
                    </td>
                    <td>
                        <?php echo $produit->qteactuelle;?>
                    </td>
                    <td>
                        <?php echo $produit->descriptionp; ?>     
                    </td>
                    <td>
                        <?php echo $produit->prixunitaire; ?>
                    </td>
                    <td>
                        <form action="index.php?uc=Acceuil" method="post">
                            <input type="hidden" name="tIdItem" id="tIdItem" value="<?php echo $produit->idproduit; ?>">
                            <button type="submit" name="Action" id="Action" value="AjouterProduit"><i class="fa-solid fa-cart-arrow-down"></i></button>
                        </form>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>