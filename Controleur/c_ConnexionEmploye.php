<?php 
    $mauvaisMatricule == false;
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'seConnecter':
                $employe = $db->getEmploye($_POST['txtMatricule']);
                if (isset($employe)) {
                    $_SESSION['Employe'] = $employe;
                } else {
                    $mauvaisMatricule == true;
                }
                header('Location: index.php?uc=Planning');
                break;
        }
    }

    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_connexionEmploye.php';