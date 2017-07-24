# README

## 1 - Introduction :

This project is an exercice for php / symfony developpement cursus.

Source code is on GitHub : https://github.com/Aeltus/bilemo

## 2 - requirements :

For this project, I used the following environnement :
- php >= 7.0
- MySql 5.7.9

## 3 - Structure :
This is a Symfony 3.3 project, witch respect the standards for the structure.
It is divided into 3 bundles :
- AppBundle : The core of the web site.
- ConsumerBundle : All for the consumers
-CustomerBundle : All for the customers

## 4 - Installation :

1. clone this repository (master branch)
2. put it into your server root folder
3. into command line install vendors by using composer (https://getcomposer.org/download/)
- use this command in prompt : composer install
4. set de configuration into :
- /app/config/parameters.yml.dist and rename it in /app/config/parameters.yml

5. also in command line set the database by using this commands
- php bin/console doctrine:database:create
- php bin/console doctrine:schema:update --force
- php bin/console doctrine:fixtures:load

6. put assets in rights folders by using (in prompt)
- php bin/console assets/install

### Your web site is now up to date !!! :)
