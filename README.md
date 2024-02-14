# schedule_generator

В корне
cp .env.dist .env
задать параметры подключения к БД

В app задавать DATABASE_URL

docker-compose exec php /bin/bash
docker-compose up -d

php bin/console  make:migration

