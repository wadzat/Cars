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

## Configuration de Xdebug dans PHPStorm :
> Preférences > PHP > Servers
> > - Name : Docker
> > - Host : 127.0.0.1
> > - Port : 888
> > - Cocher "use path mappings"
> > - Eventuellement préciser les chemins selon arbo du container

> Run > Edit configurations
> > - cliquer sur +
> > - name : my_app_remote
> > - Server : Docker
> > - IDE key : PHPSTORM

## Installation d'easy admin
> symfony composer req "admin:^4"
