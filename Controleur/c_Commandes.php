<?php
    if(isset($_POST['Action'])){
        $action = $_POST['Action'];
        switch ($action) {
            case 'validerPaiement':
                
                break;
        }
    }

    $tbCommandes = $db->getCommandes();
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_Commandes.php'; 