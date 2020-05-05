#!/bin/bash

# Script used to prepare the dev database

red=`tput setaf 1`
green=`tput setaf 2`
reset=`tput sgr0`

echo ${green}Preparing to migrate database, install Laravel Passport clients and seed database.${reset}

php artisan migrate:fresh --env=development
php artisan db:seed --env=development
php artisan passport:install --env=development
php artisan passport:set-password-client-secret --env=development

echo ${green}Database migrations have been run successfully.${reset}
