DC := docker-compose exec app
a := $1
# ====================================================================
# docker command
# ====================================================================
up:
	docker-compose up --build

stop:
	docker-compose stop

restart:
	docker-compose down
	docker-compose up -d

down:
	docker-compose down

destroy:
	docker-compose down --rmi all --volumes

app:
	${DC} /bin/bash
# ====================================================================
# setup command
# ====================================================================
create-project:
	docker-compose up -d --build
	${DC} composer create-project --prefer-dist laravel/laravel .
	${DC} composer require predis/predis

install:
	cp .env.example .env
	docker-compose up -d --build
	${DC} composer install
	${DC} npm install
	${DC} npm run dev
	${DC} php artisan key:generate
	docker-compose exec app php artisan migrate:fresh --seed
	docker-compose exec app chmod -R 777 storage
	docker-compose exec app chmod -R 777 bootstrap/cache

reinstall:
	@make destroy
	@make install

# ====================================================================
# default FlameWork command
# ====================================================================
controller:
	${DC} php artisan make:controller ${a}Controller
	${DC} php artisan make:test Controller/${a}ControllerTest

model:
	${DC} php artisan make:model ${a}

migration:
	${DC} docker-compose exec app php artisan make:migration

migrate:
	${DC} php artisan migrate:fresh --seed

seed:
	${DC} php artisan db:seed

test-migrate:
	${DC} php artisan migrate:refresh --database=testing --seed

test:
	${DC} php ./vendor/bin/phpunit

# ===== あんま使わない  ==================================================
tinker:
	${DC} php artisan tinker

dump:
	${DC} php artisan dump-server

cs:
	${DC} vendor/bin/phpcs

cbf:
	${DC} vendor/bin/phpcbf

sql:
	docker-compose exec db bash -c 'mysql -u $$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DATABASE'

# ====================================================================
# front
# ====================================================================
yarn:
	docker-compose exec node yarn
	docker-compose exec node yarn dev

watch:
	${DC} npm run watch


# ====================================================================
# オレオレコマンド
# ====================================================================
cache:
	sh clear-cache.sh





c-%:
	${DC} php artisan make:controller ${a}