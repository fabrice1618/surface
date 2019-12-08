# surface
Mises à jour du projet:

```
TODO
    - Creer objet pour ville et typeLogement ?
```

```
08/12/2019 Mise en place de la structure générale
    - VilleModel.php et test-VilleModel.php
    - script SQL de chargement des données de villes dans database
    - TypeLogementModel.php et test-TypeLogementModel.php
    - Classe Piece et test-Piece.php
    - Prototype de PieceModel.php et test-PieceModel.php
    - Prototype classe Logement et test-Logement.php
    - Prototype de LogementModel.php et test-LogementModel.php
```

```
08/12/2019 Modification de la classe UserModel
    - configuration de la base de données dans config.php
    - creation de l'utilisateur surface_user pour accéder à la BDD
    - regroupement des requetes en haut du script
    - finalisation du script test-UserModel.php
```

```
07/12/2019
    - Creation du repertoire database
    - ajout du script de create de la BDD v3
    - ajout du script de creation de l'utilisateur surface_user
    - creation du répertoire test
    - déplacement des scripts de test dans répertoire test    
```

```
07/12/2019
    - Creation de la classe PasswordGenerator qui génère un mot de passe suivant un schéma prédéfini
    - Adaptation de la classe User pour utiliser les nouvelles fonctionnalités
```

```
06/12/2019 Modification de la classe Seau:
            - Utilisation de la fonction filter_var pour simplifier le code
            - Utilisation des opérateurs ternaires
            - Les fonctions ne déclenchent plus d'erreur, elles ont des valeurs par defaut
            - programme de test plus complet avec un 2eme seau
            - Les programmes sont déplacés dans le répertoire cours
```

```
06/12/2019 Menage dans le répertoire projet:
            - Création du dossier archive
            - deplacement du modele avec code procedural dans archive et de son programme de test
            - deplacement du script de creation BDD version 1 dans archive
            - creation du dossier documents
            - deplacement dans documents de l'image du datamodel, du projet MySQL Workbench, du cahier des charges
```
