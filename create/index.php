<?php
$bAuthorized = false;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/korolev/cashmachine/libs/baseform/style.css">
    <script src="/korolev/cashmachine/libs/baseform/script.js"></script>
    <title>Создание банкомата</title>
</head>
<body>
<div class="container">
    <?php if($bAuthorized): ?>
        <h1 class="form__title">Авторизация</h1>
        <form action="" class="authorized-form">
            <input type="text" name="phone" hidden>
            <div class="form-group">
                <label class="empty" for="name">Логин</label>
                <input type="text" id="name" name=FIELDS[NAME] autocomplete="off" required>
            </div>
            <div class="form-group">
                <label class="empty" for="password">Пароль</label>
                <input class="empty" type="password" id="password" name=FIELDS[PASSWORD] autocomplete="off" required>
            </div>
            <button type="submit">Авторизоваться</button>
        </form>
    <?php else: ?>
        <h1 class="form__title">Создание банкомата</h1>
        <form action="" class="create-form">
            <input type="text" name="phone" hidden>
            <div class="form-group">
                <label for="name">Серийный номер</label>
                <input type="text" id="name" name=FIELDS[NAME] autocomplete="off" required readonly value="<?=random_int(10000000, 99999999);?>">
            </div>
            <div class="form-group">
                <label class="empty" for="address">Адрес</label>
                <input type="text" id="address" name=FIELDS[ADDRESS] autocomplete="off" required>
            </div>
            <div class="form-group">
                <label class="empty" for="workTime">Режим работы</label>
                <input type="text" id="workTime" name=FIELDS[WORK_TIME] autocomplete="off" required>
            </div>
            <h4 class="form__subtitle">Наполнение банкомата:</h4>
            <div class="form-group">
                <label class="empty" for="5000">5000</label>
                <input type="text" id="5000" name=FIELDS[5000] autocomplete="off" required>
            </div>
            <div class="form-group">
                <label class="empty" for="2000">2000</label>
                <input type="text" id="2000" name=FIELDS[2000] autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="name">Загрузка банкомата</label>
                <input type="text" id="name" name=FIELDS[LOAD_CASHMACHINE] autocomplete="off" required readonly>
            </div>
            <button type="submit">Создать</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
