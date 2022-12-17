# support-tickets-system

```
cp .env.example .env
docker compose up -d --build
docker compose exec php composer install
docker compose exec php artisan key:generate
docker compose exec php artisan migrate
docker compose exec php artisan db:seed
```