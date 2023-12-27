<?php

use providers\korolev\cashmachine\classes\user,
    providers\korolev\cashmachine\classes\cashmachine;

require_once $_SERVER["DOCUMENT_ROOT"] . "/init.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/header.php";

$oUser = new User();
$sError = "";
if(!empty($_POST["FIELDS"]["NAME"]) && !empty($_POST["FIELDS"]["PASSWORD"])) $sError = $oUser->checkAdmin();

$oCashMachine = new CashMachine();
$arBanknotes = $oCashMachine->getBanknotes();
if($_POST["CREATE_CASHMACHINE"] === "Y") $oCashMachine->setCashMachine();
?>
<script src="/local/libs/form/script.js"></script>
<section class="create-cashmachine">
    <div class="container">
        <?php if(!$oUser->isAdmin()): ?>
            <h1 class="form__title">Авторизация</h1>
            <form action="" class="authorized-form" method="post">
                <div class="form-group__inner">
                    <input type="text" name="phone" hidden>
                    <div class="form-group">
                        <label class="empty" for="name">Логин</label>
                        <input type="text" id="name" name=FIELDS[NAME] autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="empty" for="password">Пароль</label>
                        <input class="empty" type="password" id="password" name=FIELDS[PASSWORD] autocomplete="off" required>
                    </div>
                </div>
                <button class="button default" type="submit">Авторизоваться</button>
                <?php if($sError !== ""): ?>
                    <p class="form-message error"><?=$sError?></p>
                <?php endif; ?>
            </form>
        <?php else: ?>
            <?php if($_POST["CREATE_CASHMACHINE"] === "Y"): ?>
                <div class="container__inner">
                    <h1 class="form__title">Банкомат создан</h1>
                    <form action="" class="create-form" method="post">
                        <input type="text" name="phone" hidden>
                        <input type="text" name="CREATE_CASHMACHINE" value="" hidden>
                        <button class="button default" type="submit">Создать еще один</button>
                        <a class="button primary" href="/">Перейти к банкоматам</a>
                    </form>
                </div>
            <?php else: ?>
                <h1 class="form__title">Создание банкомата</h1>
                <form action="" class="create-form" method="post">
                    <div class="form-group__inner">
                        <input type="text" name="phone" hidden>
                        <input type="text" name="CREATE_CASHMACHINE" value="Y" hidden>
                        <div class="form-group">
                            <label for="name">Серийный номер</label>
                            <input type="text" id="name" name=FIELDS[ID] autocomplete="off" required readonly value="<?=random_int(10000000, 99999999);?>">
                        </div>
                        <div class="form-group">
                            <label class="empty" for="address">Адрес</label>
                            <input type="text" id="address" name=FIELDS[ADDRESS] minlength="10" autocomplete="off" required>
                            <button type="button" class="form-group__clear">&times;</button>
                        </div>
                        <div class="form-group">
                            <label class="empty" for="workTime">Режим работы</label>
                            <input class="work-time" type="text" id="workTime" name=FIELDS[WORK_TIME] autocomplete="off" required>
                            <button type="button" class="form-group__clear">&times;</button>
                        </div>
                    </div>
                    <?php if(!empty($arBanknotes)): ?>
                        <div class="form-group__inner">
                            <h4 class="form__subtitle">Наполнение банкомата:</h4>
                            <?php foreach($arBanknotes as $arBanknote): ?>
                                <div class="form-group">
                                    <label class="empty" for="<?=$arBanknote?>"><?=$arBanknote?></label>
                                    <input class="banknote" data-value="<?=$arBanknote?>" type="text" id="<?=$arBanknote?>" name=FIELDS[BANKNOTES][<?=$arBanknote?>] autocomplete="off" required>
                                    <button type="button" class="form-group__clear">&times;</button>
                                </div>
                            <?php endforeach; ?>
                            <div class="form-group">
                                <label for="name">Загрузка банкомата</label>
                                <input type="text" id="name" name=FIELDS[BALANCE] autocomplete="off" required readonly value="0">
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group__inner">
                        <button class="button default" type="submit">Создать</button>
                        <a class="button primary" href="/">Перейти к банкоматам</a>
                    </div>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/footer.php"; ?>
