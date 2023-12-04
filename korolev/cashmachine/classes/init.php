<?php
session_start();
spl_autoload_register(function($sClass){
    $sFile = $_SERVER["DOCUMENT_ROOT"] . "/" . str_replace("\\", "/", $sClass) . ".php";
    if(file_exists($sFile)){
        require_once($sFile);
    }
});