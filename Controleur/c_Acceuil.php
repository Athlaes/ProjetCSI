<?php
    if (isset($_POST['Action'])) {
        $action = $_POST['Action'];
        switch ($action) {
            case 'value':
                # code...
                break;
        } 
    }
    require 'Vue/vue_Acceuil.php';
?>