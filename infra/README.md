# Installation du projet

> après avoir exécuté le docker-compose up 

## Initialisation du projet Symfony : 

``docker exec -it php-fpm bash``

`` symfony new mywebapp --version="6.3.*" --webapp ``

`` cd mywebapp ``

`` composer install ``

## Connexion de Doctrine à PostgreSQL : 
> le fichier src/mywebapp/config/packages/doctrine.yaml nous renvoie vers le .env
>> editer /mywebapp/.env.local : 
> 
> `` DATABASE_URL=postgres://user_symfony@postrges:5432/db_symfony ``
> 
> (attention, on utilise bien le port interne au container)


dans doctrine.yaml : préciser la version de postgresql (indispensable)

connexion psql depuis son conteneur : ``psql -p 5432 -h localhost -U user_symfony -d db_symfony`` 

> pour virer le PHP Warning:  Module "intl" is already loaded in Unknown on line 0 : commenter la ligne qui est dans le fichier /usr/local/etc/php/conf.d/docker-php-ext-intl.ini  (déjà loadé dans php.ini)

