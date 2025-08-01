# Service Technique MVC
NB: Ce projet est hébergé sur [http://t-service.kesug.com]

> Application web de gestion de prestations de services techniques en architecture MVC (Model-View-Controller).

---

## 🚀 Fonctionnalités principales

- Interface multi-pages (utilisateur et administrateur)
- Gestion des prestations (ajout, modification, suppression)
- Affichage des services informatiques, mécaniques, électriques, etc.
- Système de connexion utilisateur
- Accès administrateur sécurisé
- Architecture MVC propre et modulaire
- Style personnalisé avec conventions CSS strictes

---

## 🧱 Structure du projet

```
/
├── controllers/          # Contrôleurs de l'application
├── models/               # Modèles (accès à la base de données)
├── views/                # Vues HTML/PHP
├── public/               # CSS, JS, images accessibles publiquement
├── routes/               # Définition des routes (si présent)
├── mainapp/              # Configuration principale, base MVC
└── index.php             # Point d'entrée principal
```

---

## 🔐 Accès administrateur

Le rôle de l'utilisateur est défini dans la base de données (`users.role`).

- `admin` : Accès au panneau d'administration
- `user` : Accès standard

Ajoutez un utilisateur avec rôle `admin` dans la base de données pour accéder au dashboard administrateur.

---

## 🛠 Installation

### Prérequis :
- PHP 7.4+
- MySQL/MariaDB
- Serveur Apache ou équivalent

### Étapes :

1. **Cloner le projet :**
   ```bash
   git clone https://github.com/Darkshadow-77/Service_Technique_MVC.git
   cd Service_Technique_MVC
   ```

2. **Configurer la base de données :**
   - Importez le fichier SQL fourni (`database.sql` s’il existe).
   - Vérifiez les identifiants de connexion dans le fichier de configuration (`mainapp/config.php` ou équivalent).

3. **Lancer l'application :**
   - Placez le dossier dans le répertoire de votre serveur web (`htdocs/` ou `www/`).
   - Accédez à [http://localhost/Service_Technique_MVC](http://localhost/Service_Technique_MVC) depuis votre navigateur.

---

## ✨ Conventions de code

- **Classes CSS** en minuscules
- Séparation du CSS par page
- Structure MVC stricte
- Utilisation de Git pour le versionnage

---

## 📁 TODO

- [ ] Ajouter un panneau de gestion des utilisateurs pour l'admin
- [ ] Système de messagerie interne
- [ ] Téléversement de fichiers techniques
- [ ] Statistiques sur les interventions

---

## 🧑‍💻 Auteur

**Darkshadow-77**  
🔗 [GitHub](https://github.com/Darkshadow-77)

---

## 📄 Licence

Ce projet est sous licence libre (ex : MIT). À adapter selon ton cas.
