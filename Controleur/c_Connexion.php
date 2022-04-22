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
                // $_POST[];
                //caca
                break;
        }
    }
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_connexion.php';

