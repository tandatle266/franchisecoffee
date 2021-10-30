<?php
     include_once(__DIR__ .'/security.php');
     include_once(__DIR__."/../resources/Php/DBhandle/DBUser.php");
     include_once(__DIR__."/../resources/Php/DBhandle/DBConnection.php");
     include_once(__DIR__."/../resources/Php/fileService/LogFile.php");
     if(isset($_POST['login_btn'])){
         $obj = new DBUser();
         $check=$obj->checkLogin($_POST['user_name'],$_POST['password']);



     if($check)
     {

          $_SESSION['username'] = $_POST['user_name'];
         LogFile::setLogFile($_SESSION['username']);
         LogFile::updateLogFile("login",$_SESSION['username']);
           header('Location: /Franchise/resources/index.php');

          
     }
     else
     {
          $_SESSION['status'] = "Username / Password is Invalid";
          header('Location: login.php');
     }
    
}

    



?>