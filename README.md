

## À propos de l'application

Cette application est conçue pour gérer les élèves, les modules et les évaluations dans un cadre éducatif. Elle est construite avec le framework Laravel, connu pour sa syntaxe expressive et élégante. L'application offre une interface utilisateur intuitive pour faciliter la gestion des données académiques.

### Fonctionnalités principales

- **Gestion des élèves** : Ajoutez, modifiez et supprimez des élèves, avec la possibilité de télécharger des images de profil.
- **Gestion des modules** : Créez et gérez des modules académiques, avec des détails tels que le code et le nom du module.
- **Gestion des évaluations** : Planifiez et gérez les évaluations, en incluant des fonctionnalités pour ajouter des notes et calculer les moyennes.
- **Authentification et autorisation** : Utilisez des rôles et des permissions pour sécuriser l'accès aux différentes parties de l'application.
- **API Tokens** : Gérez les tokens API pour permettre l'accès programmatique aux fonctionnalités de l'application.
## Installation et Lancement

Pour lancer cette application Laravel, suivez les étapes ci-dessous :

### Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP >= 8.1
- Composer
- MySQL ou une autre base de données compatible
- Node.js et npm (pour la gestion des assets)

### Étapes d'installation


1. **Installer les dépendances PHP :**

   Utilisez Composer pour installer les dépendances PHP :
   ```bash
   composer install   ```

2. **Configurer l'environnement :**

   Copiez le fichier `.env.example` en `.env` et configurez vos paramètres de base de données et autres variables d'environnement :
   ```bash
   cp .env.example .env   ```

   Modifiez le fichier `.env` pour inclure vos informations de base de données :
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nom_de_votre_base
   DB_USERNAME=votre_utilisateur
   DB_PASSWORD=votre_mot_de_passe   ```

3. **Générer la clé de l'application :**
   ```bash
   php artisan key:generate   ```

4. **Migrer la base de données :**

   Exécutez les migrations pour créer les tables nécessaires dans votre base de données :
   ```bash
   php artisan migrate   ```

5. **Installer les dépendances JavaScript :**

   Utilisez npm pour installer les dépendances JavaScript :
   ```bash
   npm install   ```

6. **Compiler les assets :**

   Compilez les assets CSS et JavaScript :
   ```bash
   npm run dev   ```

7. **Lancer le serveur de développement :**

   Démarrez le serveur de développement Laravel :
   ```bash
   php artisan serve   ```

   L'application sera accessible à l'adresse `http://localhost:8000`.

### Remarques

- Assurez-vous que votre serveur de base de données est en cours d'exécution.
- Vous pouvez également configurer un serveur web comme Apache ou Nginx pour exécuter l'application en production.


## Tester l'application

### Creation de la base
**Seed la base de données :**

   Exécutez les seeders pour insérer des données de démonstration dans votre base de données :
   ```bash
   php artisan db:seed
   ```

   Cette commande exécutera les seeders définis dans le dossier `database/seeders` et insérera des données de démonstration dans votre base de données.



### Mode professeur
Un compte professeur est présent dans l'application pour en permettre le test
- email : prof@email.com
- mot de passe : iutinfoiutinfo
- une fois connecté, vous avez accès à toutes les fonctionnalités de l'application



### Tester l'API

Pour tester l'API, vous pouvez utiliser des outils tels que Postman ou cURL. Voici quelques exemples de requêtes que vous pouvez effectuer :

* Récupérer la liste des élèves : `GET /api/eleves`
* Récupérer les notes d'un élève : `GET /api/eleves/{id}/exportNotes`

Remplacez `{id}` par l'identifiant de l'élève que vous souhaitez récupérer.

Pour authentifier vos requêtes, vous devez fournir un token API valide. Vous pouvez obtenir un token API en créant un compte dans l'application et en suivant les instructions pour générer un token.

Une fois que vous avez obtenu votre token API, vous pouvez l'inclure dans l'en-tête `Authorization` de vos requêtes. Par exemple :

`X-API-Token votre_token_api`

Remplacez `votre_token_api` par votre token API réel.

Vous pouvez également utiliser les commandes suivantes pour tester l'API :

* `curl -X GET http://localhost:8000/api/eleves -H "X-API-Token votre_token_api"`
* `curl -X GET http://localhost:8000/api/eleves/{id}/exportNotes -H "X-API-Token votre_token_api"`

Assurez-vous de remplacer `votre_token_api` par votre token API réel et `{id}` par l'identifiant de l'élève que vous souhaitez récupérer.


## Licence

Cette application est un logiciel open-source sous licence [MIT](https://opensource.org/licenses/MIT).
