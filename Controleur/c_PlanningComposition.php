<?php 
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'modifStatut':
                $idCommande = $_POST['idData'];
                if ($_POST['txtStatut'] == 'enComposition') {
                    $db->setCommandeComposition($idCommande, $_SESSION['Employe']->idpersonne);
                } else if ($_POST['txtStatut'] == 'compositionValidee') {
                    $db->setCompositionValidee($idCommande);
                }
                break;
        }
    }

    $tbCommandes = $db->getCommandes20();
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_planningComposition.php';