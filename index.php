<?php

use providers\korolev\cashmachine\classes\user,
    providers\korolev\cashmachine\classes\cashmachine;

require_once $_SERVER["DOCUMENT_ROOT"] . "/init.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/header.php";
$oCashMachine = new CashMachine();
$arCashMachineItems = $oCashMachine->getCashMachineItems();

$arCashMachine = array();
if(!empty($_GET["id"])){
    $arCashMachine = $oCashMachine->getCashMachine($_GET["id"]);
}
$iColor = 1;
$oUserAuthorized = false;


$oUser = new User();
$bUserAuthorized = $oUser->isAuthorized();
$arUser = $oUser->getUser();
?>
    <script src="/local/js/cashmachine.js"></script>
    <section class="cashmachine-wrapper">
        <div class="container">
            <?php if(!empty($arCashMachineItems)): ?>
            <div class="cashmachine__block">
                <div class="cashmachine-list__inner">
                    <h1>Ближайшие банкоматы</h1>
                    <ul class="cashmachine-list">
                        <?php foreach($arCashMachineItems as $iKeyCashMachine => $arCashMachineItem):
                            if($iColor > 3) $iColor = 1;
                            ?>
                            <li class="cashmachine-item" data-id="<?=$arCashMachineItem["ID"]?>">
                                <figure><img src="/local/images/atm-machines-<?=$iColor?>.jpg" alt="<?=$arCashMachineItem["ID"]?>"></figure>
                                <div class="cashmachine-item__inner">
                                    <div class="cashmachine__item--group">
                                        <div class="cashmachine__item--group-name">Адрес:</div>
                                        <div class="cashmachine__item--group-option"><?=$arCashMachineItem["ADDRESS"]?></div>
                                    </div>
                                    <div class="cashmachine__item--group">
                                        <div class="cashmachine__item--group-name">Режим работы</div>
                                        <time datetime="" class="cashmachine__item--group-option"><?=$arCashMachineItem["WORK_TIME"]?></time>
                                    </div>
                                </div>
                            </li>
                            <?php $iColor++;
                        endforeach; ?>
                    </ul>
                </div>
                <div class="cashmachine">
                    <?php if(empty($arCashMachine)): ?>
                        <h2 class="form__title">Выберите банкомат из списка</h2>
                    <?php else: ?>
                        <div class="cashmachine__inner <?=$arCashMachine["COLOR"]?>">
                            <div class="cashmachine__left-block"></div>
                            <div class="cashmachine__middle-block">
                                <div class="cashmachine__middle--top-block">
                                    <div class="cashmachine__middle--top-block-inner">Cash Machine</div>
                                </div>
                                <div class="cashmachine__middle--middle-block">
                                    <div class="cashmachine__terminal">
                                        <form class="terminal" method="post">
                                            <div class="cashmachine__first-key cashmachine__key" data-value="exit">выйти</div>
                                            <div class="cashmachine__second-key cashmachine__key" data-value="ok">ok</div>
                                            <div class="cashmachine__third-key cashmachine__key" data-value="cancel">отмена</div>
                                            <div class="cashmachine__fourth-key cashmachine__key" data-value="balance">баланс</div>
                                            <div class="cashmachine__fifth-key cashmachine__key" data-value="get">снять</div>
                                            <div class="cashmachine__terminal--inner">
                                                <?php if(!$bUserAuthorized): ?>
                                                    <div class="form-group">
                                                        <input type="text" name="FIELDS[PIN_CODE]" placeholder="Введите пин код ****" readonly autocomplete="off">
                                                    </div>
                                                <?php elseif($_POST["STATUS_GET_MONEY"] === "Y"): ?>
                                                    <div class="cashmachine__terminal-popup">
                                                        <?php if(!empty($arUser["BANKNOTES"])): ?>
                                                            <table>
                                                                <?php if(!empty($arUser["SUM"])): ?>
                                                                    <caption>Снято <?=$arUser["SUM"]?></caption>
                                                                <?php endif; ?>
                                                                <tr>
                                                                    <th>Номинал</th>
                                                                    <th>Количество</th>
                                                                </tr>
                                                                <?php foreach($arUser["BANKNOTES"] as $iKeyBanknote => $iBanknote): ?>
                                                                    <tr>
                                                                        <td><?=$iKeyBanknote?></td>
                                                                        <td><?=$iBanknote?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </table>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php elseif($_POST["STATUS_GET_MONEY"] === "N"): ?>
                                                    <div class="cashmachine__terminal-popup"><p class="message error">Недостаточно средств!</p></div>
                                                <?php elseif($_POST["FIELDS"]["ACTION"] === "get"): ?>
                                                    <div class="form-group">
                                                        <input type="text" name="FIELDS[GET_MONEY]" placeholder="Введите сумму снятия" readonly autocomplete="off">
                                                    </div>
                                                <?php else: ?>
                                                    <div class="cashmachine__terminal-popup">
                                                        <p class="message">Ваш баланс <?=$arUser["BALANCE"]?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="cashmachine__middle--middle-block-inner">
                                        <div class="cashmachine__money-block">
                                            <p class="cashmachine__money-block--text">CASH</p>
                                            <div class="cashmachine__money-block--inner">
                                                <div class="cashmachine__money-block-flap<?=$_POST["STATUS_GET_MONEY"] === "Y" ? " flap" : ""?>"></div>
                                                <img src="/local/images/cash.jpg" alt="CASH">
                                            </div>
                                        </div>
                                        <ul class="cashmachine__keyboard">
                                            <?php for($index = 1; $index <= 9; $index++): ?>
                                                <li class="cashmachine__keyboard-item" data-value="<?=$index?>"><?=$index?></li>
                                            <?php endfor; ?>
                                            <li class="cashmachine__keyboard-item cancel">отмена</li>
                                            <li class="cashmachine__keyboard-item" data-value="0">0</li>
                                            <li class="cashmachine__keyboard-item ok" data-value="ok">ок</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="cashmachine__middle--bottom-block"></div>
                            </div>
                            <div class="cashmachine__right-block"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php else: ?>
            <div class="container__inner">
                <h1 class="form__title">Создайте банкомат</h1>
                <form action="" class="create-form" method="post">
                    <p class="form__description">Создавать банкоматы может только администратор*</p>
                    <input type="text" name="phone" hidden>
                    <a class="button primary" href="/create/">Создать</a>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </section>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/footer.php"; ?>