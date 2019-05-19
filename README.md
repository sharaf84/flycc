# Flycc

Fly365 code challenge


## Stack
- PHP ([Lumen](https://lumen.laravel.com/))
- Mysql
- Nginx
- Docker

## Installation

```bash
git clone https://github.com/sharaf84/flycc.git
cd flycc
cp .env.local .env
docker-compose up -d
# Migrate & seed only for the first time
docker-compose exec api php artisan migrate --seed
# If not working, please try to exec the api sh
docker-compose exec api sh
# then run
php artisan migrate --seed
```

## Endpoint

```
GET http://localhost:8080/payment/transactions

Query params:
  - {String} provider Example: flypayA
  - {String} statusCode Example: authorised
  - {Number} amountMin Example: 10
  - {Number} amountMax Example 2000
  - {String} currency Example AUD

ex: http://localhost:8080/payment/transactions?provider=flypayA&statusCode=authorised
```

## Adding new payment provider:
- Add a new JSON file to `storage/json/transactions/{FILE_NAME}.json`
- Reuse `flypayATransactionSeeder` seeder class (duplicate and rename the file).
- Update the new class setters.
- Run the seeder `docker-compose exec api php artisan db:seed --class={NEW_CLASS_NAME}`

## Notes:
- I have not implemented pagination since records are already too few, but it's easy to implement since it's built in feature in Lumen.