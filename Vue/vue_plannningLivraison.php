<section class="main-conteneur"> 
    <div class="centree">
        <table class="table table-dark">
            <thead>
                <tr> 
                   <th scope="col">idCommande</th><th scope="col">idClient</th><th scope="col">HeureLivraison</th><th>Quai</th><th scope="col">statutCommande</th><th scope="col">statut à modifier</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($tbCommandes as $commande) {
                ?>
                <tr>
                    <td>
                        <?php echo $commande->idcommande;?>
                    </td>
                    <td>
                        <?php echo $commande->idclient;?>
                    </td>
                    <td>
                        <?php echo $commande->heurelivraison; ?>     
                    </td>
                    <td>
                        <form action="index.php?uc=PlanningLivraison" method="post">
                            <input type="hidden" name="idData" id="idData" value="<?php echo $commande->idcommande; ?>">
                            <?php
                                if (isset($commande->quai)) {
                                    ?>
                                        <input type="number" name="nbQuai" id="nbQuai" value="<?php echo $commande->quai; ?>" max='10' min='1'>
                                    <?php
                                }else {
                                    ?>
                                    <input type="number" name="nbQuai" id="nbQuai" value="1" max='10' min='1'>
                                    <?php
                                }
                            ?>
                            <button class='btn btn-primary' type="submit" name="Action" id="Action" value="setQuai">Valider quai</button>
                        </form>
                    </td>
                    <td>
                        <?php echo $commande->statutcommande;?>
                    </td>
                    <td>
                        <form action="index.php?uc=PlanningLivraison" method="post">
                            <select name="txtStatut" id="txtStatut">
                                <option value="enLivraison">En livraison</option>
                                <option value="Livree">Livrée</option>
                                <option value="miseDeCote">Mise de côté</option>
                            </select>
                            <input type="hidden" name="idData" id="idData" value="<?php echo $commande->idcommande; ?>">
                            <button class='btn btn-primary' type="submit" name="Action" id="Action" value="modifStatut">Valider statut composition</button>
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