# schedule_generator

В корне проета
cp .env.dist .env
задать параметры подключения к БД в .env

Перейти в папку app

cp .env .env.local

Поменять DATABASE_URL

docker-compose up -d

docker-compose exec php /bin/bash

php bin/console  make:migration

http://localhost/teams/
http://localhost/tournaments

