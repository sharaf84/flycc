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

http://localhost:8080/payment/transactions?provider=flypayA&statusCode=authorised&amountMin=10&amountMax=2000&currency=AUD


## License
[MIT](https://choosealicense.com/licenses/mit/)