# support-tickets-system

```
cp .env.example .env

docker-compose up -d --build

docker-compose run composer install
docker-compose run npm install

docker-compose run npm run build

chmod -R 777 storage/

docker-compose exec php bash

 php artisan key:generate
 php artisan migrate
 php artisan db:seed


url phpmyadmin : http://ip:8000
username:root
password:root123 
```