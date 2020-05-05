#!/bin/bash

# Script used to prepare

red=`tput setaf 1`
green=`tput setaf 2`
reset=`tput sgr0`

echo ${green}Preparing to migrate database, install Laravel Passport clients and seed database.${reset}

php artisan migrate:fresh
php artisan db:seed
php artisan passport:install
php artisan passport:set-password-client-secret

echo ${green}Database migrations have been run successfully..${reset}
