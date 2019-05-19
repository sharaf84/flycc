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
```

## Adding new payment provider:
- Add a new JSON file to `storage/json/transactions/{FILE_NAME}.json`
- Reuse `flypayATransactionSeeder` seeder class (duplicate and rename the file).
- Update the new class setters.
- Run the seeder `php artisan docker-compose exec api db:seed --class={NEW_CLASS_NAME}`

## Notes:
- I have not implemented pagination since records are already too few, but it's easy to implement since it's built in feature in Lumen.