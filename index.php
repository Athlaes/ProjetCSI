<?php
    require_once 'App/config.php';
    require_once 'Modele/class.pdoDrive.php';

    $db = PdoDrive::getPdoDrive();
    session_start();
    // $_SESSION["Panier"] = array($key=>$value);
    require 'Vue/vue_header.html';
    if (!isset($_GET['uc'])) {
        if (APP_CONFIG == 'Client') {
            $_GET['uc'] = "Acceuil";
        } else {
            $_GET['uc'] = "ConnexionEmploye";
        }
    }
    $uc = $_GET['uc'];
    switch ($uc) {
        case 'Acceuil':
            require 'Controleur/c_Acceuil.php';
            break;
        case 'Connexion':
            require 'Controleur/c_Connexion.php';
            break;
        case 'Deconnexion':
            $_SESSION['UserConnecte'] = null;
            $_SESSION['Employe'] = null;
            $_SESSION['Panier'] = array();
            require 'Controleur/c_Acceuil.php';
            break;
        case 'Panier' :
            require 'Controleur/c_Panier.php';
            break;
        case 'Commandes':
            require 'Controleur/c_Commandes.php';
            break;
        case 'ConnexionEmploye':
            require 'Controleur/c_ConnexionEmploye.php';
            break;
        case 'PlanningComposition':
            require 'Controleur/c_PlanningComposition.php';
            break;
        case 'PlanningLivraison':
            require 'Controleur/c_PlanningLivraison.php';
            break;
        case 'Clients':
            require 'Controleur/c_Clients.php';
            break;
    }
    require_once 'Vue/vue_footer.html';
    $db = null;
?>