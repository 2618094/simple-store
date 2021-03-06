# Simple Store

## Local development

For local development the developer must have installed **make, docker and docker-compose**

### First install 

It took about 5 minutes for build images and install dependencies
```shell
git clone git@github.com:2618094/simple-store.git
cd simple-store
make init
```
### After initialization
```shell
make up
```

### Testing
```shell
make test
```

### Other commands (help)
```shell
make
```

## Local development without docker

### Initialization

```shell
npm install
composer copy-env
# Set properties in .env for local database and redis (or disable redis cache)
composer install
npm run dev
composer generate-app-key
php artisan migrate:fresh --seed
php artisan serve
```
### Database testing

For testing purposes local MYSQL **MUST** have **testing** database with same access as master database

