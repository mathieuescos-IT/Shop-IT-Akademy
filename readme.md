# Shop IT-Akademy
Ce projet est un site e-commerce specialisé dans la vente de produit IT Akademy
Visiter mon site pour plus de projets : https://mathieuescos.fr


## Pour commencer

Pour commencer, rendez-vous sur ce lien ici -> (https://travaux.escos.pro/itakademy2/)
Voici les identifiants pour vous connecter :

Session Admin : test@test.fr:It@Akademy2019!

Session Membre : test2@test.fr:It@Akademy2019!

### Pré-requis

Le site se décompose en 4 dossiers (css, img, includes, uploads). Le dossier includes stocke les informations pour se connecter à la base de données mais également les actions pour effectuer des requêtes avec cette dernières.

Afin d'accéder pleinement au capacité du shop, vous devez vous connecter avec l'une des deux session ci-dessus (à savoir que seule la session admin dispose de droit supplémentaire (creer, editer, supprimer) contrairement au membre(voir).

Concernant l'ajout d'un article au panier, celui-ci est à moitié fonctionnelle, il faut refresh la page une fois arriver sur panier.php pour voir l'article ajouté au panier. De même pour la suppression de l'article sur la page panier, il faut double-cliquer sur le bouton supprimer.

### Ce qui n'est pas abouti

La validation du panier afin de génèrer une facture PDF n'est pas abouti, ceci impacte donc sur le fait qu'il n'y ait aucune entrée sur la page historique des commandes (néanmoins le code est developpé, voir page historiqueCommande.php).

## Démarrage

Une fois que vous êtes arriver sur le site (cité ci-dessus), vous pouvez en tant qu'inviter voir uniquement la page d'accueil qui contient certains produits.

L'invité est emmené à se connecter uniquement s'il possède des identifiants membres, c'est-à-dire qu'il n'a pas la possibilité de s'inscrire (seul l'administrateur peut crée un compte membre).

[SESSION MEMBRE]

Une fois que l'invité se connecte avec les bons identifiants, il obtient le statut membre et débloque ainsi l'accès à toutes les pages visibles sur le site tel que la page Home, derniers arrivages, tous les produits ainsi que le moteur de recherche et son panier.

Vous avez donc la possibilité d'ajouter des produits au panier ainsi que les supprimer, de rechercher des produits dans le moteur de recherche mais également de voir l'article sur sa page.

[SESSION ADMIN]

Une fois que l'invité se connecte avec les bons identifiants, il obtient le statut admin. Il peut donc avoir accès à toutes les pages hebergés sur le serveur du site.

L'administrateur peut non seulemet voir le contenu de chaque page du site visible mais également celle qui sont interdites au membre tel que la création d'utilisateur, la suppression des articles...

L'admin qui à un niveau au dessus de celui du membre peut donc créer, modifier et supprimer mais également activer ou désactiver  des articles. Il peut également, gerer les comptes utilisateurs en les activants ou desactivants mais également il peut en ajouter et en supprimer à volonté. Il peut également passer le compte Membre en compte Admin et vice versa.

## Fabriqué avec

* PHP 7.2 (requête en mysqli)
* [JetBrains](https://jetbrains.com/) - Editeur de texte

## Versions

**Dernière version stable :** 1.0

## Auteurs

Ce projet a été fait par amour par :
* **Mathieu ESCOS** _alias_ [@mathieuescos-IT](https://github.com/mathieuescos-IT)

Toutes reproduction du dit site est interdite.
# shop_ITakademy
# shop_ITakademy
