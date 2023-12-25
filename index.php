<?php ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Week Dev</title>
</head>
<body>
<script src="korolev/cashmachine/js/script.js"></script>
<section class="cashmachine">
    <div class="container">
        <div class="cashmachine__inner">
            <ul class="cashmachine__list">
                <?php
                $counter = 1;
                for($index = 1; $index < 10; $index++):
                    if($counter > 3) $counter = 1;
                    $color = "red";
                    if($counter === 2) $color = "green";
                    if($counter === 3) $color = "blue";
                    ?>
                    <li class="cashmachine__item js-cashmachine-item" data-color="<?=$color?>">
                        <figure><img src="/korolev/cashmachine/images/atm-machines-<?=$counter?>.jpg" alt=""></figure>
                        <div class="cashmachine__item--inner">
                            <div class="cashmachine__item--group">
                                <div class="cashmachine__item--group-name">Адрес:</div>
                                <div class="cashmachine__item--group-option">ул. Ломоносова 13</div>
                            </div>
                            <div class="cashmachine__item--group">
                                <div class="cashmachine__item--group-name">Режим работы</div>
                                <time datetime="" class="cashmachine__item--group-option">10:00-18:00</time>
                            </div>
                        </div>
                    </li>
                    <?php $counter++;
                endfor; ?>
            </ul>
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
    </div>
</section>
</body>
</html>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        list-style: none;
        font-family: system-ui;
    }

    .cashmachine {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    .container {
        margin: auto;
        padding: 0 30px;
    }

    .cashmachine__inner {
        display: grid;
        grid-template-columns: 1fr 3fr;
        gap: 24px;
    }

    .cashmachine__list {
        height: 100vh;
        overflow-y: scroll;
        display: grid;
    }

    .cashmachine__item {
        display: grid;
        grid-template-columns: 50px auto;
        gap: 16px;
        cursor: pointer;
        border-bottom: 1px solid #e6e6e6c2;
    }

    .cashmachine__item figure {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 100px;
        overflow: hidden;
    }

    .cashmachine__item figure img {
        width: 50px;
        height: 90px;
        object-fit: cover;
        object-position: center;
    }

    .cashmachine__item--inner {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .cashmachine__item--group {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .cashmachine__item--group-name {
        font-size: 12px;
        color: #878787;
    }

    .cashmachine__item--group-option {
        font-size: 16px;
        white-space: nowrap;
    }

    .cashmachine__select {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .cashmachine__select--wrapp {
        display: grid;
        gap: 50px;
        width: 100%;
        height: 100vh;
        padding: 70px 70px 80px;
        border-top-right-radius: 24px;
        border-top-left-radius: 24px;
    }

    .cashmachine__select--wrapp.red {
        background-color: rgba(176, 82, 82, 0.84);
    }

    .cashmachine__select--wrapp.green {
        background-color: rgb(79 153 32);
    }

    .cashmachine__select--wrapp.blue {
        background-color: rgb(29 93 154);
    }

    .cashmachine__select--top {
        display: grid;
        grid-template-columns: 70% 30%;
        gap: 20px;
        height: 500px;
    }

    .cashmachine__select--terminal {
        width: 100%;
        height: 100%;
        background-color: #2f2f5e;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #e5e3e3;
    }

    .cashmachine__select--top-inner {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
    }

    .cashmachine__select--cheque {
        position: relative;
        width: 100%;
        height: 50px;

    }

    .cashmachine__select--cheque figure {
        position: relative;
        z-index: 1;
        width: 100%;
        height: 100%;
    }

    .cashmachine__select--cheque figure img {
        width: 100%;
        height: 100%;
        object-position: center;
        object-fit: cover;
    }

    .cashmachine__select--cheque--paper {
        position: absolute;
        left: 50%;
        top: 15px;
        width: 80%;
        transform: translateX(-50%);
        height: 100px;
    }

    .cashmachine__select--cheque--paper-text {
        position: relative;
        padding: 20px;
        width: 100%;
        height: 100%;
        background-color: aliceblue;
    }

    .cashmachine__select--cheque--paper figure {
        width: 100%;
        height: 100%;
        object-position: center;
    }

    .cashmachine__select--cheque--paper figure img {
        width: 100%;
        height: auto;
        object-position: center;
        object-fit: contain;
    }

    .cashmachine__select--bottom {
        display: grid;
        grid-template-columns: 70% 30%;
        gap: 20px;
    }

    .cashmachine__select--cash {
        position: relative;
        width: 100%;
        height: 50px;
        background-color: aliceblue;
        border-radius: 8px;
    }

    .cashmachine__select--cash::before {
        z-index: 1;
        position: absolute;
        left: 50%;
        top: 25px;
        transform: translateX(-50%);
        width: 90%;
        height: 1px;
        background-color: #2f2f5e;
        content: "";
    }

    .cashmachine__select--cash-circle {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 75px;
        height: 75px;
        background-color: aliceblue;
        border-radius: 999px;
        overflow: hidden;
    }

    .cashmachine__select--keyboard {
        width: 246px;
        height: fit-content;
    }

    .cashmachine__select--keyboard-list {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: 1fr 1fr 1fr 1fr;
        gap: 5px;
        height: 300px;
    }

    .cashmachine__select--keyboard-item {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e5e3e3;
        border-radius: 8px;
        font-size: 24px;
        cursor: pointer;
        border: 1px solid #e5e3e3;
    }

    .cashmachine__select--keyboard-item.cancel {
        font-size: 20px;
        background-color: #dea400;
        color: #fff;
    }

    .cashmachine__select--keyboard-item.ok {
        font-size: 20px;
        background-color: #5ede00ab;
        color: #fff;
    }

    .cashmachine__select--keyboard-item:hover {
        opacity: 0.9;
    }
</style>
