<?php

use providers\korolev\cashmachine\classes\user,
    providers\korolev\cashmachine\classes\cashmachine;

require_once $_SERVER["DOCUMENT_ROOT"] . "/init.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/header.php";
$oCashMachine = new CashMachine();
$arCashMachines = $oCashMachine->getCashMachine();
?>
    <section class="cashmachine">
        <div class="container">
            <?php if(!empty($arCashMachines)): ?>
                <div class="cashmachine__inner">
                    <?php foreach($arCashMachines as $arCashMachine): ?>
                        <ul class="cashmachine__list">
                            <li class="cashmachine__item js-cashmachine-item" data-color="green">
                                <figure><img src="/images/" alt=""></figure>
                                <div class="cashmachine__item--inner">
                                    <div class="cashmachine__item--group">
                                        <div class="cashmachine__item--group-name">Адрес:</div>
                                        <div class="cashmachine__item--group-option"><?=$item["ADDRESS"]?></div>
                                    </div>
                                    <div class="cashmachine__item--group">
                                        <div class="cashmachine__item--group-name">Режим работы</div>
                                        <time datetime="" class="cashmachine__item--group-option"><?=$item["WORK_TIME"]?></time>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    <?php endforeach; ?>
                    <div class="cashmachine__select js-cashmachine-select">
                        <div class="cashmachine__select--wrapp red js-cashmachine-wrap">
                            <div class="cashmachine__select--top">
                                <div class="cashmachine__select--terminal"></div>
                                <div class="cashmachine__select--top-inner">
                                    <div class="cashmachine__select--cheque">
                                        <figure><img src="/korolev/cashmachine/images/cheque.png" alt=""></figure>
                                        <div class="cashmachine__select--cheque--paper">
                                            <div class="cashmachine__select--cheque--paper-text js-cashmachine-select-cheque-paper-text">
                                                <p></p>
                                                <p>Лимит: 80 000</p>
                                                <p>Снято: 10 000</p>
                                                <p>Пользователь: Такой то</p>
                                            </div>
                                            <figure><img src="/korolev/cashmachine/images/cheque-papper-bottom.png" alt=""></figure>
                                        </div>
                                    </div>
                                    <div class="cashmachine__select--keyboard">
                                        <ul class="cashmachine__select--keyboard-list">
                                            <?php for($index = 1; $index <= 9; $index++): ?>
                                                <li class="cashmachine__select--keyboard-item"><?=$index?></li>
                                            <?php endfor; ?>
                                            <li class="cashmachine__select--keyboard-item cancel">отмена</li>
                                            <li class="cashmachine__select--keyboard-item">0</li>
                                            <li class="cashmachine__select--keyboard-item ok">ок</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="cashmachine__select--bottom">
                                <div class="cashmachine__select--cash">
                                    <div class="cashmachine__select--cash-circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="cashmachine__inner empty">
                    <h1 class="form__title">Создайте банкомат</h1>
                    <p class="form__description">Создавать банкоматы может только администратор*</p>
                    <form action="" class="create-form" method="post">
                        <input type="text" name="phone" hidden>
                        <a class="button primary" href="/create/">Создать</a>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/footer.php"; ?>