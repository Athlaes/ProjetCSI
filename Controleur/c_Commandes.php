<?php
    if(isset($_POST['Action'])){
        $action = $_POST['Action'];
        switch ($action) {
            case 'payerCommande':
                $db->payerCommande($_POST['idData']);
                break;
            case 'validerCommande':
                $montant = $_POST['montantData'];
                $nbPointCommande = $_POST['txtNbPoint'];
                $db->validerCommande($montant, $nbPointCommande);
                $_SESSION['Panier'] = array();
                break;
            case 'supprimerCommande':
                $db-> supprimerCommande($_POST['idData']);
                break;
            case 'confirmerDHLivraison':
                $db->updatePlanning($_POST['dateLivraison'], $_POST['hLivraison'], $_POST['idData']);
                break;
        }
    }

    $tbCommandes = $db->getCommandes();
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_Commandes.php'; 