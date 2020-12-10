# Projet Escape Movie.
## Projet N°2 de la Wild Code School, promotion 2020-2021 'Horizon'.

## Technologies utilisées : 

*  utilisation du cadre de travail SCRUM pour l'organisation
* Mise en forme : HTML/CSS
* Langage : PHP
* utilisation architecture MVC
* PDO / Twig
* SQL (pour la base de données)

## Membres du projet : 

Equipe sur le projet :
* Enzo Gaudry (Scrum Master): https://github.com/EnzoGaudry.
* Baptiste Vayssié (Team Member): https://github.com/Vayssie-web.
* Nathan Machrouh (Product Owner): https://github.com/NathanMachrouh.
* Alice Petitjean (Team Member): https://github.com/alicepetitjean https://www.linkedin.com/in/alice-petitjean-36729419b/.

##  A quoi sert notre projet ?

Escape Movie est un jeu de type "escape game" reposant sur un système de carte à jouer (inspiré d'un lock), sur le théme du cinéma.

Il permet à l'utilisateur de :
* Créer un scénario, fidèle à l'histoire originale ou non, de son film préféré et jouer les scénarios des autres joueurs. 

* Créer les cartes qui composeront votre scénario avec un nom, un numéro de carte, une image et une description.

* Combiner certaines cartes avec leurs numéros afin de prendre une carte en particulier dans une pioche.

* Se débarrasser des cartes inutiles dans une défausse avec la possibilité d'aller les reprendrent en cas de doutes ou de fausses manipulations.

* Modifer les cartes de nos scénarios si celles-ci ne nous conviennent plus.

* Modifer les cartes des scénarios des autres joueurs afin de les rendrent plus interressants, ou plus complexes (ou moins complexes en fonction).

## Les dates du projet 

* Nous avons réalisé ce projet en 6 semaines : du 19 Ocotbre 2020 au 27 Novembre 2020 dans le cadre de notre 2ème projet à la Wild Code School de Reims.

## Le contexte du projet 

* Nous avons réalisé ce projet au cours de notre formation développeur web et mobile (5 mois) à la Wild Code School de Reims.

* Nous avons commencé notre projet en présentiel puis nous sommes rentrés en confinement et nous avons donc continué notre projet en remote.


## Étapes d'installation


1. Cloner le repo de Github.

2. Lancer composer install.

3. Créer config/db.php à partir du fichier config/db.php.dist et ajouter les paramètres de votre base de données. Ne supprimez pas le fichier .dist, il doit être conservé.

4. Importez escape_movie_db.sql dans votre serveur SQL.

5. Exécutez le serveur web interne PHP avec php -S localhost:8000 -t public/. L'option -t avec public comme paramètre signifie que votre localhost ciblera le dossier /public.

6. Allez sur localhost:8000 avec votre navigateur préféré.

7. Amusez-vous bien
