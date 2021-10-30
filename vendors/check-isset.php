<?php
include('security.php');
if(!isset($_SESSION['username']))
{
    header('Location: /Franchise/vendors/login.php'); 
}
?>