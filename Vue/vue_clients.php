<section class="main-conteneur"> 
    <div class="centree">
        <table class="table table-dark">
            <thead>
                <tr> 
                   <th scope="col">idClient</th><th scope="col">Nom</th><th scope="col">Prenom</th><th>Email</th><th scope="col">statut</th><th scope="col">Débloquer le client ?</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($tbClients as $client) {
                ?>
                <tr>
                    <td>
                        <?php echo $client->idpersonne;?>
                    </td>
                    <td>
                        <?php echo $client->nom;?>
                    </td>
                    <td>
                        <?php echo $client->prenom; ?>     
                    </td>
                    <td>
                        <?php echo $client->email; ?>
                    </td>
                    <td>
                        <?php echo $client->statutclient;?>
                    </td>
                    <td>
                        <form action="index.php?uc=Clients" method="post">
                            <input type="hidden" name="idData" id="idData" value="<?php echo $client->idpersonne; ?>">
                            <button class='btn btn-primary' type="submit" name="Action" id="Action" value="debloquerClient">Débloquer</button>
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