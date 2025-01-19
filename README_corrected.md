# Tirage au Sort avec Slim Framework

Une application web simple développée avec le **Slim Framework** en PHP, permettant de gérer une liste d'étudiants et de tirer un nom au hasard. L'interface utilisateur est stylisée avec **Clarity UI** pour un rendu moderne et professionnel.

## Fonctionnalités

- Ajouter des étudiants à une liste.
- Afficher la liste des étudiants enregistrés.
- Tirer un étudiant au hasard.
- Suppression automatique de l'étudiant sélectionné de la liste.
- Interface utilisateur moderne grâce à **Clarity UI**.

## Technologies utilisées

- **Slim Framework** : Framework PHP léger pour construire des applications web.
- **PHP** : Langage backend pour le traitement des requêtes.
- **Clarity UI** : Bibliothèque CSS pour un design moderne.
- **JavaScript** : Pour la communication avec l'API et la gestion des interactions utilisateur.
- **HTML/CSS** : Pour l'interface utilisateur.

## Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine :

- **PHP** (version 7.4 ou supérieure).
- **Composer** (pour gérer les dépendances PHP).
- Un serveur web comme **PHP Built-in Server**.

## Installation et configuration

1. Clonez ce dépôt :
   ```bash
   git clone https://github.com/NicolasRbls/Tirage_au_sort_SLIM.git
   cd Tirage_au_sort_SLIM
   ```

2. Installez les dépendances avec Composer :
   ```bash
   composer install
   ```

3. Lancez le serveur PHP intégré :
   ```bash
   php -S localhost:8000 -t .
   ```

4. Accédez à l'application via votre navigateur à l'adresse suivante :
   ```
   http://localhost:8000
   ```

## Structure du projet

```
Tirage_au_sort_SLIM/
├── public/
│   └── css/
│       └── styles.css          # Feuille de styles pour l'application
├── templates/
│   └── index.html              # Interface utilisateur principale
├── vendor/                     # Bibliothèques installées via Composer
├── index.php                   # Point d'entrée de l'application
├── composer.json               # Configuration des dépendances
├── README.md                   # Documentation du projet
```

## Routes disponibles

### GET `/`
Affiche l'interface utilisateur principale.

### POST `/add_student`
Ajoute un étudiant à la liste.

- **Corps de la requête (JSON)** :
  ```json
  {
    "name": "Nom de l'étudiant"
  }
  ```

- **Réponse (JSON)** :
  ```json
  {
    "message": "Étudiant ajouté avec succès.",
    "students": ["Nom1", "Nom2"]
  }
  ```

### GET `/get_students`
Récupère la liste des étudiants enregistrés.

- **Réponse (JSON)** :
  ```json
  {
    "students": ["Nom1", "Nom2"]
  }
  ```

### POST `/pick_student`
Tire un étudiant au hasard.

- **Réponse (JSON)** :
  ```json
  {
    "chosen_student": "Nom tiré au hasard",
    "remaining_students": ["Nom2"]
  }
  ```

## Exemple d'utilisation

1. Ajoutez des étudiants via le champ d'entrée.
2. Consultez la liste mise à jour en temps réel.
3. Cliquez sur **Tirer un étudiant** pour sélectionner un étudiant au hasard.

## Licence

Ce projet est sous licence MIT. Vous êtes libre de l'utiliser, le modifier et le distribuer.

---

Bon développement et amusez-vous avec cette application moderne de tirage au sort ! 🎲
