<?php 
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'value':
                # code...
                break;
        }
    }
    if (isset($_SESSION['idUser'])) {
        
    }
    require 'Vue/vue_Navbar.php';
