# SmartAccessSystem

## Генерация ключей

1. `сd папка проекта` (или локальная дериктория проекта)
2. `openssl genrsa -aes128 -passout pass:webant -out private.key 2048` 
3. `openssl rsa -in private.key -passin pass:webant -pubout -out public.key`

## Env
1. Переименовать `.env.example` в `.env`
2. Указать базу данных 
3. Указать пути к ключам 

## Mysql
1. `bin/console d:s:c`


## Composer 
1. `composer install`

