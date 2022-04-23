<?php
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'seConnecter':
                $email = $_POST['txtEmail'];
                $password = $_POST['txtPwd'];
                $user = $db->getPassword($email);
                if (isset($user->mdp)) {
                    if ($user->mdp == $password) {
                        $userConnecte = $db->getUserInformation($user->idpersonne);
                        $_SESSION['UserConnecte'] = $userConnecte;
                        header('Location: index.php?uc=Acceuil');
                    } else {
                        $mauvaisMdp = true;
                    }
                } else {
                    $mauvaisMdp = true;
                }
                break;
            case 'sinscrire':
                $user = (object) array(
                    "nom" => $_POST["txtNom"], 
                    "email" => $_POST["txtEmail"], 
                    "identifiant" => $_POST["txtIdentifiant"],
                    "pwd" => $_POST["txtPassword"],
                    "prenom" => $_POST["txtPrenom"],
                    "rue" => $_POST["txtRue"],
                    "ville" => $_POST["txtVille"],
                    "tel" =>  $_POST["tel"],
                    "CP" =>  $_POST["nbCP"],
                );
                $idUser = $db->ajouterUtilisateur($user);
                $userConnecte = $db->getUserInformation($idUser);
                $_SESSION['UserConnecte'] = $userConnecte;
                header('Location: index.php?uc=Acceuil');
                break;
        }
    }
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_connexion.php';

