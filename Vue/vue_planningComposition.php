<section class="main-conteneur"> 
    <div class="centree">
        <table class="table table-dark">
            <thead>
                <tr> 
                   <th scope="col">idCommande</th><th scope="col">idClient</th><th scope="col">HeureLivraison</th><th scope="col">statutCommande</th><th scope="col">statut à modifier</th>
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
                        <?php echo $commande->statutcommande;?>
                    </td>
                    <td>
                        <form action="index.php?uc=PlanningComposition" method="post">
                            <select name="txtStatut" id="txtStatut">
                                <option value="enComposition">En composition</option>
                                <option value="compositionValidee">Composition validee</option>
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