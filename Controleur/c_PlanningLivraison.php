<?php 
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'modifStatut':
                $idCommande = $_POST['idData'];
                if ($_POST['txtStatut'] == 'enLivraison') {
                    $db->setCommandeLivraison($idCommande, $_SESSION['Employe']->idpersonne);
                } else if ($_POST['txtStatut'] == 'Livree') {
                    $db->setLivraisonValidee($idCommande);
                } else if ($_POST['txtStatut'] == 'miseDeCote') {
                    $db->setLivraisonCote($idCommande);
                }
                break;
            case 'setQuai':
                $idCommande = $_POST['idData'];
                $db->setQuai($_POST['nbQuai'], $idCommande);
                break;
        }
    }

    $tbCommandes = $db->getCommandesLivraison();
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_plannningLivraison.php';