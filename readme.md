**Установка на windows:**

**Распаковываем проект**

**Устанавливаем php** http://php.net/manual/ru/install.windows.php / http://php.net/downloads.php


**Рредактируем в файле crontab:**
c:/php5/php.exe d:/patch/ping.php

c:/php5/php.exe - путь до интерпретатора

d:/patch/ping.php - путь до файла php

**Редактируем файл ping.php**

$testHost = "www.google.com"; - хост

$testPort = 80; - порт

$timeout = 1; - таймаут