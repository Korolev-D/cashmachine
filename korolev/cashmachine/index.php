<?php

use korolev\cashmachine\classes\user,
    korolev\cashmachine\classes\cashmachine;

require_once $_SERVER["DOCUMENT_ROOT"] . "/korolev/cashmachine/classes/init.php";

$oUser = new user();
$oUser->setLimit(70000);
$arUser = $oUser->getUser();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p><?=$arUser["LIMIT"]?></p>
</body>
</html>
