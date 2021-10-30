<?php
    session_start();
    include_once(__DIR__ .'/dbconfig.php');

    if(!isset($_SESSION['username']))
    {
        header('Location: /Franchise/vendors/login.php'); 
    }
    
    
?>