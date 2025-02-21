# Zoomade

## Qu'est ce que Zoomade ?

Zoomade est un site web permettant de créer des groupes de partage de photo entre amis.

Zoomade vous offre la possibilité de créer, modifier et supprimer des groupes ainsi que gérer les droits d'accès des participants.
Vous pouvez publier des photos dans des groupes, les commenter, et les aimer.
Vous pouvez aussi rendre une photo publique et partager un lien avec vos amis.

## Comment l'installer ?

Pour installer Zoomade en local, il vous faudra Docker.

1. Cloner ou télécharger le répertoire [Github](https://github.com/tomdepussay/projet_php).

2. Modifier les informations dans le fichier **compose.yml**, avec vos mot de passe et un nom de domaine et clé API Resend.

3. Avec docker compose, monter les containers :

```bash
docker compose up -d
```

4. Vous avez fini l'installation de Zoomade !

## Crédit

- [Tom DEPUSSAY](https://github.com/tomdepussay)
- [Florent MENUS](https://github.com/FloMenus)