# bukowski

Module 8 initiation à la securité
# 💻 Module 8 – Initiation à la sécurité en PHP  
## Exercice de synthèse – Le site de l’entreprise Bukowski

Ce projet est réalisé dans le cadre du **Module 8 : Initiation à la sécurité** de la formation PHP.  
Il s'agit d'un mini-site web sécurisé permettant d’accéder de manière privée aux sujets d’un forum d’entreprise.

---

## 🎯 Objectifs pédagogiques

- Implémenter une **authentification sécurisée**
- Utiliser des **sessions PHP**
- Employer des **requêtes préparées** pour éviter les injections SQL
- Afficher une liste de sujets (**listing**) et un détail par sujet
- Structurer le code en **programmation orientée objet**
- Appliquer les **bonnes pratiques de sécurité** côté serveur

---

## 🗂️ Structure du site

Le site se compose de 3 pages principales :

1. **`index.php`** – Page d'identification (publique)  
2. **`listing.php`** – Liste des sujets (accès réservé)  
3. **`detail.php`** – Détail d’un sujet sélectionné (accès réservé)  
4. **`logout.php`** – Déconnexion et retour à l’identification

Le tout est sécurisé via les **sessions PHP** et chaque requête en base est préparée.

---

## 🔒 Sécurité mise en place

- Authentification via email + mot de passe (requête préparée)
- Données envoyées en `POST`
- Pages privées protégées par `$_SESSION`
- Redirection automatique si l’utilisateur n’est pas connecté
- Utilisation de `password_verify()` pour les mots de passe
- Lien "Se déconnecter" disponible sur chaque page privée
- `id` des topics filtré via une requête préparée dans `detail.php`

---

## 🧰 Technologies utilisées

- PHP 8+
- MySQL (via PDO)
- HTML/CSS simple
- Hébergement sur GitHub (pour le code source)

---

## 📁 Structure du projet

```
bukowski/
├── ajouter_sujet.php       ✅ Formulaire simple
├── traiter_ajout_sujet.php ✅ Traitement
├── listing.php
├── detail.php
├── index.php
├── logout.php
├── config/
│   └── database.php
├── includes/
│   └── auth.php
├── classes/
│   └── Topic.php
├── assets/
│   ├── style.css
│   └── jazz.png
├── mysql/
│   └── create.sql
├── README.md


```