<?php
    if(isset($_POST['Action'])){
        $action = $_POST['Action'];
        switch ($action) {
            case 'validerPaiement':
                
                break;
            case 'validerCommande':
                $montant = $_POST['montantData'];
                $nbPointCommande = $_POST['txtNbPoint'];
                $db->validerCommande($montant, $nbPointCommande);
                break;
        }
    }

    $tbCommandes = $db->getCommandes();
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_Commandes.php'; 