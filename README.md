Задание для WeekDev#3: Банкомат

Нужно написать программу банкомата используя только PHP. HTML, CSS, JS только для визуализации.
Требуется конфиг на сервере в котором указывается количество загруженных купюр, номиналы: 5000, 2000, 1000, 500, 200, 100

Банкомат только на выдачу!
Пользователь задаёт необходимую сумму для выдачи, банкомат должен либо выдать эту сумму либо выдать сообщение о
невозможности выдачи с описанием причины.
Если выдача произошла, для следующего снятия того же или другого пользователя будет меньше купюр для снятия!
Пользователь должен видеть полученную им сумму и купюры (количество и номинал).
У каждого пользователя кредитный лимит 100 000 рублей при первом входе. Пользователь должен видеть свой счет даже после
перезагрузки страницы.

Требования:
 - Программа должна полностью работать только на стороне сервера, PHP.
 - Обязательное использование ООП
 - Все должно быть реализовано без записей в БД.
 - Запрещено использовать любые библиотеки PHP.
 - Должны использоваться все номиналы: 5000, 2000, 1000, 500, 200, 100
 - В консоль должна выводиться информация о текущей загрузке банкомата. (Количество загруженных купюр, каждого номинала)
 - Для сброса банкомата к изначальному конфигу, нужен специальный параметр
 - Должна быть возможность создавать неограниченное количество банкоматов на отдельной странице со своим конфигом.
 - У пользователя должен быть запрет на доступ к конфигу.
