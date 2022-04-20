<?php
    require_once 'App/config.php';
    require_once 'Modele/class.pdoDrive.php';

    $db = PdoDrive::getPdoDrive();
    session_start();
    require 'Vue/vue_header.html';
    if (!isset($_GET['uc'])) {
        $_GET['uc'] = "Acceuil";
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
            require 'Controleur/c_Acceuil.php';
            break;
    }
    require_once 'Vue/vue_footer.html';
    $db = null;
?>