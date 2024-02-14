# schedule_generator

1. В корне прокета
cp .env.dist .env
задать параметры подключения к БД в .env

2. Перейти в папку app
cp .env .env.local
Поменять DATABASE_URL

3. Запуска контейнкеров
docker-compose up -d

4. Запуск миграций
docker-compose exec php /bin/bash
php bin/console  make:migration

http://localhost/teams/
http://localhost/tournaments

