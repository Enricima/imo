# IMO

## A propos d'Imo

Imo est une application pour une agence immobilière en ligne. Elle permet toutes les fonctionnalités basiques :

- Voir les annonces
- Voir le détail d'une annonce et situer le bien sur la carte
- Avoir un compte utilisateur
- Gérer ses favoris
- Avoir une interface pour les administrateurs permettant de gérer les propriétés et les utilisateurs
- Contacter les admin commerciaux (envoi de mail non fonctionnel)

## Installer le projet

Pour installer le projet merci de suivre les étapes suivantes :
1. Cloner le projet github
2. Mettre en place une BDD
3. Créer un **.env** en suivant l'exemple du fichier **.env.example**. __Attention, clé API google Maps à ajouter également__
4. Taper les commandes suivantes

> `composer install`

> `php artisan migrate`

> `php artisan serve`