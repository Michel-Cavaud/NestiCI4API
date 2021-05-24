**

## API Projet NESTI CDA 2020 / 2021 GRETA

**

Api du projet NESTI utilisé par l'application Android pour l'accès aux données de la base de données.

Cette API permet de :
 - Lire l'ensemble des recettes
 - Lire une recette à partir de son identifiant
 - Lire les recettes à partir de l'identifiant d'une catégorie
 - Lire les recettes à partir d'une partie du nom de la recette

Les tokens (jetons) sont enregistrés dans une table jeton. Chaque jeton "appartient" à une application
Une table contient la liste des applications qui utilisent l'API
Une table enregistre les logs de l'utilisation des jetons avec l'Identifiant du jeton, l'utilisateur connecté s'il existe et la date (datetime).

La documentation de l'API : [ICI](https://cavaud.needemand.com/realisations/APINesti/public/)
