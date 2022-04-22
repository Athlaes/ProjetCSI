<?php
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'AjouterProduit':
                $produit = $db->getProduit($_POST['tIdItem']);
                $produit = (array) $produit;
                $produit['qte'] = 1;
                $produit = (object) $produit;
                array_push($_SESSION['Panier'], $produit);
                break;
        } 
    }
    $tbProduits = $db->getProduits();
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_Acceuil.php';
    // caca;
?>