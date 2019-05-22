#!/bin/bash

printf "\n"
echo "copying environment files..."
printf "\n"
cp .env.dev .env
printf "\n"
echo "building containers..."
printf "\n"
docker-compose up -d
printf "\n"
echo "installing dependencies..."
printf "\n"
docker exec -it voucher-pool-php-fpm composer install
printf "\n"
echo "creating test database in recipe-service..."
printf "\n"
docker exec -it voucher-pool-mysql mysql -u root -pnewsletter2go -e "create database newsletter2go_testing; GRANT ALL PRIVILEGES ON *.* TO 'newsletter2go'@'%' IDENTIFIED BY 'newsletter2go';";
printf "\n"
echo "migrating & seeding the required databases..."
printf "\n"
$ docker exec -it voucher-pool-php-fpm php vendor/bin/phinx migrate
$ docker exec -it voucher-pool-php-fpm php vendor/bin/phinx seed:run
printf "\n"
echo "done..."
printf "\n"
