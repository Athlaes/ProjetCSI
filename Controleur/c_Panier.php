<?php
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'modifQuantite':
                foreach ($_SESSION['Panier'] as $produit) {
                    if ($produit->idproduit == $_POST['idData']) {
                        $produit->qte = $_POST['nbProduit'];
                    }
                }
                break;
            case 'supprimerProduit':
                foreach ($_SESSION['Panier'] as $key => $produit) {
                    if ($produit->idproduit == $_POST['idData']) {
                        $produit = (array) $produit;
                        unset($_SESSION['Panier'][$key]);
                    }
                }
                break;
        }
    }
    
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_Panier.php';