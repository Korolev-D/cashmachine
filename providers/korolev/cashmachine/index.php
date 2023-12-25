<?php

use korolev\cashmachine\classes\user,
    korolev\cashmachine\classes\cashmachine;

require_once $_SERVER["DOCUMENT_ROOT"] . "/korolev/cashmachine/classes/init.php";

$oUser = new User();
$arUser = $oUser->getUser();

$oCashMachine = new CashMachine();
$arCashMachine = $oCashMachine->getCashMachine();


echo "<pre>";
print_r($arCashMachine);
