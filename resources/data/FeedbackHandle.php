<?php
include_once(__DIR__."/../../resources/Php/DBhandle/DBFeedBack.php");
if(isset($_POST))
{
    $DB = new DBFeedBack();
    $DB->InsertInto($_POST);
}