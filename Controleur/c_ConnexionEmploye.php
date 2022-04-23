<?php 
    $mauvaisMatricule = false;
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'seConnecter':
                $employe = $db->getEmploye($_POST['txtMatricule']);
                if (!empty($employe)) {
                    $_SESSION['Employe'] = $employe;
                    header('Location: index.php?uc=PlanningComposition');
                } else {
                    $mauvaisMatricule = true;
                }
                break;
        }
    }

    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_connexionEmploye.php';