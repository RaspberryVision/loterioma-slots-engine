#!/bin/sh

# DROP DATABASE
php bin/console doctrine:database:drop --force

# CREATE DATABASE
php bin/console doctrine:database:create

# RUN MIGRATIONS
php bin/console doctrine:migrations:migrate --no-interaction

# RUN FIXTURES
php bin/console doctrine:fixtures:load --no-interaction
