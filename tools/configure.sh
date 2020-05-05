#!/bin/bash

echo "INSTALLING DEPENDENCIES..."
composer install
clear
echo "DEPENDENCIES INSTALLED!"

echo "SETTING UP ENVIRONMENT VARIABLES"
touch .env
echo "local" >> .env
mkdir ./envs/local
cp .envs/example/.env ./envs/local/.env
clear
./vendor/bin/cghooks add --ignore-lock
echo "ENVIRONMENT VARIABLES SUCCESSFULLY SETUP !!!"
