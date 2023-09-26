# Installation du projet

## après avoir exécuté le docker-compose up : 


** Initialisation du projet Symfony : **

> docker exec -it php-fpm bash
> symfony new mywebapp --version="6.3.*" --webapp
> cd mywebapp
> composer install

** connexion de Doctrine à PostgreSQL : **
le fichier src/mywebapp/config/packages/doctrine.yaml nous renvoie vers le .env
> editer /mywebapp/.env.local : 
> DATABASE_URL=postgres://user_symfony@postrges:5432/db_symfony

dans doctrine.yaml : préciser la version de postgresql (indispensable)



connexion psql depuis son conteneur : psql -p 5432 -h localhost -U user_symfony -d db_symfony
