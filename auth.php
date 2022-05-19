<?php
    require_once 'dbconf.php';
    session_start();

    function checkAuth() {
        if(isset($_SESSION['email'])) {
            return $_SESSION['nome'];
        } else 
            return 0;
    }
?>