# GrandTaxiGo - Plateforme de Réservation de Grands Taxis

GrandTaxiGo est une plateforme de réservation de grands taxis, permettant aux passagers de réserver des trajets interurbains et aux chauffeurs de gérer leurs disponibilités et leurs trajets. Le système offre une gestion simple des réservations, un suivi des trajets, ainsi qu'une interface dédiée à la gestion des profils des utilisateurs (passagers et chauffeurs).

## Contexte du Projet

La société GrandTaxiGo souhaite offrir une solution moderne de réservation de taxis permettant aux utilisateurs de réserver des trajets interurbains facilement. Les passagers pourront réserver un taxi, consulter l’historique de leurs trajets et trouver des chauffeurs disponibles. Les chauffeurs, quant à eux, pourront gérer leurs disponibilités et accepter ou refuser des réservations.

## Fonctionnalités

### Authentification et Compte

- **Création de compte utilisateur** : 
  - Les utilisateurs (passagers ou chauffeurs) peuvent créer un compte avec leurs informations personnelles.
  - Une photo de profil est obligatoire lors de la création du compte.
  
- **Connexion** :
  - Les utilisateurs peuvent se connecter avec leurs identifiants pour accéder à leur profil et à leurs informations.

### Réservation et Gestion des Trajets

- **Réservation de taxi** :
  - Les passagers peuvent réserver un taxi en indiquant la date, le lieu de prise en charge et la destination.
  
- **Historique des trajets** :
  - Les passagers peuvent consulter l'historique de leurs réservations.
  - Les chauffeurs peuvent consulter l'historique de leurs courses effectuées.

- **Annulation de réservation** :
  - Les passagers peuvent annuler une réservation dans un délai déterminé (avant une heure de départ).
  
- **Filtrage des chauffeurs** :
  - Les passagers peuvent filtrer les chauffeurs disponibles par localisation et disponibilité.

- **Gestion des réservations par les chauffeurs** :
  - Les chauffeurs peuvent accepter ou refuser des réservations.
  - Les réservations non acceptées ou annulées par les chauffeurs avant l’heure de départ sont automatiquement annulées.

- **Mise à jour des disponibilités des chauffeurs** :
  - Les chauffeurs peuvent mettre à jour leurs disponibilités.
  - L’automatisation des disponibilités est facultative.

## Prérequis

Avant de commencer, assurez-vous que vous avez les éléments suivants installés :

- **PHP** (version 7.4 ou supérieure)
- **Composer** (gestionnaire de dépendances PHP)
- **MySQL** ou une autre base de données compatible avec Laravel
- **Node.js** et **NPM** pour gérer les assets front-end
- **Laravel** (version 8.x ou supérieure)

## Installation

### 1. Clonez le projet

Clonez ce repository dans votre environnement local :

```bash
git clone https://github.com/OUSSAMAEDDERKAOUI/GrandTaxiGo-Plateforme-de-Reservation-de-Grands-Taxis.git
cd grandtaxisgo 



### Explication des sections :

- **Contexte du Projet** : Présentation de l'objectif de la plateforme.
- **Fonctionnalités** : Description des principales fonctionnalités du système.
- **Prérequis** : Liste des dépendances et des outils nécessaires pour exécuter le projet.
- **Installation** : Étapes détaillées pour installer et configurer l'application.
- **Utilisation** : Informations sur l'usage de l'application et les principales routes disponibles.
- **Contribuer** : Instructions pour les développeurs souhaitant contribuer au projet.
- **Technologies utilisées** : Technologies et outils utilisés pour développer l'application.
- **Auteurs** : Crédits des personnes ayant travaillé sur le projet.
- **License** : Licence du projet.

Ce format en Markdown est prêt à être utilisé pour votre `README.md` sur GitHub ou dans votre dépôt de projet.

