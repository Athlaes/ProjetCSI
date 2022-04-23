<?php
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'debloquerClient':
                $db->setClientActive($_POST['idData']);
                break;
        }
    }

    $tbClients = $db->getClientsBloqué();
    require 'Controleur/c_Navbar.php';
    require 'Vue/vue_clients.php';