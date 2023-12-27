<?php

use providers\korolev\cashmachine\classes\user,
    providers\korolev\cashmachine\classes\cashmachine;

require_once $_SERVER["DOCUMENT_ROOT"] . "/init.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/header.php";
$oCashMachine = new CashMachine();
$arCashMachines = $oCashMachine->getCashMachine();
$iColor = 1;
$oUserAuthorized = false;
?>
    <section class="cashmachine-wrapper" hidden>
        <div class="container">
            <?php if(!empty($arCashMachines)): ?>
                <div class="cashmachine__inner">
                    <ul class="cashmachine__list">
                        <?php foreach($arCashMachines as $iKeyCashMachine => $arCashMachine):
                            if($iColor > 3) $iColor = 1;
                            ?>
                            <li class="cashmachine__item js-cashmachine-item" data-color="green">
                                <figure><img src="/local/images/atm-machines-<?=$iColor?>.jpg" alt=""></figure>
                                <div class="cashmachine__item--inner">
                                    <div class="cashmachine__item--group">
                                        <div class="cashmachine__item--group-name">Адрес:</div>
                                        <div class="cashmachine__item--group-option"><?=$arCashMachine["ADDRESS"]?></div>
                                    </div>
                                    <div class="cashmachine__item--group">
                                        <div class="cashmachine__item--group-name">Режим работы</div>
                                        <time datetime="" class="cashmachine__item--group-option"><?=$arCashMachine["WORK_TIME"]?></time>
                                    </div>
                                </div>
                            </li>
                            <?php $iColor++;
                        endforeach; ?>
                    </ul>
                    <div class="cashmachine__select js-cashmachine-select">
                        <div class="cashmachine__select--wrapp red js-cashmachine-wrap">
                            <div class="cashmachine__select--top">
                                <div class="cashmachine__select--terminal">
                                    <?php if(!$oUserAuthorized): ?>
                                        <form action="" class="authorized" method="post">
                                            <div class="form-group">
                                                <input type="text" id="name" name=FIELDS[PIN_CODE] autocomplete="off" required readonly placeholder="Пин код ****">
                                            </div>
                                        </form>
                                    <?php else: ?>
                                    <?php endif; ?>
                                </div>
                                <div class="cashmachine__select--top-inner">
                                    <div class="cashmachine__select--keyboard">
                                        <ul class="cashmachine__select--keyboard-list">
                                            <?php for($index = 1; $index <= 9; $index++): ?>
                                                <li class="cashmachine__select--keyboard-item" data-value="<?=$index?>"><?=$index?></li>
                                            <?php endfor; ?>
                                            <li class="cashmachine__select--keyboard-item cancel">отмена</li>
                                            <li class="cashmachine__select--keyboard-item" data-value="0">0</li>
                                            <li class="cashmachine__select--keyboard-item ok">ок</li>
                                        </ul>
                                    </div>
                                    <div class="cashmachine__select--cheque">
                                        <figure><img src="local/images/cheque.png" alt=""></figure>
                                        <?php /*
                                        <div class="cashmachine__select--cheque--paper">
                                            <div class="cashmachine__select--cheque--paper-text js-cashmachine-select-cheque-paper-text">
                                                <p></p>
                                                <p>Лимит: 80 000</p>
                                                <p>Снято: 10 000</p>
                                                <p>Пользователь: Такой то</p>
                                            </div>
                                            <figure><img src="/local/images/cheque-papper-bottom.png" alt=""></figure>
                                        </div>
                                        */ ?>
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
    <section class="cashmachine-wrapper">
        <div class="container">
            <?php if(!empty($arCashMachines)): ?>
                <div class="cashmachine-list__inner">
                    <h1>Ближайшие банкоматы</h1>
                    <ul class="cashmachine-list">
                        <?php foreach($arCashMachines as $iKeyCashMachine => $arCashMachine):
                            if($iColor > 3) $iColor = 1;
                            ?>
                            <li class="cashmachine-item">
                                <figure><img src="/local/images/atm-machines-<?=$iColor?>.jpg" alt="<?=$arCashMachine["ID"]?>"></figure>
                                <div class="cashmachine-item__inner">
                                    <div class="cashmachine__item--group">
                                        <div class="cashmachine__item--group-name">Адрес:</div>
                                        <div class="cashmachine__item--group-option"><?=$arCashMachine["ADDRESS"]?></div>
                                    </div>
                                    <div class="cashmachine__item--group">
                                        <div class="cashmachine__item--group-name">Режим работы</div>
                                        <time datetime="" class="cashmachine__item--group-option"><?=$arCashMachine["WORK_TIME"]?></time>
                                    </div>
                                </div>
                            </li>
                            <?php $iColor++;
                        endforeach; ?>
                    </ul>
                </div>
                <div class="cashmachine">
                    <div class="cashmachine__inner blue">
                        <div class="cashmachine__left-block"></div>
                        <div class="cashmachine__middle-block">
                            <div class="cashmachine__middle--top-block">
                                <div class="cashmachine__middle--top-block-inner">Cash Machine</div>
                            </div>
                            <div class="cashmachine__middle--middle-block">
                                <div class="cashmachine__terminal">
                                    <div class="cashmachine__first-key cashmachine__key">ok</div>
                                    <div class="cashmachine__second-key cashmachine__key">отмена</div>
                                    <div class="cashmachine__third-key cashmachine__key">лимит</div>
                                    <div class="cashmachine__fourth-key cashmachine__key">снять</div>
                                    <p class="cashmachine__terminal--text">Введите нужную сумму для снятия и нажмите кнопку
                                        ok
                                    </p>
                                </div>
                                <div class="cashmachine__middle--middle-block-inner">
                                    <div class="cashmachine__money-block">
                                        <p class="cashmachine__money-block--text">CASH</p>
                                        <div class="cashmachine__money-block--inner"></div>
                                    </div>
                                    <ul class="cashmachine__keyboard">
                                        <?php for($index = 1; $index <= 9; $index++): ?>
                                            <li class="cashmachine__keyboard-item" data-value="<?=$index?>"><?=$index?></li>
                                        <?php endfor; ?>
                                        <li class="cashmachine__keyboard-item cancel">отмена</li>
                                        <li class="cashmachine__keyboard-item" data-value="0">0</li>
                                        <li class="cashmachine__keyboard-item ok">ок</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="cashmachine__middle--bottom-block"></div>
                        </div>
                        <div class="cashmachine__right-block"></div>
                    </div>
                </div>
            <?php else: ?>
                <h1 class="form__title">Создайте банкомат</h1>
                <p class="form__description">Создавать банкоматы может только администратор*</p>
                <form action="" class="create-form" method="post">
                    <input type="text" name="phone" hidden>
                    <a class="button primary" href="/create/">Создать</a>
                </form>
            <?php endif; ?>
        </div>
    </section>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/footer.php"; ?>