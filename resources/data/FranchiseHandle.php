<?php
include_once(__DIR__."/../../resources/Php/DBhandle/DBFranchise.php");
if(isset($_POST))
{
    $DB = new DBFranchise();
    $_POST['type']= (int)$_POST['type'];
   echo  $DB->InsertInto($_POST)?'true':'false';
}
