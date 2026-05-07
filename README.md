# LibCore
*Description*

LibCore est un projet de gestion de bibliothèque développé en PHP, MySQL et utilisant Git/GitHub pour le versioning.
Le projet a été réalisé pour l’association “The Knowledge Hub”, un réseau de bibliothèques associatives qui gérait auparavant ses ouvrages avec des fichiers Excel.
L’objectif principal de LibCore est de créer un noyau logique capable de gérer :

les livres,
les membres,
les emprunts et retours,
ainsi que les règles de gestion d’une bibliothèque moderne.

*Technologies utilisées*
PHP (POO)
MySQL
Git & GitHub
UML
Console Interface

*Structure de projet*
LibCore/
├── src/
│   ├── Entities/
│   │   ├── User.php
│   │   ├── Member.php
│   │   ├── Librarian.php
│   │   └── Book.php
│   ├── Services/
│   │   └── Library.php
│
├── docs/
│   ├── use-case.png
│   ├── class-diagram.png
│   └── er-diagram.png
│
├── mainAdmin.php
├── mainMember.php
├── .env
├── .gitignore
└── README.md

*Fonctionnalités*
_Dashboard Bibliothécaire_

-Gestion du catalogue-
Ajouter un livre
Supprimer un livre
Mettre un livre en réparation
Consulter l’état des livres

-Gestion des membres-
Créer un membre
Définir le type :
Student
Teacher

-Suivi des stocks-
Voir les livres :
Disponibles
Empruntés
Perdus

_Dashboard Membre_

-Recherche-
Rechercher un livre par :
titre
auteur

-Emprunt-
Emprunter un livre disponible
Mise à jour automatique du statut

-Retour-
Retourner un livre emprunté

-Suivi personnel-
Afficher les livres empruntés

*Architecture POO*

Le projet respecte les principes de :
Encapsulation
Héritage
Composition
Association

Relations UML
Héritage
User
 ├── Member
 └── Librarian

Composition
Library contient :
- plusieurs Books
- plusieurs Users

Association
Un Member peut emprunter plusieurs Books
*Règles métier*

_Validation des emprunts_
Un membre ne peut pas emprunter un livre si :
le livre n’est pas disponible,
le membre n’est pas actif,
la limite d’emprunt est atteinte.

*Encapsulation*

Et manipulées via :
Getters
Setters

*Objectifs pédagogiques*

Ce projet permet de pratiquer :
la programmation orientée objet,
la modélisation UML,
la gestion de base de données,
l’organisation d’un projet professionnel,
et le travail collaboratif avec GitHub.