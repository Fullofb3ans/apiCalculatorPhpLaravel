Использование

Задать значение левой переменной можно с помощью отправки POST запроса на адрес 
с указанным значением в url, после /leftValue/, например http://127.0.0.1:8000/api/leftValue/5
ответ:
{
"left_value": "5",
"id": 1
}

 значение правой задается аналогично, но теперь задаем после /rightValue/,
 например http://127.0.0.1:8000/api/rightValue/5

ответ:
{
"right_value": "5",
"id": 1
}

значение оператора задается также в url после после /operation/, например,
http://127.0.0.1:8000/api/operation/+
ответ:
{
"operation": "5",
"id": 1
}

Для вычисления результата используем Get запрос по адресу
http://127.0.0.1:8000/api/result/+
getResult 
history

Деплой
<!-- обновление пакетов -->
1) sudo apt update

<!-- установка apache -->
2) sudo apt install apache2

<!-- установка php -->
3) sudo apt install php

<!-- установка сервера mysql -->
4) sudo apt install mysql-server

<!-- установка сервера mysql -->
5) 
>sudo mysql
>CREATE USER 'appuser'@'localhoist' IDENTIFIED WITH mysql_native_password BY 'password'
>GRANT ALL PRIVILEGES ON *.* TO 'appuser'@'localhost' WITH GRANT OPTION;
>exit
<!-- установка composer -->
6) php -r "copy('http://getcomposer.org/installer', 'composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer

<!-- установка рассширений -->
7) sudo apt install git
    sudo apt install unzip 
    sudo apt install php-zip php-mysql php-xml php-curl

<!-- клонирование -->
8) git clone https://gitflic.ru/project/gazinskyog/calculatorapi-php

<!-- клонирование -->
9) cd 

Тестирование

positive cases:

1. отправил post запрос на адрес localhost:3306/LeftValue/2
    пришел ответ, со значениями Left_value = 2
    проверил базу данных, указанное значение Left_value появилось в новом поле

2. отправил post запрос на адрес localhost:3306/rightValue/2
    пришел ответ, со значениями right_value = 2
    проверил базу данных, указанное значение right_value появилось в новом поле

3. отправил post запрос на адрес localhost:3306/operation/+
    пришел ответ, со значениями operation = +
    проверил базу данных, значение operation появилось в новом поле
    отправил get запрос на адрес localhost:3306/result
    пришел ответ, со значениями Left_value = 2, right_value = 2, operation=+, result =4
    проверил базу данных, указанные значения появились в новом поле

4. отправил post запрос на адрес localhost:3306/operation/*
    пришел ответ, со значениями operation = *
    проверил базу данных, значение operation появилось в новом поле
    отправил get запрос на адрес localhost:3306/result
    пришел ответ, со значениями Left_value = 2, right_value = 2, operation = -, result =4
    проверил базу данных, указанные значения появились в новом поле

5. отправил post запрос на адрес localhost:3306/operation//
    пришел ответ, со значениями operation = /
    проверил базу данных, значение operation появилось в новом поле
    отправил get запрос на адрес localhost:3306/result
    пришел ответ, со значениями Left_value = 2, right_value = 2, operation = /, result =1
    проверил базу данных, указанные значения появились в новом поле

6. отправил post запрос на адрес localhost:3306/operation/-
    пришел ответ, со значениями operation = -
    проверил базу данных, значение operation появилось в новом поле
    отправил get запрос на адрес localhost:3306/result
    пришел ответ, со значениями Left_value = 2, right_value = 2, operation = -, result =0
    проверил базу данных, указанные значения появились в новом поле

7. отправил get запрос на адрес localhost:3306/history
    пришел ответ, соответствующий информации в бд    

negative cases:

1. отправил post запрос на адрес localhost:3306/LeftValue/dsadsa
    вернулось сообщение о некорретных данных

2. отправил post запрос на адрес localhost:3306/rightValue/dsadas
    вернулось сообщение о некорретных данных

3. отправил post запрос на адрес localhost:3306/operation/dsadsa
    вернулось сообщение о некорретных данных

4. отправил post запрос на адрес localhost:3306/operation/312312
    вернулось сообщение о некорретных данных

5. отправил post запрос на адрес localhost:3306/operation/%$^$#
    вернулось сообщение о некорретных данных

6. Очистил базу данных с помощью команды truncate
    отправил get запрос на адрес localhost:3306/history
    вернулось сообщение о том, что таблица пуста

7. Очистил базу данных с помощью команды truncate
    отправил get запрос на адрес localhost:3306/history
    вернулось сообщение о некорретных данных