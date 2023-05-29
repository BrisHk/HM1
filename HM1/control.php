<?php
    require_once 'dbconfig.php';
    session_start();

    function checkAuth() {
        if(isset($_SESSION['id'])) {
            return $_SESSION['id'];
            echo "sessione esistente!";
        } else 
            echo "La sessione non esiste!";
            return 0;
    }
?>