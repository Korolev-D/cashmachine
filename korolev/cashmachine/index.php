<?php

use korolev\cashmachine\classes\user,
    korolev\cashmachine\classes\cashmachine;

require_once $_SERVER["DOCUMENT_ROOT"] . "/korolev/cashmachine/classes/init.php";

$oUser = new User();
$arUser = $oUser->getUser();

$oCashMachine = new CashMachine();
$arCashMachine = $oCashMachine->getCashMachine();
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
<h3>Банкомат:</h3>
<p>
    <span>Лимит банкомата</span>
    <span><?=number_format($arCashMachine["LIMIT"], 0, ".", ".")?></span>
</p>
<p>
    <span>Номинал банкнот</span>
    <span><?=implode(",", $arCashMachine["BANKNOTES"])?></span>
</p>
<h3>Пользователь:</h3>
<p>
    <span>Лимит пользователя</span>
    <span><?=number_format($arUser["LIMIT"], 0, ".", ".")?></span>
</p>
<p>
    <?php $iSum = 15500 ?>
<h4>Запрос на снятие <?=$iSum?></h4>
</p>
<p>
    <?php $arBanknotes = $oUser->getCash($iSum);
    foreach($arBanknotes

    as $iBanknoteKey => $iBanknote): ?>
<p>
    <span>Номинал: <?=$iBanknoteKey?></span>
    <span>Количество: <?=$iBanknote?></span>
</p>
<?php endforeach; ?>
</p>
<p>
    <span>Лимит пользователя</span>
    <span><?=number_format($arUser["LIMIT"], 0, ".", ".")?></span>
</p>
</body>
</html>
