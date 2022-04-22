<?php 
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'seConnecter':
                # code...
                break;
        }
    }

    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_connexionEmploye.php';