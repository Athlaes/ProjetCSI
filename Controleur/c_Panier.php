<?php
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'modifQuantite':
                $_SESSION['Panier'][$_POST['iData']]->qte = $_POST['nbProduit'];
                break;
            case 'supprimerProduit':
                unset($_SESSION['Panier'][$_POST['iData']]);
                break;
            case 'validerCommande':
                $montant = $_POST['montantData'];
                $nbPointUtilise = $_POST['nbPoint'];
                $db->createCommande($montant, $nbPointUtilise);
                break;
        }
    }
    
    // $tbPanier = $db->getProduitsPanier();
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_Panier.php';