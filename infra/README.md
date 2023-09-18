# Installation du projet

## après avoir exécuté le docker-compose up : 


** Initialisation du projet Symfony : **

> docker exec -it php-fpm bash
> symfony new mywebapp --version="6.3.*" --webapp
> cd mywebapp
> composer install

** connexion de Doctrine à PostgreSQL : **
Editer le fichier src/mywebapp/config/packages/doctrine.yaml
