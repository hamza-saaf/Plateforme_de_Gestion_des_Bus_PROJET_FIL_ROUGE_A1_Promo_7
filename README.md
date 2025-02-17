# Plateforme_de_Gestion_des_Bus_PROJET_FIL_ROUGE_A1_Promo_7
La plateforme de gestion des bus vise à faciliter l'organisation des trajets en permettant aux utilisateurs de consulter les horaires, réserver des places et gérer les itinéraires.

Cahier des Charges:
Plateforme de Gestion des Bus
Contexte du Projet
La plateforme de gestion des bus vise à faciliter l'organisation des trajets en permettant aux utilisateurs de consulter les horaires, réserver des places et gérer les itinéraires. Cette solution s'adresse aux voyageurs, aux opérateurs de transport et aux administrateurs pour assurer un service efficace et optimisé.

Fonctionnalités Requises
Partie Front Office
Visiteur:
Recherche avec filtres (date, destination, prix)
Accès à la liste des trajets disponibles avec pagination.
Recherche des trajets par destination, date et horaires.
Création d'un compte avec le choix du rôle (Voyageur ou Administrateur).
Voyageur:
Visualisation des trajets disponibles.
Recherche et consultation des détails des trajets (bus, horaires, prix, nombre de places disponibles).
Réservation d’un siège après authentification.
Accès à une section "Mes Réservations" regroupant les trajets réservés.
Administrateur:
Ajout de nouveaux trajets avec les détails suivants :
Départ, destination, heure de départ et d’arrivée, prix, nombre de places disponibles.
Gestion des trajets :
Modification, suppression et consultation des réservations.
Accès à une section "Statistiques" :
Nombre total de trajets, taux d’occupation des bus, trajets les plus populaires.

Partie Back Office
Administrateur:
Validation et gestion des comptes utilisateurs.
Gestion des trajets et des réservations.
Accès aux statistiques globales :
Nombre total de trajets, répartition par destination, taux d’occupation des bus.

Fonctionnalités Transversales
Un trajet peut inclure plusieurs arrêts intermédiaires (relation one-to-many).
Application des concepts OOP dans la gestion des trajets et des réservations.
Système d’authentification et d’autorisation sécurisé.
Contrôle d’accès : chaque utilisateur ne peut accéder qu’aux fonctionnalités correspondant à son rôle.

Exigences Techniques
Respect des principes OOP (encapsulation, héritage, polymorphisme).
Base de données relationnelle avec gestion des relations (one-to-many, many-to-many) sur PostgreSQL.
Utilisation des sessions PHP pour la gestion des utilisateurs connectés.
Validation des données utilisateur côté client et serveur.
Sécurisation contre les attaques XSS, CSRF et injection SQL.

Critères de Performance
Séparation claire entre la logique métier et l’architecture MVC.
Cohérence dans l’application des concepts OOP.
Code structuré et lisible.
Adaptabilité aux différents types d’écrans (Responsive Design).
Validation côté client avec HTML5 et JavaScript natif.
Sécurisation des formulaires contre XSS et CSRF.
Utilisation de requêtes préparées pour prévenir l’injection SQL.
Validation et échappement des données en entrée.

