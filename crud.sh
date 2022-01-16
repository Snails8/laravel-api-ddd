#! /bin/bash
set -euC

# set enviroment value into aws ssm parameter store.
#usage
# cp .env.example .env.dev
# input env value .env.dev
# sh aws.s  app_name .env.dev

APP_NAME=$1

# Admin/Task -> 分別する作業と prefix抜く
# Admin/ -> Modelやmigration条件分岐

# 変換  -> 正規表現


#SAMPLE= echo $APP_NAME | sed -E -e 's/^([A-Z])/\L\1\E/' -e 's/([A-Z])/_\L\1\E/g'

# CamelCase -> snake_case

docker-compose exec app sh -c "
php artisan make:controller "$APP_NAME"Controller

php artisan make:model "$APP_NAME"
php artisan make:seeder "$APP_NAME"sTableSeeder
"
#echo "$SAMPLE"
