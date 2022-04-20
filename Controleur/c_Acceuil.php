<?php
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'value':
                # code...
                break;
        } 
    }
    $tbProduits = $db->getProduits();
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_Acceuil.php';
?>