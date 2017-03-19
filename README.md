clicker
=======

A Symfony project created on March 18, 2017, 8:16 am.

##Установка проекта:

**1. Клонируем проект из репозитория**


**2. Установливаем Symfony, библиотеки и зависимости. Если нужно скачиваем [composer](https://getcomposer.org/download/ "Download Composer")**


```
php composer.phar install
```

**3. Настраиваем базу данных в файле** *app/config/parameters.yml*

**4. Создаем таблицы в базе данных**


```
php bin/console doctrine:schema:create
```
или

```
php bin/console doctrine:migrations:migrate
```

**Для установки/обновления assets (изображения, скрипты, стили, шрифты) выполняем следующие команды**


```
rm -Rf web/css
rm -Rf web/js
rm -Rf web/fonts
rm -Rf web/bundles
bin/console assets:install
bin/console assetic:dump --env=prod
```

или


```
rm -Rf web/css; rm -Rf web/js; rm -Rf web/fonts; rm -Rf web/bundles; bin/console assets:install; bin/console assetic:dump --env=prod
```

**Очистка кэша Symfony**


```
bin/console cache:clear --env=prod
```
